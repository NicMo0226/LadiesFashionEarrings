<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
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

<h1>Checkout Stage: 2</h1>

Continue with:
<!--PayPal-->
<a href="checkout3.php"> <img src="images/ppal.png" alt="PayPal">PayPal</a>
<a href="checkout3.php"> <img src="images/stripe.png" alt="Stripe">Stripe</a>
<a href="checkout3.php"> <img src="images/card.png" alt="SecureCard">Secure Visa/Mastercard</a>

 

	</body>
</html>

