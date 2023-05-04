<?php
@session_start();
include 'connect.php';
$catid2=$_POST["catid2"];
$mult_name=$_POST["mult_name"];
$sub_catid=$_POST["sub_catid"];
$attrid=$_POST["attrid"];
$insert_scrap=$dbh->query("insert into scrap(item,item2,item3,item4,type) values('$attrid','$mult_name','$sub_catid','$catid2','attribute')");
echo 1
?>