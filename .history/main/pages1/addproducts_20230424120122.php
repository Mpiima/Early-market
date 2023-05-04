<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
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
<i class="material-icons">Add</i> New Product
<div class="ripple-container"></div>
</a></li>
<li class="nav-item">
<a class="nav-link" href="#listprods" data-toggle="tab">
<i class="material-icons">list</i> Of Products
<div class="ripple-container"></div>
</a></li></ul>
</div></div></div>
<div class="card-body">
<div class="tab-content">
<div class="tab-pane active" id="entryprod">
<!--entry plans reports-->
<!-- <h3 class='card-title text-center'><b>Post Ad</b></h3> -->
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


<!--entry plans reports-->


<div class="tab-pane" id="listprods">

<!--listplans-->
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
    <td>edit|delete|view more</td></tr>
</tbody>

</table>



</div>
</div>
</div>
</div>
</div>
<!-- Table showing list of seller's products -->

<!--listplans-->
</div>

</div>
</div>
</div>
</div></div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
 $(document).ready(function () {
    $('#example').DataTable();
});
        </script>
<?php lscript(); ?>
</body>

</html>
