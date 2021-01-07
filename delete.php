<?php
 require_once("login_check.php");
 require_once("header.html");
 require_once("nav.html");
 require_once("database_con.php");
 $username = $_SESSION['username'];
 ?>
</br>
<b>If you delete your account then all the posts, chats, and profile data will be deleted with account permanently.</b>
</br></br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type=submit value="Delete Account" name="delete">
</form>
<?php
if(isset($_POST['delete'])){
	$del = "delete from `Userdata` where `Username` = '$username'";
  $del2 = "delete from `Profile` where `Username` = '$username'";
  $del3 = "delete from `Posts` where `from` = '$username'";
  $del4 = "delete from `Chats` where `receiver` = '$username' or `sender` = '$username'";
  $del5 = "delete from `Likes` where `liked-by` = '$username'";
mysqli_query($dbc, $del) or die('E 1'.mysqli_error($dbc));
mysqli_query($dbc, $del2) or die('E 2'.mysqli_error($dbc));
mysqli_query($dbc, $del3) or die('E 3'.mysqli_error($dbc));
mysqli_query($dbc, $del4) or die('E 4'.mysqli_error($dbc));
mysqli_query($dbc, $del5) or die('E 5'.mysqli_error($dbc));

header("location: logout.php");
}
require_once("footer.html");
?>