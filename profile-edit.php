<html>
 <?php
 require_once("login_check.php");
 require_once("header.html");
 require_once("nav.html");
 require_once("database_con.php");
 ?>
<style>
body {
font-family: Sans-Serif;
}
form {
 margin-top: 10px;
}
</style>
<br><fieldset>
<legend><em>Profile Edit</em></legend>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    Choose Profile Picture: <input accept="image/jpeg" name="userfile" type="file" />
<br>
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
<textarea name=interest rows=4 cols=30 maxlength="100" ></textarea>
<br><a href="profile.php"><input type="submit" value="Save" name="submit" /></a>
</form>
</fieldset>
<?php 
if(isset($_POST['submit'])){
$username = $_SESSION['username'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];

$uploaddir = 'images/';
$uploadfile = $uploaddir . $username .".jpg";
$file = basename($_FILES['userfile']['name']);
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Profile was successfully uploaded. <br>";
    
} else {
    echo "Profile upload failed!.\n";
  }

$relationship = $_POST['relationship'];

$interest = $_POST['interest'];

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
}
if(!empty($file)) {
$q6 = "UPDATE `Profile` SET `Photo` = '$uploadfile' WHERE `Username` = '$username'";
mysqli_query($dbc,$q6) or die("Error q6");
}
header("Location: profile.php");
}
mysqli_close($dbc);
require_once("footer.html");
?>