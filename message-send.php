<?php
session_start();
if(!isset($_SESSION['username'])){
 header("Location: login.php");
}
$username = $_SESSION['username'];
require_once("header.html");
require_once("nav.html");
require("database_con.php");
?>

<?php
if(isset($_POST['send'])){
$to = trim($_POST['to']);
$message = trim($_POST['message']);
$error = array();

if(empty($to)){
 array_push($error, "Username cannot be Empty<br>");
}
if(empty($message)){
 array_push($error ,"Message Cannot be Empty<br>");
}
if(!empty($to)){
$check = "SELECT `Username` FROM `Userdata` WHERE `Username` = '$to'";
$ch = mysqli_query($dbc, $check) or die("Error checker");
$checker = mysqli_fetch_array($ch);
if(empty($checker[0])){
 array_push($error,"Username Not found<br>");
 }
}
if(empty($error)){
	$time = date('d M Y h:i a');
 $send = "INSERT INTO Chats(sender, receiver, chat, time) VALUES ('$username','$to','$message', '$time')";
 $q = mysqli_query($dbc, $send) or die(mysqli_error($dbc));
 header("Location: message.php");
 }
else{
for($e=0;$e < count($error);$e++){
	echo $error[$e];
  }
}
}
?>
<style>
 form {
  font-family: Sans-Serif;
  margin-top: 20px;
 }
</style>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method=post >
 To:<input type=text maxlength="13" name=to value="<?php echo $_GET['refer']; ?>" required />
  <input type=hidden maxlength="13" value="<?php echo $username ?>" name=from /><br>
  Message:<br>
 <textarea rows=5 cols=30 required maxlength="399" name=message ></textarea>
  <br><br>
   <input type=submit name=send value=Send />
  </form>
<?php 
mysqli_close($dbc);
require_once("footer.html"); ?>