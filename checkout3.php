<?php
session_start();

include("inc/dbconnect.inc.php");

function renderCustomer (){
	global $dbconnect;
	
	$customerDetails = mysqli_query($dbconnect,
						"SELECT *
						 FROM `customer`
						 WHERE `cu_id`=
						 {$_SESSION['cu_id']}"		   
	);
	while($cRow=mysqli_fetch_array($customerDetails)){
		
		echo $cRow['cu_fname'] ." " . $cRow['cu_sname'] . "<br />" ;
		echo $cRow['cu_phone'] . "<br />";
		echo $cRow['cu_email'] . "<br />";
	}
	$addressDetails = mysqli_query($dbconnect,
						"SELECT *
						 FROM `address`
						 WHERE `address_id`=
						 {$_SESSION['address_id']}"		   
	);
	while($aRow=mysqli_fetch_array($addressDetails)){
		
		echo $aRow['address_line1'] . "<br />" ;
		echo $aRow['address_line2'] . "<br />";
		echo $aRow['address_town'] . "<br />";
		echo $aRow['address_county'] . "<br />";
		echo $aRow['address_postcode'] . "<br />";
		
	}
}

//render cart function definition
function renderCartForm()
{
	global $dbconnect;
	$cart = $_SESSION['cart']; //get cart session contents
	if($cart){  // if there's any items
		$items = explode(',',$cart); //creates items array from the cart
		
		$contents = array();
		foreach($items as $item){
			//set to 1 or add 1
			$contents[$item] = (isset($contents[$item])) ?
				$contents [$item]+1 : 1;
		}
		$output[] = '<form action="mng_checkout.php?stage=3"
						method="post" id="cart">';
		$output[] = '<table border="0">';
		$output[] = '<tr>';
		$output[] = '<td width="400">Product</td>';
		$output[] = '<td width="75">Price</td>';
		$output[] = '<td width="75">Quantity</td>';
		$output[] = '<td width="100">Total</td>';
		$output[] = '</tr>';
		foreach($contents as $id=>$qty){
			$sql = "SELECT *
					FROM `product`
					WHERE `product_id`={$id}";
			if(is_numeric($id)){
				$cartresult=mysqli_query($dbconnect,$sql);
			
			while($cartRow = mysqli_fetch_array($cartresult)){
				$output[] = '<tr>';
				$output[] = '<td>'. 
				'<input name="pid' .$id . '" type="hidden" value="'.$id.'"/>'	
					. $cartRow['product_name'] .'</td>';
				$output[] = '<td>'. $cartRow['product_description'] .'</td>';
				$output[] = '<td>&pound;'. $cartRow['product_price'] .'</td>';
				
				$output[] = '<td><input type="hidden" name="qty'.$id .'" value="'.$qty.'" />'.qty.'</td>';
				$output[] = '<td>'.
				'<input type="hidden" name="net'.$id.'" value="'
					.$cartRow['product_price']*$qty.'"/>'	
				.'&pound;'.$cartRow['product_price']*$qty.'</td>';
				$total += $cartRow['product_price']*$qty;
				$output[] = '</tr>';
				
			} // end while loop
		} // ends if statment
	} // end foreach 
	$output[] = '</table>';
	$output[] = '<p>Grand Total: <strong>&pound;'.$total.'</strong></p>';
	$output[] =	'<input type="hidden" name="total" value="'.$total .'"/>';
	$output[] = '<input type="submit" value="Complete Order" />';
	$output[] = '</form>';
	} else {  // if theres no items 
		$output [] = '<p> You have no items in your cart!</p>';
	}
	echo join('
				',$output);
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<?php 
include ("inc/scriptpackage.inc.php");
 ?>	 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="index.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="header.css">
	  <link rel="stylesheet" href="footer.css">
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Slab" >
 </head>

<body>
<?php
	if($_SESSION['message']!=""){
		echo $_SESSION['message'];
		$_SESSION['message']="";
	}
	
?>
<h1>Checkout 3</h1>
<?php
	renderCustomer();
	renderCartForm();
?>
</body>
</html>