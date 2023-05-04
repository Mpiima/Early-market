<?php
$val=$_POST["val"];

if(!empty($val)){
$result_scrap=$dbh->query("select * from scrap where item3='$val' and type='subcat'");
$row_scrap=$result_scrap->fetchObject();
$count_scrap=$result_scrap->rowCount(); 
?>
<label style='font-weight:bold;color:#000000;'>Category Type</label>
<select class='form-control' id='subcatid' name='subcatid' onchange='get_attributes(this);'>
<option value=''>Select</option>";
<?php if($count_scrap>0){  do{ 
echo "<option value='".$row_scrap->item."'>".$row_scrap->item2."</option>";
}while($row_scrap=$result_scrap->fetchObject()); }
else{echo "<option value=''>No Subcats Registered.</option>";}

echo "</select>";}
?>