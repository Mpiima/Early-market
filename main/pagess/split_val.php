<?php
$val=$_POST["val"];
$tt=$_POST["tt"];

if(!empty($val)){
$result_users=$dbh->query("select * from users where firstname like '%$val%'  and role='sls'");
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();

if($count_users>0){ echo "<ul class='list-group' style='height:300px;overflow-y:scroll;'>"; do{ ?>

<li class='list-group-item' style='cursor:pointer;' onClick="get_values('<?php echo $row_users->firstname." ".$row_users->lastname; ?>','<?php echo $row_users->rolenumber; ?>','<?php echo $tt; ?>')"><?php echo $row_users->firstname." ".$row_users->lastname;?></li>
<?php }while($row_users=$result_users->fetchObject());
echo "</ul>";} }
?>