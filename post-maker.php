<?php
require_once("login_check.php");
require_once("header.html");
require_once("nav.html");
require_once("database_con.php");

if(isset($_POST['submit-post'])){
$article = htmlspecialchars(trim($_POST['post-article']));
$error = array();
$username = $_SESSION['username'];

$uploaddir = 'images/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$file = basename($_FILES['userfile']['name']);
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Post was successfully uploaded. <br>";
} else {
    echo "Post upload failed!.\n";
  }

if(empty($article)){
	array_push($error,"Article cannot be empty");
}
if(empty($error)){
	$date = date('M d Y h:i a');
	if(empty($file)){
	$query = "INSERT INTO `Posts`(`Date`,`From`,`Post`) VALUES('$date','$username','$article')";
	}
	else {
$query = "INSERT INTO `Posts`(`Date`,`From`,`Post`,`Photo`) VALUES('$date','$username','$article','$uploadfile')";
	}
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
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<br><fieldset>
<legend><em>Create Post</em></legend>
<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
Upload Photo: <input name="userfile" accept="image/jpeg" type="file" />
Text: <textarea rows="7" maxlength="499" cols="30" name="post-article" required>
</textarea>
<input type="submit" value="Post" name="submit-post"/>
</form>
</fieldset>
<?php require_once("footer.html"); ?>