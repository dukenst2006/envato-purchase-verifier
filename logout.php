<?php session_start(); /* Starts the sessions */
session_destroy(); /* Destroy started sessions */
header("location:login.php");
exit;
?>
