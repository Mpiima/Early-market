<?php
session_start();
$role=$_SESSION["role"];
if($role=="sls"){include("seller_main.php");}
else{include("dashboard.php");}
?>