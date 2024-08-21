<?php
require_once("login_check.php");
require_once("header.html");
require_once("nav.html");
require_once("database_con.php");

if(isset($_POST['submit-post'])){
$article = $_POST['post-article'];
$error = array();
$username = $_SESSION['username'];

//images
$uploaddir = 'images/';
$file_name = tempnam($uploaddir,0);
$uploadfile = substr($file_name, -14, strlen($file_name)).".jpg";
$file = basename($_FILES['image']['name']);
if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
    echo "Post was successfully uploaded. <br>";
    unlink(substr($file_name, -14, strlen($file_name)));
} else {
   unlink(substr($file_name, -14, strlen($file_name)));
   echo "Post upload failed!.\n";
  }


if(empty($article)){
	array_push($error,"Article cannot be empty");
}
if(empty($error)){
	$date = date('M d Y h:i a');
	if(empty($file)){
	$query = "INSERT INTO `Posts`(`date`,`from_user`,`post`) VALUES('$date','$username','$article')";
	}
	else {
$query = "INSERT INTO `Posts`(`date`,`from_user`,`post`,`photo`) VALUES('$date','$username','$article','$uploadfile')";
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
<fieldset>
<legend>Upload Photo</legend><input name="image" accept="image/jpeg" type="file" />
</fieldset>
Text: <textarea rows="7" maxlength="499" cols="30" name="post-article" required>
</textarea>
<input type="submit" value="Post" name="submit-post"/>
</form>
</fieldset>
<?php require_once("footer.html"); ?>