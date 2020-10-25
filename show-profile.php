<?php
 require_once("login_check.php");
 require_once("header.html");
 require_once("nav.html");
 require_once("database_con.php");
 ?>
<style>
 label  {
    font-family: Monospace;
  }
  
</style>
<?php
$name = $_GET['name'];
$query = "SELECT * FROM `Profile` WHERE `Username` = '$name'";
$r = mysqli_query($dbc, $query) or die("Error Querying");

$result = mysqli_fetch_array($r);
?>
<br>
<?php if(!empty($result)){ ?>
<fieldset>
<legend><b><?php echo $result['Username']; ?></b></legend>
<label>Profile Picture:</label><br>
<?php 
if(!empty($result['Photo'])){ ?>
<img src="<?php echo $result['Photo']; ?>" height="200px" width="200px"><br>
<?php } ?>
<label>Birthdate: </label><?php echo $result['Birthdate']; ?><br>
<label>Gender: </label><?php echo $result['Gender']; ?><br>
<label>Relationship Status: </label><?php echo $result['Relationship']; ?><br>
<label>Interested In: </label><?php echo $result['Interest']; ?><br>
<form action=chat-send.php method=get >
<input type=hidden name=name value="<?php echo $result[0]; ?>" />
<input type=submit value="Send Message" />
</form>
</fieldset>
<?php }
else {
	echo "<h4> Profile Not Found</h4>";
} ?>
<?php
mysqli_close($dbc);
require_once("footer.html");
?>