<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>
<style>
.fa_ic{width:15%;cursor: pointer;}
.res{overflow-x: hidden;}
</style>
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
function get_values2(obj){
var page="submit_subcat";
var val=obj.value;
var tt=obj.id;
$.ajax({
type: "POST",
url: "middlez.php",
data: {page:page,val:val,tt:tt},
success: function(user_out){
document.getElementById("div_cp2").innerHTML=user_out}
});

return false; }
function get_values3(obj){
var page="submit_attrs";
var val=obj.value;
var tt=obj.id;
$.ajax({
type: "POST",
url: "middlez.php",
data: {page:page,val:val,tt:tt},
success: function(user_out){
document.getElementById("div_cp3").innerHTML=user_out}
});

return false; }
function submit_attributes(){
var kp=parseInt(document.getElementById("kp_rows").value);
var x;
if(kp<=0){}
else{  
for (x=1; x<=kp; x++){
var item_name=$("#item_name"+x+"").val();
var item_type=$("#item_type"+x+"").val();
var catid=$("#catid").val();
var subcatid=$("#subcatid").val();
var page="submit_attributes";
var no=x;
$.ajax({
type: "POST",
url: "middlez.php",
data: {page:page,item_name:item_name,item_type:item_type,no:no,catid:catid,subcatid:subcatid},
beforeSend:function(){
setTimeout(page_loading,10);},
success: function(output){
setTimeout(page_close,10);
if(output==1){
document.getElementById("form_allrows").reset();
document.getElementById("allrows_rows").innerHTML='';
document.getElementById("form_allrows").innerHTML='';
document.getElementById("alert_out").innerHTML="<div class='alert alert-success'>Sub Category Attributes submitted. </div>";}
else{document.getElementById("alert_out").innerHTML="<div class='alert alert-danger'>Sub Category Attributes Not Added. </div>";}
var close_alert=function(){$("#alert_out").slideUp();
document.getElementById("alert_out").innerHTML='';$("#alert_out").slideDown();}
setTimeout(close_alert,4000);
}
});
}
}
return false; }
function submit_mults(){
var kp=parseInt(document.getElementById("kp_rows2").value);
var x;
if(kp<=0){}
else{  
for (x=1; x<=kp; x++){
var mult_name=$("#mult_name"+x+"").val();
var catid2=$("#catid2").val();
var sub_catid=$("#sub_catid").val();
var attrid=$("#attrid").val();
var page="submit_mults";
var no=x;
$.ajax({
type: "POST",
url: "middlez.php",
data: {page:page,mult_name:mult_name,catid2:catid2,no:no,sub_catid:sub_catid,attrid:attrid},
beforeSend:function(){
setTimeout(page_loading,10);},
success: function(output){
setTimeout(page_close,10);
if(output==1){
document.getElementById("form_allrows2").reset();
document.getElementById("allrows_rows2").innerHTML='';
document.getElementById("form_allrows2").innerHTML='';
document.getElementById("alert_out2").innerHTML="<div class='alert alert-success'>Multi-Choice submitted. </div>";}
else{document.getElementById("alert_out2").innerHTML="<div class='alert alert-danger'>Multi-Choice Not Added. </div>";}
var close_alert=function(){$("#alert_out2").slideUp();
document.getElementById("alert_out2").innerHTML='';$("#alert_out2").slideDown();}
setTimeout(close_alert,4000);
}
});
}
}
return false; }
function rmpkg_rows(){
var kp=document.getElementById("kp_rows").value;
if(kp>1){
var us=parseInt(kp)-1;
document.getElementById("kp_rows").value=us;
$("#tb"+kp).remove();
} }
function addpkg_rows(){
var kp=document.getElementById("kp_rows").value;
var us=parseInt(kp)+1;
document.getElementById("kp_rows").value=us;
//Add row
$("#allrows_rows").append("<table id='tb"+us+"' onClick='get_no("+us+")' class='table table-bordered table-striped '><tr><td  width='2%'>"+us+".</td><td><input type='text' class='form-control' id='item_name"+us+"' placeholder='Item Name' required></td><td><select id='item_type"+us+"' class='form-control'><option value='1'>Text Box</option><option value='2'>Multi-Choice</option></select></td></tr></table>");
}
function addpkg_rows2(){
var kp2=document.getElementById("kp_rows2").value;
var us2=parseInt(kp2)+1;
document.getElementById("kp_rows2").value=us2;
//Add row
$("#allrows_rows2").append("<table id='tb"+us2+"' onClick='get_no2("+us2+")' class='table table-bordered table-striped '><tr><td  width='2%'>"+us2+".</td><td><input type='text' class='form-control' id='item_name"+us2+"' placeholder='Item Name' required></td></tr></table>");
}
function addpkg_rows2(){
var kp2=document.getElementById("kp_rows2").value;
var us2=parseInt(kp2)+1;
document.getElementById("kp_rows2").value=us2;
//Add row
$("#allrows_rows2").append("<table id='tb"+us2+"' onClick='get_no("+us2+")' class='table table-bordered table-striped '><tr><td  width='2%'>"+us2+".</td><td><input type='text' class='form-control' id='mult_name"+us2+"' placeholder='Item Name' required></td></tr></table>");
}

