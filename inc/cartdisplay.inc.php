<?php 
if (isset($_SESSION['cart'])) { //if there's a cart
	$cart= $_SESSION['cart'];
} else {
    $_SESSION['cart']="";

} //end cart check

if (!$cart) { //if no cart details
	?>
<div id="holdcart">
    <p id="cartmessage">There's nowt in your <a href="cart.php">shopping cart</a> mate</p>
    <span id="cartload"></span>
</div>
<?php  
}	else {	
    // parse cart variable
    $items = explode(',',$cart); //stores in array based on deliminator / seperator
    //if the items greater than 1, then s will be stored in $s
    $s = (count($items)>1) ? 's' : '';
    $count = count($items);
    ?>

<?php   
} //end cart details check


 ?>