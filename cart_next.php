//render cart function definition
function renderCartForm(){
global $dbconnect;
$cart = $_SESSION['cart']; //get cart session contents
if($cart){ // if there's any items
$items = explode(',',$cart); //creates items array from the cart

$contents = array();
foreach($items as $item){
//set to 1 or add 1
$contents[$item] = (isset($contents[$item])) ?
$contents [$item]+1 : 1;
}
$output[] = '<form action="mng_cart.php?action=update" method="post" id="cart">';
    $output[] = '<table border="0">';
        $output[] = '<tr>';
            $output[] = '<td width="400">Product</td>';
            $output[] = '<td width="75">Price</td>';
            $output[] = '<td width="75">Quantity</td>';
            $output[] = '<td width="100">Total</td>';
            $output[] = '<td width="100">Remove?</td>';
            $output[] = '</tr>';
        foreach($contents as $id=>$qty){
        $sql = "SELECT *
        FROM `PRODUCT`
        WHERE `product_id`={$id}";
        if(is_numeric($id)){
        $cartresult=mysqli_query($dbconnect,$sql);
        while($cartRow = mysqli_fetch_array($cartresult)){
        $output[] = '<tr>';
            $output[] = '<td>'. $cartRow['p_name'] .'</td>';
            $output[] = '<td>'. $cartRow['p_desc'] .'</td>';
            $output[] = '<td>&pound;'. $cartRow['p_price'] .'</td>';
            $output[] = '<td><input type="text" name="qty'.$id.'" value="'.$qty.'" size="2" maxlength="2" /></td>';
            $output[] = '<td>&pound;'.$cartRow['p_price']*$qty.'</td>';
            $output[] = '<td width="100">
                <a href="mng_cart.php?action=delete&id='.$id.'">Remove</a></td>';
            $total += $cartRow['p_price']*$qty;
            $output[] = '</tr>';

        } // end while loop
        } // ends if statment
        } // end foreach
        $output[] = '</table>';
    $output[] = '<p>Grand Total: <strong>&pound;'.$total.'</strong></p>';
    $output[] = '<input type="submit" value="Update Cart" />';
    $output[] = '</form>';
} else { // if theres no items
$output [] = '<p> You have no items in your cart!</p>';
}
echo join('
',$output);
}
?>

<!doctype html>
<html>

    <head>
        <?php
include("inc/scriptpackage.inc.php");	
?>
        <meta charset="utf-8">
        <title>Untitled Document</title>
    </head>

    <body>
        <?php
include("inc/search.inc.php");	
include("inc/nav.inc.php");
include("inc/loginform.inc.php");
include("inc/cartdisplay.inc.php");
renderCartForm ();

if($_SESSION['cart']!=""&&$_SESSION['user_id']!=""){
	?>
        <a href="checkout1.php">Go to Checkout</a>
        <?php
}	

?>
    </body>

</html>