function get_no(no){$("#kp").val(no);}
function get_no2(no){$("#kp2").val(no);}
</script>
</head>

<body class="">
<div id='loadin' style='position:absolute;z-index:9;width:0%;height:0%;background-color: grey;opacity:0.4;overflow-y: hidden'>
<img src='img/loadin.gif' style='width:20%;margin-left:40%;margin-top:20%;'>
</div> 
<?php leftbar(); ?>

<div id='alert'></div>
<div class='col-lg-12'>

<!--row-->
<div class='row'>
<!--Card -->
<div class='col-lg-6'>
<div class='card'>
<div class='card-header card-header-primary'>
<h4 class='card-title'><b>CATEGORIES</b></h4>
</div>
<div class='card-body'>
<?php
if(isset($_POST["submit_cat"])){
$prod_cat=$_POST["prod_cat"];
$result_scrap=$dbh->query("select * from scrap order by autoid desc"); 
$row_scrap=$result_scrap->fetchObject(); 
$catid="pdc".($row_scrap->autoid+1);               
$insert_scrap=$dbh->query("insert into scrap (item,item2,type) values('$catid','$prod_cat','prodcat')");
if($insert_scrap){echo "<div class='alert alert-success'>Success : Category Added. </div>";}
}
?>
<form method='post' autocomplete="off">
<input type='hidden' name='todo' value='insert'>
<div class='row'>
<div class='col-md-10'>         
<input type="text" name="prod_cat" class="form-control" placeholder="Enter Product Category">
</div>        
<div class='col-md-2'><input type='submit' name='submit_cat' class='btn btn-sm btn-primary' value='Go'></div> </div> 
</form>
<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
List of Categories
</button>

<div class="collapse" id="collapseExample">
<div class="card card-body">
<div class="table-responsive res">
<table class="table">
<tr>
<th>No</th>
<th>Category</th>
<th colspan='2'>Action</th>

</tr>
<?php
$result_scrap=$dbh->query("select * from scrap where type='prodcat'"); 
$row_scrap=$result_scrap->fetchObject(); 
$count_scrap=$result_scrap->rowCount();
if($count_scrap>0){ $ai=1; do{
echo "<tr>
<td>".$ai++."</td>
<td>".$row_scrap->item2."</td>
<td class='fa_ic'>
<img src='img/writeonpaper.png' style='width:40%;'></td>
<td class='fa_ic'><img src='img/trashbin.png' style='width:40%;'></td>
</tr>";
}while($row_scrap=$result_scrap->fetchObject());}

