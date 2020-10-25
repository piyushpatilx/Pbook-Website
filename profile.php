<?php
require_once("login_check.php");
 require_once("header.html");
 require_once("nav.html");
 require_once("database_con.php");
 ?>
<style>
  label {
  	font-family: Monospace;
  }
</style>
<?php
$username = $_SESSION['username'];
$query = "SELECT * FROM `Profile` WHERE `Username` = '$username'";
$query2 = "SELECT `Email` FROM `Userdata` WHERE `Username` = '$username'";
$r = mysqli_query($dbc, $query) or die("Error Querying");
$r2 = mysqli_query($dbc, $query2) or die("Error Querying");

$result = mysqli_fetch_array($r);
$result2 = mysqli_fetch_array($r2);
?>
<fieldset>
<legend><b>Basic Info</b></legend>
<label>Username: </label><?php echo $username; ?><br>
<label>Email: </label><?php echo $result2[0]; ?><br>
</fieldset>
<br>
<fieldset>
<legend><b>Profile Info</b></legend>
<label>Profile Picture:</label><br>
<?php 
if(!empty($result['Photo'])){ ?>
<img src="<?php echo $result['Photo']; ?>" height="200px" width="200px"><br>
<?php } ?>
<label>Birthdate: </label><?php echo $result['Birthdate']; ?><br>
<label>Gender: </label><?php echo $result['Gender']; ?><br>
<label>Relationship Status: </label><?php echo $result['Relationship']; ?><br>
<label>Interested In: </label><?php echo $result['Interest']; ?><br>
<a href="profile-edit.php"><button>Edit Profile</button></a>
</fieldset>
<?php
mysqli_close($dbc);
require_once("footer.html");
?>