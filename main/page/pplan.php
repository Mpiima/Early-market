<?php
$uid=$_POST["uid"];

if(!empty($uid)){
$result_users=$dbh->query("select * from users where rolenumber='$uid'");
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount(); 
if($count_users>0){ 
$result_scrap=$dbh->query("select * from scrap where item='$row_users->payment_plan' and type='payment_plan'");
$row_scrap=$result_scrap->fetchObject();
?>
<label style="font-weight:bold;color: #000000;">Payment Plan Type</label>
<input type='text' class='form-control'  id="pplan" name="pplan" readonly value="<?php echo $row_scrap->item2; ?>">
<input type='hidden' class='form-control'  id="get_seller" name="get_seller" value="<?php echo $row_users->rolenumber; ?>">
<input type='hidden' class='form-control'  id="get_plan" name="get_plan" value="<?php echo $row_users->payment_plan; ?>">
<?php  }
else{echo "<option value=''>There Are Tenants In This Estate.</option>";}
}
?>