<?php require_once("header.html");
require("database_con.php");
require_once("nav.html"); ?>
<style>
#lg {
		font-family: Comic Sans MS;
	}
#error {
	color: red;
}
</style>
<fieldset>
<?php
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$error = array();
if(isset($_POST['submit'])){
if (empty($email)){
	array_push($error ,"Email cannot be empty</br>");
}
if(empty($password)){
	array_push($error, "Password cannot be empty</br>");
}
if(empty($error)){
	$q = "SELECT `Password`,`Username` FROM `Userdata` WHERE `Email`='$email' LIMIT 1";
	$check = mysqli_query($dbc, $q) or die("Error querying database");
	if(empty($check)){
		array_push($error, "Account does not exist</br>");
		}
	if(!empty($check)){
		$result = mysqli_fetch_array($check);
			if($password!=$result[0]){
				array_push($error, "Incorrect Password</br>");
			}			
		}
	if (empty($error)){
		session_start();
		$_SESSION['username'] = $result[1];
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		header("Location: index.php");
		}
	}
}
?>
<legend><h2>Login</h2></legend>
<em id=error><?php for($i=0;$i < count($error);$i++){ echo $error[$i]; } ?></em>
<br>
<b id=lg>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Email:<input type="text" name="email" required/></br>
Password:<input type="password" name="password" required/></br>
<input type="submit" name="submit" value="Login"/><br><br>
Don't have an account, then <a href="register.php">create</a> one.
</b>
</form>
</fieldset>
<?php 
mysqli_close($dbc);
require_once("footer.html"); ?>