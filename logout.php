<?php
ob_start();
session_start();
unset($_SESSION["user"]);
header("location:login.php");


ob_end_flush();
?>