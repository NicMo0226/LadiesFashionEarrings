<?php 
session_start();
include ('inc/dbconnect.inc.php');
//include( 'inc/header.inc.php' );



$id = $_GET[ 'user_id' ];
//if users is not logged in return to register.php
if ( isset( $_SESSION[ 'user_username' ] ) ) {
	$userLoggedIn = $_SESSION[ 'user_username' ];
	$user_details_query = mysqli_query( $con, "SELECT * FROM USER WHERE user_username='$userLoggedIn'" ); //fetches users data
	$user = mysqli_fetch_array( $user_details_query );
} else {
	header( "Location: register.php" );
}


//render cart function definition
function renderCartForm () {
	global $dbconnect;
	$cart = $_SESSION['cart']; //get cart session content
	if ($cart) {	//if there's any items
		$items = explode(',', $cart); //creates items array from cart

		$contents = array();
		foreach($items as $item)	{ 
		//set to 1 or add 1
			$contents[$item] = (isset($contents[$item])) ? 
				$contents[$item]+1 : 1;
		}
		$output[] = '<div class="container-fluid">';
						$output[] = '<div class="row">';
						$output[] = '<div class="col-sm-8 col-xl-8 col-md-8 col-lg-8 col-xl-8 col-md-offset-2">';
						$output[] = ' <h3>Shopping Cart</h3>';
		$output[] = '<form action="mng/mng_cart.php?action=update"
						method="post" id="cart">';
						
			$output[] = '<table class="table table-bordered table-striped">';
			$output[] = '<tr>';
			$output[] = '<th>Product</th>';
			$output[] = '<th>Category</th>';
			$output[] = '<th width="75">Price</th>';
			$output[] = '<th class="qtty">Quantity</th>';
			$output[] = '<th>Total</th>';
			$output[] = '<th>Cancel</th>';
			$output[] = '</tr>';
			foreach ($contents as $id=>$qty) {
				$sql = "SELECT *
				FROM `product`
				WHERE `product_id`={$id}";
			if(is_numeric($id)) {
			$cartresult=mysqli_query($dbconnect,$sql);
			while($cartRow = mysqli_fetch_array($cartresult)) {
				$output[] = '<tr>';
				$output[] = '<td>'.$cartRow['product_name'] . '</td>';
				$output[] = '<td>'.$cartRow['product_category'] . '</td>';
				
				$output[] = '<td>&pound;'.$cartRow['product_price'] . '</td>';
				$output[] = '<td ><input type="text" name="qty'.$id.'" value="'.$qty.'" size="2" maxlength="2" ></td>';
				$output[] = '<td width="100">&pound; '.$cartRow['product_price'] *$qty . '</td>';
				$output[] = '<td class="textleft"><a href="mng/mng_cart.php?action=delete&id='.$id.'">X</a></td>';
				$total += $cartRow['product_price'] * $qty;
				$output[] = '</tr>';
				

				} //end while

			} // ends if	
		} //ends for each
		$output[] = '<tr>';
		$output[] = '<td></td>';
		$output[] = '<td></td>';
		$output[] = '<td></td>';
		
		
		$output[] = '<td><input type="submit" class="btn cartbtn" value="Update Cart"><br></td>';
	$output[] = '<td>Grand Total: <strong>&pound;'.$total.'</strong></td>';
	$output[] = '<td> <a class="btn checkoutbtn btn-outline-secondary" type="submit" href="checkout1.php" role="button">Checkout</a></td>';
		
		$output[] = '</tr>';
		$output[] = '</table>';
		
	
		$output[] = '</form>';
		$output[] = '</div>';
		$output[] = '</div>';
		$output[] = '</div>';
	} else {	//if there's no items
		$output[] = '<p>You have no items in your cart!</p>';
	}
	echo join ('
				',$output);
}

			
 ?>

<style>
input.qtty {
    width: 2em !important;
}
</style>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="footer.css">
    <title></title>
    <?php 
include ("inc/scriptpackage.inc.php");
 ?>
</head>
<?php 
	include ("inc/nav.inc.php"); 
include ("inc/cartdisplay.inc.php");
include ("inc/loginform.inc.php"); 
renderCartForm();

?>

<body>
</body>
<?php  include ("inc/footer.inc.php"); ?>

</html>