?>
</table>
</div></div>
</div> 
</div></div>
</div> 
<!--Card -->

<!--Card -->
<div class='col-lg-6'>
<div class='card'>
<div class='card-header card-header-primary'>
<h4 class='card-title'><b>SUB CATEGORIES</b></h4>
</div>
<div class='card-body'>
<?php
if(isset($_POST["submit_subcat"])){
$prodcat=$_POST["prodcat"];
$subcat=$_POST["subcat"];
$result_scrap=$dbh->query("select * from scrap order by autoid desc"); 
$row_scrap=$result_scrap->fetchObject(); 
$subcatid="sbc".($row_scrap->autoid+1);               
$insert_scrap=$dbh->query("insert into scrap (item,item2,item3,type) values('$subcatid','$subcat','$prodcat','subcat')");
if($insert_scrap){echo "<div class='alert alert-success'>Success : Sub-Cat Added. </div>";}
}
?>
<form method='post' autocomplete="off">
<div class='row'>
<div class='col-md-5'>
<select class="form-control" name="prodcat">
<option>Select Category</option>
<?php
$result_subs=$dbh->query("select * from scrap where type='prodcat' order by item2 asc");
$count_subs=$result_subs->rowCount();
$row_subs=$result_subs->fetchObject();
if($count_subs>0){do{echo "<option value='".$row_subs->item."'>".$row_subs->item2."</option>"; }while($row_subs=$result_subs->fetchObject());}
?>	
</select>         
</div> 
<div class="col-md-5">
<input type="text" name="subcat" class="form-control" placeholder="Enter Sub category"> 
</div>        
<div class='col-md-2'><input type='submit' name='submit_subcat' class='btn btn-sm btn-primary' value='Go'></div>   
</div> 
</form>
<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#particirange" aria-expanded="false" aria-controls="collapseExample">
List of Sub categories
</button>
<div class="collapse" id="particirange">
<div class="card card-body">
<div class="table-responsive res">
<table class="table">
<tr>
<th>No</th>
<th>Sub Category</th>
<th colspan='2'>Action</th>
</tr>
<?php
$result_scrap=$dbh->query("select * from scrap where type='subcat'"); 
$row_scrap=$result_scrap->fetchObject(); 
$count_scrap=$result_scrap->rowCount();
if($count_scrap>0){ $ai=1; do{
$result_subs=$dbh->query("select * from scrap where type='prodcat' and item='$row_scrap->item3'");
$row_subs=$result_subs->fetchObject();	
echo "<tr>
<td>".$ai++."</td>
<td>".$row_scrap->item2."<br><span style='color:maroon;font-weight:bold;'>[".$row_subs->item2."]</span></td>
<td class='fa_ic'>
<img src='img/writeonpaper.png' style='width:40%;'></td>
<td class='fa_ic'><img src='img/trashbin.png' style='width:40%;'></td>
</tr>";
}while($row_scrap=$result_scrap->fetchObject());}

?>
</table>
</div></div>
</div> 
</div></div>
</div>
<!--Card -->
<!--Card -->
<div class='col-lg-12'>
<div class='card'>
<div class='card-header card-header-success'>
<h4 class='card-title'><b>SUB CATEGORY ATTRIBUTES</b></h4>
</div>
<div class='card-body' id='form_allrows'>
 <div id="alert_out"></div> 
<input type='hidden' id='kp' value='1'>
<input type='hidden' id='kp_rows' value='1'>
<div class='row'>
<div class='col-md-6'>
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
<div class='col-lg-6' id="div_cp">
<select class='form-control' id='subcatid' name='subcatid'>
  <option>Select Sub Category</option>
</select>
</div>
</div><div class="col-md-12"><br></div>
<div class="row">        
  <div class="col-md-12">
