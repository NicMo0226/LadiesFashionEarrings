<?php
//connect to database
include("inc/dbconnect.inc.php");
//get searchterm from url / form submission
session_start(); //creates session
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
    </head>

    <body>

        <?php

if($_SESSION['message']!="") {
echo $_SESSION['message'];
$_SESSION['message']="";

}

?>
        <form action="mng_user.php" method="post">

            <input type="text" name="r_uname" placeholder="uname" /><br />
            <input type="text" name="r_pword1" placeholder="pword" /><br />
            <input type="text" name="r_pword2" placeholder="pword" /><br />
            <input type="submit" value="Register" />
            <input type="hidden" name="mode" value="register" />


        </form>
    </body>

</html>