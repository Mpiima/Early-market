<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>
<script type="text/javascript">
function get_values(obj){
var page="subcatid";
var val=obj.value;
var tt=obj.id;
$.ajax({
type: "POST",
url: "middlez.php",
data: {page:page,val:val,tt:tt},
success: function(user_out){
document.getElementById("div_cp").innerHTML=user_out}
});

return false; }
</script>
</head>

<body class="">
<?php leftbar(); ?>

<div class="col-lg-12">
<div class="card">
<div class="card-header card-header-tabs card-header-primary">
<div class="nav-tabs-navigation">
<div class="nav-tabs-wrapper">
<ul class="nav nav-tabs" data-tabs="tabs">
<li class="nav-item">
<a class="nav-link active" href="#entryprod" data-toggle="tab">
<i class="material-icons">create</i> Create Product
<div class="ripple-container"></div>
</a></li>
<li class="nav-item">
<a class="nav-link" href="#listprods" data-toggle="tab">
<i class="material-icons">list</i> View Products
<div class="ripple-container"></div>
</a></li></ul>
</div></div></div>
<div class="card-body">
<div class="tab-content">
<div class="tab-pane active" id="entryprod">
<!--entry plans reports-->
<h3 class='card-title text-center'><b>Post Ad</b></h3>
<div class="row">
<input type='hidden' id='kp' value='1'>
<input type='hidden' id='kp_rows' value='1'>	
<div class="col-md-4">
<input type="hidden" id="idcatid">
<select class="form-control" name="catid" onchange="get_values(this);" id="catid">
<option>Select Category</option>
<?php
$result_cat=$dbh->query("select * from scrap where type='prodcat' order by item2 asc");
$count_cat=$result_cat->rowCount();
$row_cat=$result_cat->fetchObject();
if($count_cat>0){do{echo "<option value='".$row_cat->item."'>".$row_cat->item2."</option>"; }while($row_cat=$result_cat->fetchObject());}
?>	
</select> 	
</div>
<div class='col-lg-4' id="div_cp">
<select class='form-control' id='subcatid' name='subcatid'>
  <option>Select Sub Category</option>
</select>
</div>
<div class="col-md-4">
<select class="form-control" name="constituency" required>
<option value="">Select Location</option>
<?php
$result_scrap=$dbh->query("select * from scrap where type='const' order by item3 asc");
$row_scrap=$result_scrap->fetchObject();
$count_scrap=$result_scrap->rowcount();

if($count_scrap>0){
do{
$result_scrap2=$dbh->query("select * from scrap where type='district' and item='$row_scrap->item3'");
$row_scrap2=$result_scrap2->fetchObject();
echo "<option value='".$row_scrap->item."'>".$row_scrap->item2." -> ".$row_scrap2->item2."</option>";
}while($row_scrap=$result_scrap->fetchObject());
}else{
echo "<option value=''>Please contact your IT department.</option>";
}
?>
</select>	
</div>	
</div>
<div class="col-md-12"><br></div>
<div class="row">
<div class=" col-md-12 form-group">
<h4> <b>Attach atleast 5 photos. Each photo should not exceed 2MBs</b></h4>
</div>
<div class="col-md-12 form-group">
<div class='col-lg-4' style='float:left' onClick="addpkg_rows()"> 
<img src='img/plus.png' style='width:20%;'><br>
<p>Only .jpg, .png and gif formats allowed</p>
</div>
</div>
<div class="col-md-12 form-group text-center">
<input type='submit' onClick='submit_attributes()' class='btn btn-lg btn-primary' value='Submit'>  
</div>
</div>
</div>

<!--entry plans reports-->


<div class="tab-pane" id="listprods">

<!--listplans-->

<!--listplans-->
</div>

</div>
</div>
</div>
</div></div>

<?php lscript(); ?>
</body>

</html>
