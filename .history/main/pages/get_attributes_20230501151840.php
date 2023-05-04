<?php
$val=$_POST["val"];

if(!empty($val)){
$result_attributes=$dbh->query("select * from subcat_attributes where subcatid='$val'");
$row_attributes=$result_attributes->fetchObject();
$count_attributes=$result_attributes->rowCount(); 
$result_user=$dbh->query("select * from users where rolenumber='$rolenumber'");
$row_user=$result_user->fetchObject();
if($count_attributes>0){ $m=1; do {
if($row_attributes->item_type==1){
echo "<div class='col-md-2'>
<label style='font-weight:bold;color:#000000;'>".$row_attributes->item_name."</label>
<input type='text' name='singleChoice[]' placeholder='Enter ".$row_attributes->item_name."' class='form-control'>
<input type='hidden' name='singleChoiceID[]' value='".$row_attributes->item_name."'>
</div>";	}
if ($row_attributes->item_type==2) { 
$result_scrap = $dbh->query("select * from scrap where item='$row_attributes->attrid' and type='attribute'");
$count_scrap=$result_scrap->rowCount();
$row_scrap=$result_scrap->fetchObject();	
echo "<div class='col-md-2'>
<label style='font-weight:bold;color:#000000;'>".$row_attributes->item_name."</label>
<select name='multiChoice[]' class='form-control'>
<option>Select</option>";
if($count_scrap>0){ do{
echo "<option value='".$row_scrap->autoid."'>".$row_scrap->item2."</option>";	
}while($row_scrap=$result_scrap->fetchObject()); }
echo "</select></div>"; 
}
}while($row_attributes=$result_attributes->fetchObject());
echo "<div class='col-md-12'><br></div>
<div class='col-md-12'>
<label style='font-weight:bold;color:#000000;'>Description</label>
<textarea name='prod_details' class='form-control'></textarea>
</div><div class='col-md-12'><br></div>
<div class='col-md-12 row'>
<div class='col-md-3'>
<label style='font-weight:bold;color:#000000;'>Price</label>
<input type='number' value='0' class='form-control' name='prod_price'>
</div>
<div class='col-md-3'>
<label style='font-weight:bold;color:#000000;'>Bargain</label>
<select class='form-control' name='bargain'>
<option value='1'>Negotiable</option>
<option value='2'>Not Negotiable</option>
</select>
</div>
<div class='col-md-3'>
<label style='font-weight:bold;color:#000000;'>Seller Name</label>
<input type='text' value='".$row_user->firstname." ".$row_user->lastname."' class='form-control' readonly name='customer_name' style='text-align:center;font-weight:bold;color:blue;'>
<input type='hidden' value='".$rolenumber."' name='seller_name'>
</div>
<div class='col-md-3'>
<label style='font-weight:bold;color:#000000;'>Contact</label>
<input type='text' value='".$row_user->phonenumber."' class='form-control' readonly name='customer_mobile' style='text-align:center;font-weight:bold;color:blue;'>
</div>
</div>
";
}
}
?>