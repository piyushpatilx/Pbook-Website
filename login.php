<?php
require_once("header.html");
require_once("database_con.php");
require_once("nav.html"); ?>
<style>
fieldset {
		font-family: Georgia;
	}
#error {
	color: red;
}
</style>
<fieldset>
<?php
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));
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
 $result = mysqli_fetch_array($check);
	if(empty($result)){
		array_push($error, "Account does not exist</br>");
		}
	if(!empty($result)){
				if($password!=$result[0]){
				array_push($error, "Incorrect Password</br>");
			}			
		}
	if (empty($error)){
		session_start();
		$_SESSION['username'] = $result[1];
		session_write_close();
		header("Location: index.php");
		}
	}
}
?>
<legend><h4><em>Login</em></h4></legend>
<em id=error><?php for($i=0;$i < count($error);$i++){ echo $error[$i]; } ?></em>
<br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Email:<input type="email" maxlength="20" name="email" required/></br>
Password:<input type="password" maxlength="10" name="password" required/></br>
<br><input type="submit" name="submit" value="Login"/><br><br>
Don't have an account, then <a href="register.php">create</a> one.
</form>
</fieldset>
<?php 
mysqli_close($dbc);
require_once("footer.html"); ?>