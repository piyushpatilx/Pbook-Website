<html>
 <?php
 session_start();
 require_once("header.html");
 require_once("nav.html");
 if(!isset($_SESSION['username'])){
  header("Location: login.php");
 }
 require ("database_con.php");
 ?>
<style>
body {
font-family: Sans-Serif;
}
form {
 margin-top: 10px;
}
</style>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
Birth Date:<input type=date name=birthdate /><br>
Gender:
Male<input type=radio value=Male name=gender />
Female<input type=radio value=Female name=gender /><br>
Relationship Status:
<select name=relationship>
<option value=None>None</option>
<option value=Single >Single</option>
<option value=Married >Married</option>
</select><br>
Intrested in:<br>
<textarea name=interest rows=7 columns=10 maxlength="29" ></textarea>
<a href="profile.php"><input type="submit" value="Save" name="submit" /></a>
</form>
<?php 
if($_POST['submit']){
$username = $_SESSION['username'];
$birthdate = trim($_POST['birthdate']);
$gender = trim($_POST['gender']);

$relationship = trim($_POST['relationship']);

$interest = trim($_POST['interest']);

$check = "SELECT `Username` FROM `Profile` WHERE `Username` = '$username'";

  $checker = mysqli_query($dbc, $check) or die("Error check");
 
 if(empty($checker)){
  $q = "INSERT INTO Profile(Username) VALUE
  ('$username')";
  mysqli_query($dbc,$q) or die("Error q");
}
if(!empty($birthdate)) {
  $q2 = "UPDATE `Profile` SET `Birthdate` = '$birthdate' WHERE `Username` = '$username'";
mysqli_query($dbc,$q2) or die("Error q2");
}
if(!empty($gender)) {
$q3 = "UPDATE `Profile` SET `Gender` = '$gender' WHERE `Username` = '$username'";
mysqli_query($dbc,$q3) or die("Error q3");
}
if(!empty($relationship)) {
$q4 = "UPDATE `Profile` SET `Relationship` = '$relationship' WHERE `Username` = '$username'";
mysqli_query($dbc,$q4) or die("Error q4");
}
if(!empty($interest)) {
$q5 = "UPDATE `Profile` SET `Interest` = '$interest' WHERE `Username` = '$username'";
mysqli_query($dbc,$q5) or die("Error q5");
mysqli_close($dbc);
header("Location: profile.php");
  }
}
mysqli_close($dbc);
require_once("footer.html");
?>