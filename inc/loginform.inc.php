<script type="text/javascript">

	//when loginform submittes (live agent)
$(document).on("submit", "#loginform", function () {
	//randon number to make each ajax call appear unique
	var randNum = Math.floor(Math.random() *1000000000);


	$.ajax({
		url: "mng_user.php?rand=" + randNum,
		dataType: 'text',
		type: 'POST',
		data: 'l_uname=' + $("[name='l_uname']").val() +
		'&l_pword=' + $("[name='l_pword']").val() +
		'&mode=login',
		beforeSend: function () {
			$('#loginload').html ('loading...');
		},
		complete:function () {
			$('#loginload').html ('');
		},
		success:function(result){
			$ ("#loginform").html ('').append (result);

		}
	});
	return false; //stops form submission normal
});
</script>

<?php if (isset($_SESSION['user_id'])) {

?>
<p>Welcome to mysite. <?php echo $_SESSION ['user_username'] ;?><a href="logout.php">Logout</a></p>
<?php } else { ?>

<form action="mng_user.php" method="post" id="loginform">
	<input type="text" name="l_uname" placeholder="uname" /><br/> 
	<input type="text" name="l_pword" placeholder="pword" /><br/>
	<input type="submit" value="Login" />
	<input type="hidden" name="mode" value="login" />
</form>
<p id="loginload"></p>
<?php } ?>