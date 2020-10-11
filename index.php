<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: login.php");
}
require_once("header.html");
require_once("nav.html");
require("database_con.php");
$email = $_SESSION['email'];
$username = $_SESSION['username'];
echo "You logged in as $username.<br>";
?>
<style>
#date {
	font-size: 70%;
}
#pst {
	font-family: Monospace;
	font-size: 80%;
}
</style>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" >
<h2>
<input type=submit value=Search name=submit /><input type=search name=search_name placeholder="Search by Name"/></h2>
</form>
<a href="post-maker.php" ><button>Create Post</button></a>
<?php 
if(isset($_GET['submit'])){
$search = trim($_GET['search_name']);
echo "<h4><em>Search Results</em></h4>";
if(!empty($search)){
	$query = "SELECT * FROM `Profile` WHERE `Username` LIKE '%$search%'";
	$q = mysqli_query($dbc, $query) or die("Error querying database");
	while($result = mysqli_fetch_array($q)){
	?>
<br>
<fieldset>
<legend><b><?php echo $result['Username']; ?></b></legend>
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
	 }
 }
}
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
<?php echo $farray['Post']; ?>
<br>
</fieldset>
	<?php 
  }
}
mysqli_close($dbc);
require_once("footer.html"); ?>