<table onClick='get_no(1)' class="table table-striped table-bordered">
<thead>
<tr style="font-weight: bold;">
<th width="2%">No</th>
<th>Item Name</th>
<th>Item Type</th>
</tr>
</thead>
<tr><td>1.</td>
<td><input type='text' class='form-control' id="item_name1" placeholder='Item Name' required></td>
<td>
<select id="item_type1" class="form-control">
<option value="1">Text Box</option>
<option value="2">Multi-Choice</option>    
</select>    
</td>
</tr>
</table>
<div id="allrows_rows" style='width:100%;'></div>
</div> 
 <div class='col-md-12'>
<input type='submit' onClick='submit_attributes()' style='float:right;' class='btn btn-md btn-primary' value='Submit'>    
<div class='col-lg-2' style='float:left' onClick="addpkg_rows()"> 
<img src='img/plus.png' style='width:30%;'></div>

<div class='col-lg-2' style='float:left' onClick="rmpkg_rows()"> 
<img src='img/minus.png' style='width:30%;'>
</div>
</div>
</div> 
</div></div>
</div>
<!--Card -->
<!--Card -->
<div class='col-lg-12'>
<div class='card'>
<div class='card-header card-header-warning'>
<h4 class='card-title'><b>MULTI-CHOICE ENTRIES</b></h4>
</div>
<div class='card-body' id='form_allrows2'>
 <div id="alert_out2"></div> 
<input type='hidden' id='kp2' value='1'>
<input type='hidden' id='kp_rows2' value='1'>
<div class='row'>
<div class='col-md-3'>
<input type="hidden" id="idcatid2">
<label>SELECT CATEGORY</label>
<select class="form-control" name="catid2" onchange="get_values2(this);" id="catid2">
<option>Select Category</option>
<?php
$result_cat=$dbh->query("select * from scrap where type='prodcat' order by item2 asc");
$count_cat=$result_cat->rowCount();
$row_cat=$result_cat->fetchObject();
if($count_cat>0){do{echo "<option value='".$row_cat->item."'>".$row_cat->item2."</option>"; }while($row_cat=$result_cat->fetchObject());}
?>  
</select>         
</div> 
<div class='col-lg-3' id="div_cp2">
<input type="hidden" id="idsub_catid">
<label>SELECT SUB-CATEGORY</label>
<select class='form-control' id='sub_catid' name='sub_catid' onchange="get_values3(this);">
  <option>Select Sub-Cat</option>
</select>
</div>
<div class='col-lg-3' id="div_cp3">
<label>SELECT ATTRIBUTES</label>
<select class='form-control' id='attrid' name='attrid'>
  <option>Select Attribute</option>
</select>
</div>
  <div class="col-md-3">
<table onClick='get_no2(1)' class="table table-striped table-bordered">
<thead>
<tr style="font-weight: bold;">
<th width="2%"><b style="font-weight: bold;color: maroon;">No</b></th>
<th><b style="font-weight: bold;color: maroon;">MULTI CHOICE OPTIONS</b></th>
</tr>
</thead>
<tr><td>1.</td>
<td><input type='text' class='form-control' id="mult_name1" placeholder='Item Name' required></td>
</tr>
</table>
<div id="allrows_rows2" style='width:100%;'></div>
</div> 
</div><div class="col-md-12"><br></div>
<div class="row">  
<div class="col-md-12">      
<input type='submit' onClick='submit_mults()' style='float:left;' class='btn btn-md btn-primary' value='Submit'> 

