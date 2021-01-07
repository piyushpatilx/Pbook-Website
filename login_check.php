<?php
session_start();
$_SESSION = filter_var_array($_SESSION, FILTER_SANITIZE_STRING);
 if(!isset($_SESSION['username'])){
  header("Location: login.php");
 }
?>