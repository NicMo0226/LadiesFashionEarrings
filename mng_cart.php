<?php 
session_start();

if($_GET['action']=='update'){
	
	//update cart
	$newcart = ""; // new cart
	foreach($_POST as $key=>$qty){  //loops throught form boxes
		if(stristr($key,'qty')){  //select qty textboxes
			$id = str_replace('qty','',$key);  // just get id
			if($qty!=0&&is_numeric($qty)){
				for($i=0;$i<$qty;$i++){ //keep looping while in qty
					if($newcart==""){
						$newcart=$id;
			
				} else {
					$newcart.=",".$id; //separate with comma
				}
					
				}	
			}  //if quantity a positive number
		}  //end if qty
		
	}  //end for each
	$_SESSION['cart']=$newcart;
	header('location:cart.php');
}

if($_GET['action']=='delete'){
	
	$cart = $_SESSION['cart'];  //get current cart
	$newcart ="";  //blank cart
	
	$items = explode(',',$cart); //create items array
	
	foreach($items as $item) {  //loop through items
		if($_GET['id']!=$item) {  // if not selected for delete
		   if($newcart=="") {
				$newcart=$item;
			
		} else {
			$newcart.=",". $item; //separate with comma
		}
		
		} // otherwise item doesn't get added- hence deleted 
	}
	$_SESSION['cart']=$newcart;
	header('location: cart.php');
}

if ($_POST['action']=='add') {   //if action is add
	!$_SESSION['cart'] ? //if no cart session
	$_SESSION['cart']=$_POST['product_id'] : //if true
	$_SESSION['cart']=$_SESSION['cart'] . "," . $_POST['product_id'];
	//if false
	$cart=$_SESSION['cart'];
	if (!$cart) {
	?>
<div id="holdcart">
    <p id="cartmessage">There's nowt in your <a href="cart.php">shopping cart</a> mate</p>
    <span id="cartload"></span>
</div>
<?php  
}	else {	
    // parse cart variable
    $items = explode(',',$cart);
    //if the items greater than 1, then s will be stored in $s
    $s = (count($items)>1) ? 's' : '';
    $count = count($items);
    ?>
<div id="holdcart">
    <p id="cartmessage">There's <?php echo $count; ?> item <?php echo $s; ?> in your <a href="cart.php">shopping cart</a> mate</p>
    <span id="cartload"></span>
</div>
<?php   
} //end cart details check
} //end add check

 