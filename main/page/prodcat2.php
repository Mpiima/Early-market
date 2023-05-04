<?php
$val=$_POST["val"];

if(!empty($val)){
$result_scrap=$dbh->query("select * from scrap where item3='$val' and type='subcat' order by item2 asc");
$row_scrap=$result_scrap->fetchObject();
$count_scrap=$result_scrap->rowCount();
echo"
<label>SELECT SUB-CATEGORY</label>"; ?>
<select class='form-control' id='sub_catid' name='sub_catid' onchange="get_values3(this);">
<?php echo"<option value=''>Select Sub Category</option>";
if($count_scrap>0){  do{ 
echo "<option value='".$row_scrap->item."'>".$row_scrap->item2."</option>";
}while($row_scrap=$result_scrap->fetchObject()); }
else{echo "<option value=''>No Subcats Registered.</option>";}

echo "</select>";}
?>