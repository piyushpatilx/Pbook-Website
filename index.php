<?php
require_once("login_check.php");
require_once("header.html");
require_once("nav.html");
require_once("database_con.php");
?>
<style>
#date {
	font-size: 9px;
 font-family: Monospace;
}
#pst {
	font-size: 13px;
	font-family: Georgia;
}
table {
	height: 10px;
	align-content: inline;
}
#del {
	margin-left: 100px;
}
#photo {
  border-style: double;
  border-width: 3px;
}
</style>
<body>
<?php
$username = $_SESSION['username'];
echo "You logged in as $username.<br>"; ?>
<br>
<form action="search-profile.php" method="get" >
<input type=submit value=Search name=submit /><input type=search name=search_name placeholder="Search by Name"/>
</form>
<br><a href="post-maker.php" ><button>Create Post</button></a>

<?php
if(!isset($_GET['submit'])){

	echo "<h4><em>News Feed</em></h4>";
	$f = "SELECT * FROM `Posts` ORDER BY `date` DESC";
	$feed = mysqli_query($dbc, $f) or die("Error querying");
	while($farray = mysqli_fetch_array($feed)){

$lk = "SELECT `liked_by` FROM `Likes` WHERE `id` = '$farray[id]'";
$lkq = mysqli_query($dbc, $lk);
$lkr = mysqli_affected_rows($dbc);

?>
<br>
<fieldset id=pst>
<em id=date >Posted by <a href="show-profile.php?name=<?php echo $farray['from_user']; ?>" ><?php echo $farray['from_user']; ?></a> At <?php echo $farray['date']; ?> </em>
<br><hr></hr>
<?php if(!empty($farray['photo'])){ ?>
<img id=photo src='<?php echo $farray['photo']; ?>' height="250" width="250"><hr></hr>
<?php } echo nl2br($farray['post'] ); ?>
<br><hr></hr>
<table id=del-like>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" name="post-id" value="<?php echo $farray['id']; ?>"/>
<input id=like type="submit" value="Like" name="like-post"/>
<?php echo "Likes: ".$lkr; ?>
</form>
<?php if($username == $farray['from_user']){
	?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" name="post-id" value="<?php echo $farray['id']; ?>"/>
	<input type="hidden" name="image-path" value="<?php echo $farray['Photo']; ?>" />
	<input type="submit" id="del" value="Delete Post" name="del-post"/>
</form>
<?php } ?>
</table>
</fieldset>
</body>
	<?php 
}
if(isset($_POST['del-post'])){
	$postid = $_POST['post-id'];
	$image_path = $_POST['image-path'];
	$dq = "DELETE FROM `Posts` WHERE `id` = '$postid'";
	$dq2 = "DELETE FROM `Likes` WHERE `id` = '$postid'";
	unlink($image_path);
mysqli_query($dbc, $dq);
mysqli_query($dbc, $dq2);
header("Location: index.php");
  }
if(isset($_POST['like-post'])){
	$postid = $_POST['post-id'];
	
	$lq = "SELECT `liked_by` FROM `Likes` WHERE `id` = '$postid' AND `liked_by` = '$username'";
$clq = mysqli_query($dbc, $lq);
$clk = mysqli_fetch_array($clq);
 if(empty($clk)){
	$lq2 = "INSERT INTO `Likes`(`id`, `liked_by`) VALUES ('$postid', '$username')";
	mysqli_query($dbc ,$lq2);
header("Location: index.php");
  }
 elseif(!empty($clk)){
$lq3 = "DELETE FROM `Likes` WHERE `id` = '$postid' AND `liked_by` = '$username'";
	mysqli_query($dbc ,$lq3);
header("Location: index.php");
  }
 }
}
mysqli_close($dbc);
require_once("footer.html"); ?>