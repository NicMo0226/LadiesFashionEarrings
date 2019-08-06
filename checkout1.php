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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="index.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Slab">

    <body>
        <?php
	if($_SESSION['message']!=""){
		echo $_SESSION['message'];
		$_SESSION['message']="";
	}
 	

?>
        <?php 
	include ("inc/nav.inc.php"); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 col-xl-8 col-md-8 col-lg-8 col-xl-8 col-md-offset-2">
                    <h1>Checkout Stage: 1</h1>
                    <form method="post" action="mng_checkout.php">
                        <input class="chkform" type="hidden" name="stage" value="1">
                        <input class="chkform" type="text" name="fname" placeholder="First Name(s)"><br />
                        <input class="chkform" type="text" name="sname" placeholder="Surname"><br />
                        <input class="chkform" type="text" name="phone" placeholder="Telephone"><br />
                        <input class="chkform" type="text" name="email" placeholder="Email"><br />
                        <input class="chkform" type="text" name="line1" placeholder="Address Line 1"><br />
                        <input class="chkform" type="text" name="line2" placeholder="Address Line 2"><br />
                        <input class="chkform" type="text" name="town" placeholder="Town"><br />
                        <input class="chkform" type="text" name="county" placeholder="County"><br />
                        <input class="chkform" type="text" name="pcode" placeholder="Post Code"><br />


                        <a class="btn" href="checkout2.php" role="button">Submit</a>

                    </form>
                </div>
            </div>
        </div>
    </body>

</html>