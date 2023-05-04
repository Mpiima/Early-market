<?php
$val=$_POST["val"];

if(!empty($val)){
$result_attributes=$dbh->query("select * from subcat_attributes where subcatid='$val' and item_type=2 order by item_name asc");
$row_attributes=$result_attributes->fetchObject();
$count_attributes=$result_attributes->rowCount(); 
echo "
<label>SELECT ATTRIBUTES</label>
<select class='form-control' id='attrid' name='attrid'>
<option value=''>Select Attribute</option>";
if($count_attributes>0){  do{ 
echo "<option value='".$row_attributes->attrid."'>".$row_attributes->item_name."</option>";
}while($row_attributes=$result_attributes->fetchObject()); }
else{echo "<option value=''>No Attribute Registered.</option>";}

echo "</select>";}
?>