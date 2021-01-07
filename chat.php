<?php
require_once("login_check.php");
require_once("header.html");
require_once("nav.html");
require_once("database_con.php");
?>
<style>
	 .chat {
		font-size: 13px;
  font-family: Georgia;
  
	}
	#received {
border-bottom-right-radius: 20px;
  border-top-right-radius: 20px;
  border-bottom-left-radius: 20px;
  width: 65%;
	}
	#sent {
border-bottom-left-radius: 20px;
  border-top-left-radius: 20px;
  border-bottom-right-radius: 20px;
  width: 65%;
  position: relative;
  top: 5px;
  left: 85px;
	}
	 .date {
	 	font-size: 7px;
   font-family: Monospace;
	 }
</style>

<br><a href="chat-send.php"><button>Start Chat</button></a><br>

<?php
$username = $_SESSION['username'];
$query = "SELECT * FROM `Chats` WHERE `receiver` = '$username'";
$query2 = "SELECT * FROM `Chats` WHERE `sender` = '$username'";

$result = mysqli_query($dbc, $query);
$result2 = mysqli_query($dbc, $query2);

while($q = mysqli_fetch_array($result)){

 ?>
<br>
<fieldset class="chat" id="received">
<em class="date">Sent by: <a href="show-profile.php?name=<?php echo $q['sender'];?>">
	<?php echo $q['sender']; ?></a>
 At: <?php echo $q['time']; ?></em>
<hr>
<?php echo nl2br($q['chat']); ?><br>

</fieldset>
<?php 
}
while($q2 = mysqli_fetch_array($result2)){

 ?>
<br>
<fieldset class="chat" id="sent">
<em class="date">
	Sent to: <a href="show-profile.php?name=<?php echo $q2['receiver'];?>">
		<?php echo $q2['receiver']; ?>
	</a>
   At: <?php echo $q2['time']; ?></em>
<hr>
<?php echo nl2br($q2['chat']); ?><br><hr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" value="<?php echo $q2['id']; ?>" name='id' >
	<input type="submit" value="x" name="del-chat" >
</form>
</fieldset>
<?php 
}
if(isset($_POST['del-chat'])){
	$id = $_POST['id'];
	$qd = "delete from `Chats` where `id` = '$id'";
	$er = mysqli_query($dbc ,$qd) or die("Error Cannot delete Message");
	header("Location: chat.php");
}

mysqli_close($dbc);
require_once("footer.html"); ?>