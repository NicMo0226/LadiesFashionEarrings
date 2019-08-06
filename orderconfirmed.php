<?php
session_start();
include ("inc/dbconnect.inc.php");

function renderCustomer() {
	global $dbconnect;
	global $email;
	
	$customerDetails = mysqli_query($dbconnect,
						"SELECT *
						 FROM `customer`
						 WHERE `cu_id`=
						 {$_SESSION['cu_id']}"		   
	);
	while($cRow=mysqli_fetch_array($customerDetails)){
		
		$output[] =  $cRow['cu_fname'] ." " . $cRow['cu_sname'] . "<br />" ;
		$output[] =  $cRow['cu_phone'] . "<br />";
		$output[] =  $cRow['cu_email'] . "<br />";
		$email = $cRow['cu_email'];
	}
	$addressDetails = mysqli_query($dbconnect,
						"SELECT *
						 FROM `address`
						 WHERE `address_id`=
						 {$_SESSION['address_id']}"		   
	);
	while($aRow=mysqli_fetch_array($addressDetails)){
		
		$output[] =  $aRow['address_line1'] . "<br />" ;
		$output[] =  $aRow['address_line2'] . "<br />";
		$output[] =  $aRow['address_town'] . "<br />";
		$output[] =  $aRow['address_postcode'] . "<br />";
		
	}
	 join('
				',$output); 
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
		
		$output[] = '<table border="0">';
		$output[] = '<tr>';
		$output[] = '<td width="400">Product</td>';
		$output[] = '<td width="200">Category</td>';
		$output[] = '<td width="75">Price</td>';
		$output[] = '<td width="75">Quantity</td>';
		$output[] = '<td width="100">Total</td>';
		$output[] = '</tr>';
		foreach($contents as $id=>$qty) {
			$sql = "SELECT *
					FROM `product`
					WHERE `product_id`={$id}";
			if(is_numeric($id)){
				$cartresult=mysqli_query($dbconnect,$sql);
			
			while($cartRow = mysqli_fetch_array($cartresult)){
				$output[] = '<tr>';
				$output[] = '<td>'. $cartRow['product_name'] .'</td>';
				$output[] = '<td>'. $cartRow['product_category'] .'</td>';
				$output[] = '<td>&pound;'. $cartRow['product_price'] .'</td>';
				
				$output[] = '<td>'.$qty.'</td>';
				$output[] = '<td>'.'&pound;'.$cartRow['product_price']*$qty.'</td>';
				$total += $cartRow['product_price']*$qty;
				$output[] = '</tr>';
				
			} // end while loop
		} // ends if statment
	} // end foreach 
$output[] = '</table>';
$output[] = '<p>Grand Total: <strong>&pound;'.$total.'</strong></p>';

} 
	join('
				',$output);
}
//Email details
//multipart internet multimedia extension MIME boundary
$mimeBoundary = "-SparklesANDShines".md5(time());
//mail headers
$to = $email;
$subject = "Order confirmation from Sparkles and Shines";

$headers = "From:sparkles@ladiesfashionearrings.co.uk\n";
$headers.= "Reply-To <donotreply@ladiesfashionearrings.co.uk>\n";
$headers.= "MIME-Version: 1.0\n";
$headers.= "Content-Type: multipart/alternative; boundary='{$mimeBoundary}'\n";

//html email 
$message.="--{$mimeBoundary}\n";
$message.="Content-Type: text/html charset=UTF-8\n";
$message.="Content-Transfer-Encoding: 8bit\n\n";
$message.="<html>\n";
$message.="<body>\n";
$message.="<h1>Order Confirmation</h1>";
$message.=renderCustomer();
$message.=renderCartForm();
$message.="</body>";
$message.="</html>";

//final boundary
$message.="--{$mimeBoundary}--\n";
$to = $email;
//send email
$mailSent = @mail($to,$subject,$message,$headers);

?>

<!doctype html>
<html>

    <head>
        <?php 
include ("inc/scriptpackage.inc.php");
 ?>
        <title>Untitled Document</title>
    </head>

    <body>
        <?php
	if($_SESSION['message']!=""){
		echo $_SESSION['message'];
		$_SESSION['message']="";
	}
 	
?>
        <?php include ("inc/nav.inc.php"); ?>
        <h1>Your order has been placed with Jasper Man <br />
            Thank you for shopping with us today!</h1>
        <?php 
if ($mailSent) {
	echo "A confirmation e-mail has been sent to you, please check your inbox!";
	echo "<p>Thank you for shopping with Sparkles and Shine <br/>
			Guaranteed to make you stand out from the crowd!!</p>";
	$_SESSION['cart']="";
} else {
	echo "There is a problem with your confirmation e-mail, please refresh";
}
 ?>

    </body>

</html>