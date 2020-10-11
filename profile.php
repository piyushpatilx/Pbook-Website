<?php
 session_start();
 if(!isset($_SESSION['username'])){
  header("Location: login.php");
 }
 require_once("header.html");
 require_once("nav.html");
 require ("database_con.php");
 ?>
<style>
 label  {
    font-family: Monospace;
  }
  
</style>
<?php
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$query = "SELECT * FROM `Profile` WHERE `Username` = '$username'";
$r = mysqli_query($dbc, $query) or die("Error Querying");

$result = mysqli_fetch_array($r);
?>
<fieldset>
<legend><b>Basic Info</b></legend>
<label>Username: </label><?php echo $username; ?><br>
<label>Email: </label><?php echo $email; ?><br>
</fieldset>
<br>
<fieldset>
<legend><b>Profile Info</b></legend>
<label>Birthdate: </label><?php echo $result['Birthdate']; ?><br>
<label>Gender: </label><?php echo $result['Gender']; ?><br>
<label>Relationship Status: </label><?php echo $result['Relationship']; ?><br>
<label>Interested In: </label><?php echo $result['Interest']; ?><br>
<a href="profile-edit.php"><button>Edit Profile</button></a>
</fieldset>
<?php
require_once("footer.html");
?>