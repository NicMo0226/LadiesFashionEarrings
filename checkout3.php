<style>


</style>
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


						$output[] = '<div class="container-fluid">';
						$output[] = '<div class="row">';
						$output[] = '<div class="col-sm-10 col-xl-10 col-md-10 col-lg-10 col-xl-10 col-md-offset-1">';
		$output[] = '<table border="0">';
		$output[] = '<tr>';
		$output[] = '<th width="300">Product</th>';
		$output[] = '<th width="500">Description</th>';
		$output[] = '<th width="75">Price</th>';
		$output[] = '<th width="75">Qty</th>';
		$output[] = '<th width="100">Total</th>';
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
				
				$output[] = '<td><input type="hidden" name="qty'.$id .'" value="'.$qty.'" />'.$qty.'</td>';
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

	$output[] = '</div>';
	$output[] = '</div>';
	$output[] = '</div>';
	$output[] = '<p class="total" id="gTotal">Grand Total: <strong>&pound;'.$total.'</strong></p>';
	$output[] =	'<input type="hidden" name="total" value="'.$total .'"/>';
	
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="index.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Slab">
    </head>

    <style>
    #gTotal {
        color: black !important;
        font-size: .8em;
        text-align: right;
        padding-right: 5em;
    }

    .Confirm {
        padding-left: 5em;
        padding-bottom: 3em;
        padding-top: 2em;

    }

    .pay {
        padding-bottom: 2em;
    }
    </style>
    <?php include ("inc/nav.inc.php") ?>

    <body>
        <?php
	if($_SESSION['message']!=""){
		echo $_SESSION['message'];
		$_SESSION['message']="";
	}
	
?>
        <h3 class="Confirm">Final Stage - Confirm your order and details...</h3>
        <?php
	renderCustomer();
	renderCartForm();
?>

        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-6 col-xl-6 col-md-6 col-lg-6 col-xs-6 col-md-offset-3">

                    <h4><b> Continue with:</b></h4>
                    <div class="pay">
                        <div class="row">

                            <div class="col-sm-6 col-xl-6 col-md-6 col-lg-6 col-xl-6">
                                <a href="orderconfirmed.php"> <img src="images/ppal.png" alt="PayPal" width="100"></a>
                            </div>
                            <div class="col-sm-6 col-xl-6 col-md-6 col-lg-6 col-xs-6">

                                <a href="orderconfirmed.php"> <img src="images/stripe.png" alt="Stripe" width="100"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <?php include ("inc/footer.inc.php") ?>

</html>