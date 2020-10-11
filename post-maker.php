<?php
session_start();
require ("header.html");
require("nav.html");
require("database_con.php");
if(isset($_POST['submit-post'])){
$article = trim($_POST['post-article']);
$error = array();
$username = $_SESSION['username'];

if(empty($article)){
	array_push($error,"Article cannot be empty");
}
if(empty($error)){
	$date = date('M d Y h:i a');
	$query = "INSERT INTO `Posts`(`Date`,`From`,`Post`) VALUES('$date','$username','$article')";
	$q = mysqli_query($dbc, $query) or die("Error querying database".mysqli_error($dbc));
	mysqli_close($dbc);
	header("Location: index.php");
  }
  else{
  	$i=0;
  	for($i=0;$i < count($error);$i++){
  		echo $error[$i]."<br>";
  	  }
  	}
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<b>Post:</b><br>
<textarea rows="7" maxlength="499" cols="30" name="post-article" required>
</textarea><br>
<input type="submit" name="submit-post" value="Post" /><br>
</form>
<?php require ("footer.html"); ?>