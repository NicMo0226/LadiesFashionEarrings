<?php
include("inc/dbconnect.inc.php");
session_start(); //creates session
?>
<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script type="text/javascript" src="js/register.js"></script>
        <link rel="stylesheet" href="style.css">


        <title></title>
        <?php 
include ("inc/scriptpackage.inc.php");
 ?>
    </head>

    <body>
        <?php
if($_SESSION['message']!="") {
echo $_SESSION['message'];
$_SESSION['message']="";
}
?>

        <body>
            <?php
	if(isset($_POST['register_button'])) {
		echo '
		<script>
			$(document).ready(function() {
				$("#first").hide();
				$("#second").show();
			});
		</script>
		';
	}
?>

            <?php include ("inc/nav.inc.php") ?>
            <div class="container-fluid ">
                <div class=" row">
                    <div class="col-md-4 col-md-offset-4 text-center login-box" style="">
                        <h4 class="signup">Login or sign up below</h4>
                        <hr />
                        <div id="first">
                            <form action="mng_user.php" method="post" id="loginform" class="errorform">
                                <input type="email" name="l_uname" placeholder="Email" /><br />
                                <input type="password" name="l_pword" placeholder="Password" /><br />
                                <input type="submit" value="Login" />
                                <input type="hidden" name="mode" value="login" /><br>
                                <a class=" LoginLink" href="#" id="signup" class="signup">Need an account? Register here</a>
                            </form>

                        </div>
                        <!--register form-->
                        <div id="second">
                            <form action="mng_user.php" method="post" class="errorform">
                                <input type="email" name="r_uname" placeholder="Email" /><br />
                                <input type="password" name="r_pword1" placeholder="Password" /><br />
                                <input type="password" name="r_pword2" placeholder="Repeat Password" /><br />
                                <input type="submit" value="Register" />
                                <input type="hidden" name="mode" value="register" /><br />



                                <?php if(in_array("You are now registered. Please login!<br>", $error_array)) echo "<h2'>You are now registered. Please login!</h2><br>"; ?>
                                <a class="LoginLink" href="#" id="signin" class="signin">Already have an account? Login here</a>

                            </form>
                            <p id="loginload"></p>
                        </div>
                    </div>

                </div>
            </div>
        </body>
        <?php include ("inc/footer.inc.php") ?>

</html>