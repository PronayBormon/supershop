<?php

$db = mysqli_connect("localhost","root","","resturant");
if(!$db){
    echo $massage = "Database Not connected";
}

ob_start();
session_start();
?>