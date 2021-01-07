<?php
session_start();
if(isset($_SESSION['username'])){
	header('Location: index.php');
}
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
<script src="./jquery.js" ></script>
<script>
	$(document).ready(function(){
  var check = 0;
 $('#ck').on('click', function(){
	if(check == 0){
	$('#pass').attr('type', 'text');
	check = 1;
	}
else if(check == 1){
	$('#pass').attr('type', 'password');
	check = 0;
	}
	});
});
</script>
<fieldset>
<?php 
$error = array();
if(isset($_POST['submit'])){
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));
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
<b>We recommend, do not use your real name and email for privacy concerns.😇</b><br><br>
Email:<input type="email" maxlength="20" name="email" placeholder="fake@email.com" required/></br>
Password:<input id="pass" type="password" maxlength="10" name="password" placeholder="Password" required/>
</br>Show Password:<input type="checkbox" id=ck>
<br><input type="submit" name="submit" value="Login"/><br><br>
Don't have an account, then <a href="register.php">create</a> one.
<br>What is <a href="./about.php">Pbook</a> ?
</form>
</fieldset>
<?php 
mysqli_close($dbc);
require_once("footer.html");
?>