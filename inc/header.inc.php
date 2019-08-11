<!doctype html>
<?php
session_start();
include( 'inc/dbconnect.inc.php' );

//if user is not logged in return to register.php
if ( isset( $_SESSION[ 'user_username' ] ) ) {
	$userLoggedIn = $_SESSION[ 'user_username' ];
	$user_details_query = mysqli_query( $con, "SELECT * FROM USER WHERE user_username='$userLoggedIn'" ); //fetches user data
	$user = mysqli_fetch_array( $user_details_query );

} else {
  ?>

<p>Welcome to Sparkles AND Shines <?php echo $_SESSION['user_username'] ?> </p>
<?php
}
?>