<div class='col-md-2' style='float:right' onClick="rmpkg_rows2()"> 
<img src='img/minus.png' style='width:30%;'>
</div>
<div class='col-md-2' style='float:right' onClick="addpkg_rows2()"> 
<img src='img/plus.png' style='width:30%;'></div>
</div>
</div> 
</div></div>
</div>
<!--Card -->
<!--Card -->
<div class='col-lg-6'>
<div class='card'>
<div class='card-header card-header-primary'>
<h4 class='card-title'><b>DISTRICT</b></h4>
</div>
<div class='card-body'>
<?php
if(isset($_POST["submit_dist"])){
$district=$_POST["district"];
$result_scrap=$dbh->query("select * from scrap order by autoid desc"); 
$row_scrap=$result_scrap->fetchObject(); 
$catid="dst".($row_scrap->autoid+1);               
$insert_scrap=$dbh->query("insert into scrap (item,item2,type) values('$catid','$district','district')");
if($insert_scrap){echo "<div class='alert alert-success'>Success : District Added. </div>";}
}
?>
<form method='post' autocomplete="off">
<input type='hidden' name='todo' value='insert'>
<div class='row'>
<div class='col-md-10'>         
<input type="text" name="district" class="form-control" placeholder="Enter District Name">
</div>        
<div class='col-md-2'><input type='submit' name='submit_dist' class='btn btn-sm btn-primary' value='Go'></div> </div> 
</form>
<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseDis" aria-expanded="false" aria-controls="collapseExample">
List of District
</button>

<div class="collapse" id="collapseDis">
<div class="card card-body">
<div class="table-responsive res">
<table class="table">
<tr>
<th>No</th>
<th>Name</th>
<th colspan='2'>Action</th>

</tr>
<?php
$result_scrap=$dbh->query("select * from scrap where type='district'"); 
$row_scrap=$result_scrap->fetchObject(); 
$count_scrap=$result_scrap->rowCount();
if($count_scrap>0){ $ai=1; do{
echo "<tr>
<td>".$ai++."</td>
<td>".$row_scrap->item2."</td>
<td class='fa_ic'>
<img src='img/writeonpaper.png' style='width:40%;'></td>
<td class='fa_ic'><img src='img/trashbin.png' style='width:40%;'></td>
</tr>";
}while($row_scrap=$result_scrap->fetchObject());}

?>
</table>
</div></div>
</div> 
</div></div>
</div> 
<!--Card -->
<!--Card -->
<div class='col-lg-6'>
<div class='card'>
<div class='card-header card-header-primary'>
<h4 class='card-title'><b>CONSTITUENCY</b></h4>
</div>
<div class='card-body'>
<?php
if(isset($_POST["submit_const"])){
$dis_name=$_POST["dis_name"];
$const=$_POST["const"];
$result_scrap=$dbh->query("select * from scrap order by autoid desc"); 
$row_scrap=$result_scrap->fetchObject(); 
$subcatid="cnt".($row_scrap->autoid+1);               
$insert_scrap=$dbh->query("insert into scrap (item,item2,item3,type) values('$subcatid','$const','$dis_name','const')");
if($insert_scrap){echo "<div class='alert alert-success'>Success : Constituency Added. </div>";}
}
?>
<form method='post' autocomplete="off">
<div class='row'>
<div class='col-md-5'>
<select class="form-control" name="dis_name">
<option>Select District</option>
<?php
$result_subs=$dbh->query("select * from scrap where type='district' order by item2 asc");
$count_subs=$result_subs->rowCount();
$row_subs=$result_subs->fetchObject();
if($count_subs>0){do{echo "<option value='".$row_subs->item."'>".$row_subs->item2."</option>"; }while($row_subs=$result_subs->fetchObject());}
?>  
</select>         
</div> 
<div class="col-md-5">
<input type="text" name="const" class="form-control" placeholder="Attach Constituency"> 
</div>        
<div class='col-md-2'><input type='submit' name='submit_const' class='btn btn-sm btn-primary' value='Go'></div>   
</div> 
</form>
<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#const" aria-expanded="false" aria-controls="collapseExample">
List of Constituency
</button>
<div class="collapse" id="const">
<div class="card card-body">
<div class="table-responsive res">
<table class="table">
<tr>
<th>No</th>
<th>Locations</th>
<th colspan='2'>Action</th>
</tr>
<?php
$result_scrap=$dbh->query("select * from scrap where type='district'"); 
$row_scrap=$result_scrap->fetchObject(); 
$count_scrap=$result_scrap->rowCount();
if($count_scrap>0){ $ai=1; do{
$result_subs=$dbh->query("select * from scrap where type='const' and item3='$row_scrap->item'");
$row_subs=$result_subs->fetchObject();  
$count_subs=$result_subs->rowCount();
echo "<tr>
<td>".$ai++."</td>
<td><span style='color:maroon;font-weight:bold;font-size: 18px;'>[".$row_scrap->item2."]</span><br>";
if($count_subs>0){$n=1; do{echo $n++.". ".$row_subs->item2.", ";}
while($row_subs=$result_subs->fetchObject());}else{echo "Add Constituency";}
echo"</td>
<td class='fa_ic'>
<img src='img/writeonpaper.png' style='width:40%;'></td>
<td class='fa_ic'><img src='img/trashbin.png' style='width:40%;'></td>
</tr>";
}while($row_scrap=$result_scrap->fetchObject());}

