<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>
<style>
.fa_ic{width:7%;cursor: pointer;}
.res{overflow-x: hidden;}
</style>
<script src='../js/jquery.js'></script>
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
function get_attributes(obj){
var page="get_attributes";
var val=obj.value;
var tt=obj.id;
$.ajax({
type: "POST",
url: "middlez.php",
data: {page:page,val:val,tt:tt},
success: function(user_out){
document.getElementById("my_attributes").innerHTML=user_out}
});

return false; }
</script>

<script type="text/javascript">
function preview_images()
{
  var total_file = document.getElementById("images").files.length;
    
    for(var m = 0; m<total_file; m++)
  {
    $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[m])+"' style='width:150px;height:150px;padding:10px;'>");
  }
}
function getImg(){
  document.getElementById("images").click();
}
</script>
<!-- <script type="text/javascript">
$(document).ready(function(){
  $('#submit_product').click(function() {
    var form_data = new FormData();
    var total_file = document.getElementById("images").files.length;
    
    for(var m = 0; m<total_file; m++)
  {
    form_data.append("images[]", document.getElementById("images").files[m]);
  }
  $.ajax({
    url:'multiupload.php',
    type:'post',
    data: form_data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(response){
      alert("Upload SuccessFully");
    }
  });
  });
});  
</script>
 --></head>

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
<?php 
include('connect.php');
if(isset($_POST['submit_product'])){
$multiChoice= $_POST['multiChoice'];
$singleChoice= $_POST['singleChoice'];
$singleChoiceID= $_POST['singleChoiceID'];
$prod_details = $_POST['prod_details'];
$bargain=$_POST['bargain'];
$prod_price=$_POST['prod_price'];
$seller_name=$_POST['seller_name'];
$catid=$_POST['catid'];
$subcatid=$_POST['subcatid'];
$address=$_POST['address'];
//productid
$yy=date("Y");$fyy=substr($yy,2,2);
$mm=date("m");$dd=date("d");
$hi=date("h");$mi=date("i");
$sa=date("sa");$fsa=substr($sa,0,2);   
$prodid="prdt".$fyy.$mm.$dd.$hi.$mi.$fsa;
//images entry
$countfiles = count($_FILES['images']['name']);
$upload_location = "uploads/";
$files_arr = array();
for ($index=0; $index < $countfiles; $index++) { 
  if (isset($_FILES['images']['name'][$index]) && $_FILES['images']['name'][$index] !=''){
    $file_name = $_FILES['images']['name'][$index];
    $ext = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $valid_ext = array("png","jpeg","jpg");
      if(in_array($ext, $valid_ext)){
      $path = $upload_location.$file_name;
         if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $path)) {
          $files_arr[] = $path;
          foreach ($files_arr as $img_path) {
           $insert_cabin=$dbh->query("insert into cabin(image_path,productid) values('".$img_path."','".$prodid."')");
           echo "<div class='alert alert-success'>Product Images added successfully</div>"; 
          }
         }
       }

  }
}
$insert_products=$dbh->query("insert into products(prod_cat,prod_subcat,address,seller_name,prod_details,bargain,prod_price,productid) values('".$catid."','".$subcatid."','".$address."','".$seller_name."','".$prod_details."','".$bargain."','".$prod_price."','".$prodid."')");
if($insert_products){ echo "<div class='alert alert-success'>Success: Products added successfully</div>"; }else { echo "<div class='alert alert-danger'>Failuere: Product not added</div>"; }
foreach ($multiChoice as $key => $value) {
$insert_prod_attributes=$dbh->query("insert into prod_attributes(productid,multiple_choice) values('".$prodid."','".$value."') ");
}
foreach ($singleChoice as $key => $value) {
$insert_prod_attributes=$dbh->query("insert into prod_attributes(productid,singleName,singleValue) values('".$prodid."','".$singleChoiceID[$key]."','".$value."') ");
}
if($insert_prod_attributes){ echo "<div class='alert alert-success'>Success: Product attributes added</div>"; }
else{echo "<div class='alert alert-danger'>Failure: Product attributes not added</div>"; }
}
?>
<div class="tab-content">
<div class="tab-pane active" id="entryprod">
<!--entry plans reports-->
<h3 class='card-title text-center'><b>Post Ad</b></h3>
<form method="post" enctype="multipart/form-data">
<div class="row">
<input type='hidden' id='kp' value='1'>
<input type='hidden' id='kp_rows' value='1'>	
<div class="col-md-4">
<input type="hidden" id="idcatid">
<label style='font-weight:bold;color:#000000;'>Category</label>
<select class="form-control" name="catid" onchange="get_values(this);" id="catid">
<option>Select</option>
<?php
$result_cat=$dbh->query("select * from scrap where type='prodcat' order by item2 asc");
$count_cat=$result_cat->rowCount();
$row_cat=$result_cat->fetchObject();
if($count_cat>0){do{echo "<option value='".$row_cat->item."'>".$row_cat->item2."</option>"; }while($row_cat=$result_cat->fetchObject());}
?>	
</select> 	
</div>
<div class='col-lg-4' id="div_cp">
<label style='font-weight:bold;color:#000000;'>Category Type</label>
<select class='form-control' id='subcatid' name='subcatid'>
  <option>Select</option>
</select>
</div>
<div class="col-md-4">
<label style='font-weight:bold;color:#000000;'>Location</label>  
<select class="form-control" name="address" required>
<option value="">Select</option>
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
<div class="col-md-2">
<label style="font-weight:bold;color: #000000;">Add Photo</label><br>
<input type="file" id="images" name="images[]" onchange="preview_images();" multiple="multiple" style="display:none;">
<img src='img/plus.png' style='width:40%;' onclick="getImg();" style="margin-top: 0px;">
<p style="font-weight:bold;color:maroon;">Max Size: 5 Mb<br>Formats: *.jpg and *.png</p>
</div>
<div class="col-md-10" id="image_preview"></div>
</div><div class="col-md-12"><br></div>
<div class="row" id="my_attributes"></div>
<div class="col-md-12"><br></div>
<div class="form-group">
<input type="submit" name="submit_product" value="Submit" class="btn btn-sm btn-primary btn-block">  
</div>
</form>
</div>

<!--entry plans reports-->


<div class="tab-pane" id="listprods">

<h1>111</h1>
</div>

</div>
</div>
</div>
</div></div>

<?php lscript(); ?>
</body>

</html>
