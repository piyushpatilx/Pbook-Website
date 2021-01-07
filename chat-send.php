<?php
require_once("login_check.php");

require_once("header.html");
require_once("nav.html");
require_once("database_con.php");
?>

<?php
if(isset($_POST['send'])){
$username = $_SESSION['username'];
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
 header("Location: chat.php");
 }
else{
for($e=0;$e < count($error);$e++){
	echo "<em id='error' >$error[$e]</em>";
  }
}
}
?>
<style>
 form {
  font-family: Sans-Serif;
  margin-top: 20px;
 }
 #error {
 	color: red;
 }
</style>
<br><fieldset>
<legend><em>Start Chat</em></legend>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method=post >
 To:<input type=text maxlength="13" name=to value="<?php if(isset($_GET['name'])){ echo $_GET['name']; } ?>" required />
  <input type=hidden maxlength="13" value="<?php echo $username ?>" name=from /><br>
  Chat:<br>
 <textarea rows=5 cols=30 required maxlength="399" name=message ></textarea>
  <br><br>
   <input type=submit name=send value=Send />
  </form>
 </fieldset>
<?php 
mysqli_close($dbc);
require_once("footer.html"); ?>