?>
</table>
</div></div>
</div> 
</div></div>
</div>
<!--Card -->
<!--Card -->
<div class='col-lg-6'>
<div class='card'>
<div class='card-header card-header-danger'>
<h4 class='card-title'><b>SUBSCRIPTION PLANS</b></h4>
</div>
<div class='card-body'>
<?php
if(isset($_POST["submit_plan"])){
$plan_name=$_POST["plan_name"];
$plan_price=$_POST["plan_price"];
$result_scrap=$dbh->query("select * from scrap order by autoid desc"); 
$row_scrap=$result_scrap->fetchObject(); 
$plnid="pln".($row_scrap->autoid+1);               
$insert_scrap=$dbh->query("insert into scrap (item,item2,item3,type) values('$plnid','$plan_name','$plan_price','payment_plan')");
if($insert_scrap){echo "<div class='alert alert-success'>Success : Payment Plan. </div>";}
}
?>
<form method='post' autocomplete="off">
<div class='row'>
<div class='col-md-5'>
<input type="text" name="plan_name" class="form-control" placeholder="Enter Plan Name">         
</div> 
<div class="col-md-5">
<input type="number" name="plan_price" class="form-control" placeholder="Plan Price"> 
</div>        
<div class='col-md-2'><input type='submit' name='submit_plan' class='btn btn-sm btn-primary' value='Go'></div>   
</div> 
</form>
<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#plans" aria-expanded="false" aria-controls="collapseExample">
List of Plans
</button>
<div class="collapse" id="plans">
<div class="card card-body">
<div class="table-responsive res">
<table class="table">
<tr>
<th>No</th>
<th>Name</th>
<th>Price</th>
<th colspan='2'>Action</th>
</tr>
<?php
$result_scrap=$dbh->query("select * from scrap where type='payment_plan'"); 
$row_scrap=$result_scrap->fetchObject(); 
$count_scrap=$result_scrap->rowCount();
if($count_scrap>0){ $ai=1; do{
echo "<tr>
<td>".$ai++."</td>
<td>".$row_scrap->item2."</td>
<td><span style='color:maroon;font-weight:bold;'>[".number_format($row_scrap->item3)."]</span></td>
<td class='fa_ic'>
<img src='img/writeonpaper.png' style='width:40%;'></td>
<td class='fa_ic'><img src='img/trashbin.png' style='width:40%;'></td>
</tr>";
}while($row_scrap=$result_scrap->fetchObject());}

?>
</table>
</div></div>
</div> 
</div></div>
</div>
<!--Card -->

<!--row-->
</div>
</div>
<script>
function fun_edit(ai,sld){$("#"+sld+ai).toggle(500);}
var page_loading=function(){$("#loadin").animate({width: "100%", height: "100%", opacity: "0.4"},500);}
var page_close=function(){$("#loadin").animate({width: "0%", height: "0%", opacity: "0"},500);}
</script>     
<?php lscript(); ?>
</body>

</html>
