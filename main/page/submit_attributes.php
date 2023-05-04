<?php
@session_start();
include 'connect.php';
$catid=$_POST["catid"];
$item_name=$_POST["item_name"];
$subcatid=$_POST["subcatid"];
$item_type=$_POST["item_type"];
$result_subcat=$dbh->query("select * from subcat_attributes order by autoid desc"); 
$row_subcat=$result_subcat->fetchObject(); 
if($count_subcat>=0){$attid="atr".($row_subcat->autoid+1); }
$insert_attributes=$dbh->query("insert into subcat_attributes(catid,subcatid,item_name,item_type,attrid) values('$catid','$subcatid','$item_name','$item_type','$attid')");
?>