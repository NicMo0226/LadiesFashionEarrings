<?php
$hostname = "localhost";
$dbname = "sparkles_db";
$dbusername = "nic";
$dbpassword = "T102026?m";

//connect to MySQL server and store in
//$dbconnection variable
$dbconnect = mysqli_connect($hostname,  $dbusername, $dbpassword, $dbname);
//test connection has worked; 
//if there is not (!) a connection...
if(!$dbconnect){
//message to user / stop scripts
	die("Can't connect to the database");
} else {
	echo "We have connected";
}





