<?php
require_once("header.html");
require_once("nav.html");
require_once("database_con.php");
 ?>
<style>
#error {
	color: red;
}
fieldset {
	font-family: Georgia;
}
</style>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" />
<h3 id=error >
<?php

//Check Submit is clicked or not?
$error = array();
if(!empty($_POST['submit'])){
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

if(empty($username)){
	array_push($error,"Username cannot be empty</br>");
}

 if(empty($password) or empty($confirm)) {
	array_push($error, "Password cannot be empty</br>");
	}
if ($password != $confirm) {
	array_push($error, "Passwords do not match</br>");
	}

//Register User
if (empty($error)){
	$verify_name = "SELECT `Username` FROM `Userdata` WHERE `Username`='$username'";
	$verify_email = "SELECT `Username` FROM `Userdata` WHERE `Email`='$email'";
	$check = mysqli_query($dbc, $verify_name) or die(mysqli_error($dbc));
	$check2 = mysqli_query($dbc, $verify_email) or die(mysqli_error($dbc));
	$carray = mysqli_fetch_array($check);
	$carray2 = mysqli_fetch_array($check2);
	if(!empty($carray)){
	array_push($error, "Username Already Exists</br>");
	}
	if(!empty($carray2)){
	array_push($error, "Email Already Exists</br>");
	}
	if(empty($error)) {
	$query = "INSERT INTO Userdata(Username, Email, Password) VALUES ('$username', '$email', '$password')";
	$query2 = "INSERT INTO Profile(Username) VALUE ('$username')";
	mysqli_query($dbc, $query2);
	$result = mysqli_query($dbc, $query) or die("Error Querying Database");
	session_start();
		$_SESSION['username'] = $username;
  session_write_close();
	header('Location: profile-edit.php');
	 }
	}
}
?>
</h3>
<fieldset>
<legend><h4><em>Register</em></h4></legend>
<em id=error><?php for($i=0;$i < count($error);$i++){ echo $error[$i]; } ?></em>
<br>
<b>We recommend, do not use your real name and email for privacy concerns.😇</b><br><br>
  Username:<input type="text" name="username"  maxlength="10" placeholder="Fake Name" required/><br>
  Email:<input type="email" maxlength="20" name="email" placeholder="fake@email.com" required/><br>
  Create-Password:<input type="password" maxlength="10" name="password" placeholder="Password" required/><br>
  Confirm-Password:<input type="password" maxlength="10" name="confirm" placeholder="Password" required/><br>
  <br>
  <input type="submit" name="submit" value="Register"/><br><br>
  
  Already have an account ?, then <a href="login.php">login</a>.<br>
</form>
</fieldset>
<?php 
mysqli_close($dbc);
require_once("footer.html"); ?>