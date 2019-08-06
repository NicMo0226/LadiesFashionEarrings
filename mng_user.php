<?php
include ("inc/dbconnect.inc.php"); 
    session_start();
     

  if($_POST['mode']=="register") { // if registration

	$valid = true; //validation flag

	if($_POST['r_uname']=="") //if no username
    $valid=false;

    if($_POST['r_pword1']=="") //if no password
    $valid=false;

     //if passwords do not match
     if($_POST['r_pword1']!=$_POST['r_pword2']) 
    $valid=false;

     if(!$valid) {    //if not valid
        $_SESSION['message']="Please enter valid data.";
        header("location: register.php");
		} else {
			//echo "Valid!";

			$userCheck = mysqli_query($dbconnect,
					"SELECT *
					 FROM `USER`
					 WHERE `user_username`=
					 '{$_POST['r_uname']}'"		
			);
			//check username availability
			if (mysqli_num_rows($userCheck)>0) {
			 	$_SESSION['message']="Username is taken";
        header("location: register.php");
			 } else {
			 	$username = $_POST['r_uname'];
			 	//hashed password
			 	$password = md5($_POST['r_pword1']);
			 	//try insertion
			 	$register = mysqli_query($dbconnect,
			 				"INSERT INTO `USER`
			 			(`user_username` ,`user_password`, `user_level`)
			 				VALUES 
			 				('{$username}','{$password}', 'user')"

			 	);

				if ($register) {
	           $_SESSION['message']="Sign up successful";
			} else {
				 $_SESSION['message']="There has been a registration error";
			}
				header("location: register.php");
			} //end user check
		} //end validation check
  }//end registration routine


//login vvvvvvv
if($_POST['mode']=="login") {	//if login routine
  		$valid = true; //validation flag

	if($_POST['l_uname']=="") //if no username
    $valid=false;

    if($_POST['l_pword']=="") //if no password
    $valid=false;

    if (!$valid) { //if not valid
    	?>
<input type="text" name="l_uname" placeholder="uname" /><br />
<input type="text" name="l_pword" placeholder="pword" /><br />
<input type="submit" value="Login" />
<input type="hidden" name="mode" value="login" />
<p>Please enter your details</p>

<?php 
    } else {
    		$username = $_POST['l_uname'];
			 	//hashed password
			 	$password = md5($_POST['l_pword']);

			 	$login = mysqli_query($dbconnect,
			 		"SELECT *
			 		FROM `USER`
			 		WHERE `user_username`='{$username}'
			 		AND `user_password`='{$password}'"

			 	); //check username and password match

			 	if (mysqli_num_rows($login)>0) { 

			 		while($row=mysqli_fetch_array($login)) { 
			 			$_SESSION['user_id']=$row['user_id'];
			 			$_SESSION['user_username']=$row['user_username'];
			 			$_SESSION['user_level']=$row['user_level'];
			 			
			 		}  ?>


<p>Welcome to Sparkles AND Shines <?php echo $_SESSION['user_username'] ?> </p>


<?php
			 	} else {
                     ?>

<input type="text" name="l_uname" placeholder="uname" /><br />
<input type="text" name="l_pword" placeholder="pword" /><br />
<input type="submit" value="Login" />
<input type="hidden" name="mode" value="login" />
<p>Username and passwords do not match</p>

<?php
			 	}

    } //end validation check
  } //end login routine