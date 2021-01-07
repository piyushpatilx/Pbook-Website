<?php 
require_once("header.html");
require_once("nav.html");
require_once("login_check.php");
require_once("database_con.php");
?>
<style>
  #profile {
    border-style: double;
    border-width: 3px;
  }
</style>
<br>
<form action="search-profile.php" method="get" >
<input type=submit value=Search name=submit /><input type=search name=search_name placeholder="Search by Name"/>
</form>
<?php 
$username = $_SESSION['username'];

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
Profile Picture:<br>
<?php if(!empty($result['Photo'])){ ?>
<img id=profile src="<?php echo $result['Photo']; ?>" height="200px" width="200px"><br>
<?php } ?>
Birthdate: <?php echo $result['Birthdate']; ?><br>
Gender: <?php echo $result['Gender']; ?><br>
Relationship Status: <?php echo $result['Relationship']; ?><br>
Interested In: <?php echo $result['Interest']; ?><br>
<form action=chat-send.php method=get >
<input type=hidden name=name value="<?php echo $result[0]; ?>" />
<input type=submit value=Chat />
</form>
</fieldset>
<?php
	  }
  }
}
require_once("footer.html");
?>