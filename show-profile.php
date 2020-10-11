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
$name = $_GET['name'];
$query = "SELECT * FROM `Profile` WHERE `Username` = '$name'";
$r = mysqli_query($dbc, $query) or die("Error Querying");

$result = mysqli_fetch_array($r);
?>
<br>
<fieldset>
<legend><b><?php echo $name; ?></b></legend>
<label>Birthdate: </label><?php echo $result['Birthdate']; ?><br>
<label>Gender: </label><?php echo $result['Gender']; ?><br>
<label>Relationship Status: </label><?php echo $result['Relationship']; ?><br>
<label>Interested In: </label><?php echo $result['Interest']; ?><br>
<form action=message-send.php method=get >
<input type=hidden name=refer value="<?php echo $result[0]; ?>" />
<input type=submit value=Chat />
</form>
</fieldset>
<?php
mysqli_close($dbc);
require_once("footer.html");
?>