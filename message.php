<?php
session_start();
if(!isset($_SESSION['username'])){
 header("Location: login.php");
}
require_once("header.html");
require_once("nav.html");
?>
<br>
<a href="message-send.php"><button>Start Chat</button></a>
<br>
<?php
require("database_con.php");
$username = $_SESSION['username'];
$query = "SELECT * FROM `Chats` WHERE `receiver` = '$username'";
$result = mysqli_query($dbc, $query);
while($q = mysqli_fetch_array($result)){

 ?>
<style>
b {
 font-style: italic;
 font-family: Times New Roman;
}
form {
font-family: Monospace;
margin-top: 10px;
}
</style>
<br>
<hr>
<b>From: </b><a href="show-profile.php?name=<?php echo $q['sender'];?>"><?php echo $q['sender']; ?></a><br>
<b>Date & Time: </b><?php echo $q['time']; ?><br>
<b>Message: </b><?php echo $q['chat'] ?><br>
<?php 
}
mysqli_close($dbc);
require_once("footer.html"); ?>