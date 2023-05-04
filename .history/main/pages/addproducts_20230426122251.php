<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>
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
<select class="form-control" name="constituency" required>
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
<input type="file" id="images" name="images[]" onchange="preview_images();" multiple style="display:none;">
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
<div class="col-md-12">
<div class="card">
<div class="card-body">

<table id="example" class="table table-striped" style="width:100%">
<thead>
<tr>
<th><b>No</b></th>
<th><b>Name</b></th>
<th><b>Price</b></th>
<th><b>Image</b></th>
<th><b>Category</b></th>
<th><b>Added_On</b></th>
<th><b>Updated_On</b></th>
<th><b>Action</b></th>
</tr></thead>
<tbody>
    <tr><td>1</td>
    <td>Sugar</td>
    <td>60000</td>
    <td>image</td>
    <td>Solid</td>
    <td>6/02/2022</td>
    <td>21/02/2023</td>
    <td>
    <?php
          $result_sub1=$dbh->query("select * from status_sub where clientid='".$_SESSION['rolenumber']."'");
         $count_sub1=$result_sub1->rowCount();
         $row_sub1=$result_sub1->fetchObject();
         $dt=date('Y-m-d');
       
        if($row_sub1->expirydate < $dt){
            echo  '<a class="btn btn-success" onclick="causeAlert()" href="">EDIT</a> &nbsp; <a class="btn btn-danger" onclick="causeAlert()" href="">DELETE</a> &nbsp;<a class="btn btn-primary" onclick="causeAlert()" href="">VIEW MORE</a>';
        }else{
            echo  '<a class="btn btn-success"  href="">EDIT</a> &nbsp; <a class="btn btn-danger"  href="">DELETE</a> &nbsp;<a class="btn btn-primary" href="">VIEW MORE</a>';
        }
        ?>
    </td></tr>
</tbody>
</table>



</div>
</div>
</div>
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
