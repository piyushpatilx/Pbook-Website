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
</style>
<?php
$username = $_SESSION['username'];
echo "You logged in as $username.<br>"; ?>
<br>
<form action="search-profile.php" method="get" >
<input type=submit value=Search name=submit /><input type=search name=search_name placeholder="Search by Name"/>
</form>
<a href="post-maker.php" ><button>Create Post</button></a>

<?php
if(!isset($_GET['submit'])){

	echo "<h4><em>News Feed</em></h4>";
	$f = "SELECT * FROM `Posts` ORDER BY `Date` DESC";
	$feed = mysqli_query($dbc, $f) or die("Error querying");
while($farray = mysqli_fetch_array($feed)){
?>
<br>
<fieldset id=pst>
<em id=date >Posted by <a href="show-profile.php?name=<?php echo $farray['From']; ?>" ><?php echo $farray['From']; ?></a> At <?php echo $farray['Date']; ?> </em>
<br><hr></hr>
<?php 
if(!empty($farray['Photo'])){
	?>
<img src='<?php echo $farray['Photo']; ?>' header="250" width="250"><hr></hr>
<?php } echo $farray['Post']; ?>
<?php if($username == $farray['From']){
	?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" name="post-id" value="<?php echo $farray['id']; ?>"/>
	<input type="hidden" name="image-path" value="<?php echo $farray['Photo']; ?>" />
	<br><input type="submit" id="del" value="Delete Post" name="del-post"/>
</form>
<?php } ?>
</fieldset>

	<?php 
  }
if(isset($_POST['del-post'])){
	$postid = $_POST['post-id'];
	$image_path = $_POST['image-path'];
	$dq = "DELETE FROM `Posts` WHERE `id` = '$postid'";
	unlink($image_path);
mysqli_query($dbc, $dq);
header("Location: index.php");
  }
}

mysqli_close($dbc);
require_once("footer.html"); ?>