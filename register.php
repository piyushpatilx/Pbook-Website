<style>
#error {
	color: red;
}
#rg {
 font-family: Comic Sans MS;
}
form {
	position: center;
	}
legend {
font-size: 150%;
font-style: italic;
}
fieldset {
border-width: 6px;
}
</style>
<?php require_once("header.html");
require_once("nav.html");
require("database_con.php");
 ?>
<fieldset>
<legend>Register</legend>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" />
<h3 id=error >
<?php
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm = trim($_POST['confirm']);
$error = array();

//Check Submit is clicked or not?
if(!empty($_POST['submit'])){
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
if ($done==0){
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
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
	header('Location: index.php');
	 }
	}
}
?>
</h3>
<em id=error><?php for($i=0;$i < count($error);$i++){ echo $error[$i]; } ?></em>
<br>
<b id=rg>
  Username:<input type="text" name="username"  maxlength=12 required/><br>
  Email:<input type="email" name="email" required/><br>
  Create-Password:<input type="password" name="password" required/><br>
  Confirm-Password:<input type="password" name="confirm" required/><br>
  <input type="submit" name="submit" value="Register"/><br><br>
  
  Already have an account ?, then <a href="login.php">login</a>.<br>
  </b>
</form>
</fieldset>
<?php 
mysqli_close($dbc);
require_once("footer.html"); ?>