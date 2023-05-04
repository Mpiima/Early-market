<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>

<head>



<?php kheader(); ?>

<script>
      function causeAlert() {
         window.alert("Hello, our dear client, Your Account Has Expired, Renew or contact us for support. Thank you");
      }
    </script>



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



</head>
<body class="">
<?php leftbar(); ?>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 <form method="post" enctype="multipart/form-data" >
<div class="row">
  <div class="col-md-6">
<label style='font-weight:bold;color:#000000;'>Product Name</label>
<input type="text" name="title" class="form-control">
 </div>
<div class="col-md-6">
<label style='font-weight:bold;color:#000000;'>Location</label>  
<select class="form-control" name="location" required>
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

<div class="col-lg-12"><br></div>
<div class="row">
<input type='hidden' id='kp' value='1'>
<input type='hidden' id='kp_rows' value='1'>	
<div class="col-md-6">
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
<div class='col-lg-6' id="div_cp">
<label style='font-weight:bold;color:#000000;'>Category Type</label>
<select class='form-control' id='subcatid' name='subcatid'>
  <option>Select</option>
</select>
</div></div>

<div class="col-md-12"><br></div>
<!-- Product description textarea -->
<div class="row"> 
<div class="col-lg-4">
<label style='font-weight:bold;color:#000000;'>Price</label>
<input type="number" name="price"  class="form-control">
</div>
<div class="col-lg-8">
<label style='font-weight:bold;color:#000000;'>short description</label>
<textarea id="editor" name="description" class="form-control" style="height:500px;"></textarea>
</div>

</div>


<div class="col-md-12"><br></div>
<!-- Product description textarea -->
<div class="col-lg-12">
<label style='font-weight:bold;color:#000000;'>Detailed Info</label>
<textarea id="editor" name="detailed_description" class="form-control" style="height:300px;"></textarea>
</div>



<!-- //image upload================================ -->
<div class="col-md-12"><br></div>
<div class="col-lg-12">
<label style='font-weight:bold;color:#000000;'>More Info</label>
<textarea id="" name="moreinfo" class="form-control" style="height:500px;"></textarea>
</div>

<div class="col-lg-12">
<label style='font-weight:bold;color:#000000;'>Images</label>
<input type="file" name="imageFile[]" required multiple class="form-control">
</div>
<!-- Image upload -->
<div class="col-md-12"><br></div>
<!-- Submit button -->
<div class="col-md-4">
<div class="form-group">
<input type="submit" name="submitbtn" id="submitbtn" value="SUBMIT" class="btn btn-success">
</div>
 </div>
</div>
<div class="col-md-12"><br></div>
</form>
    </div>
  </div>
</div></div>




<div class="col-md-12">
<div class="card">
<div class="card-header card-header-primary">
    <div class="row">
        <div class="col-lg-10">
        <h4 class="card-title "><b>PRODUCTS</b><br></h4> 
        <?php
      if (isset($_POST['submitbtn'])) {
        $clientid=$_SESSION['rolenumber'];
        $yy=date("Y"); $fyy=substr($yy,2,2);$mm=date("m"); $dd=date("d");
        $hi=date("h"); $mi=date("i");$sa=date("sa"); $fsa=substr($sa,0,2);   
        $tit="pdt";

        $result_products=$dbh->query("select * from products order by autoid desc");
        $row_products=$result_products->fetchObject();
        $count_products=$result_products->rowCount();
        if($count_products>0){
          $pdt=$row_products->autoid +1;
        }else{
          $pdt=1;
        }
        $productid=$tit.$pdt.$fyy.$mm.$dd.$hi.$mi.$fsa;
        $title=$_POST['title'];
        $description=$_POST['description'];
        $categ =$_POST['catid'];
        $subcat=$_POST['subcatid'];
        $location=$_POST['location'];
        $price=$_POST['price'];
        $more_info=$_POST['moreinfo'];
        $detail_decription=$_POST['detailed_description'];
        $uploadFolder = 'uploads/';

        foreach ($_FILES['imageFile']['tmp_name'] as $key => $image) {
            $imageTmpName = $_FILES['imageFile']['tmp_name'][$key];
            $imageName = $_FILES['imageFile']['name'][$key];
            $result = move_uploaded_file($imageTmpName,$uploadFolder.$imageName);
            // save to database
            $query = "INSERT INTO productimg SET imgName='$imageName',clientid='$clientid',productid='$productid', status=1 " ;
            $run = $dbh->query($query);
        }
        if ($result) {
             '<script>alert("Images uploaded successfully !")</script>';
        }
        $insert_products=$dbh->query("INSERT INTO products (title,productid,description,categoryid,subcatid,
        status,location,price,clientid,addintional_info,detailed_description
        )values('$title','$productid','$description','$categ','$subcat',1,'$location','$price','".$_SESSION['rolenumber']."','$more_info',
        '$detail_decription')");
        if($insert_products){
          echo "<div class='alert alert-success'>Product added successfully</div>";
          echo '<script>window.location.href="products.php";</script>';
        }else{
          echo "<div class='alert alert-danger'>Failed!</div>";
          
        }
    }

      ?>
        
        </div>
        <div class="col-lg-2">
        <?php
          $result_sub1=$dbh->query("select * from status_sub where clientid='".$_SESSION['rolenumber']."'");
         $count_sub1=$result_sub1->rowCount();
         $row_sub1=$result_sub1->fetchObject();
         $dt=date('Y-m-d');
       
        if($row_sub1->expirydate < $dt){
            echo  '<a class="btn btn-outline" onclick="causeAlert()" href="" style="color:white">Add Product</a>';
        }else{
          echo  '<a type="button" class="btn btn-primary btn btn-outline" data-toggle="modal" data-target=".bd-example-modal-lg" href="" style="color:white">Add Product</a>';
        }
        ?>
       
        </div>
    </div>
</div>
<div class="card-body">
<table  id="example" class="table table-striped" style="width:100%">
<thead>
  <tr>
  <th>No</th>
  <th>Image</th>
  <th width="15%">Abouts</th>
  <th width="20%">Details</th>
  <th width="25%">Info</th>
  <th>Seller Abouts</th>
  <th>Actions</th>
</tr>
</thead>
<tbody>
<?php 
$result_products=$dbh->query("select * from products where clientid='".$rolenumber."' and autoid>0 order by autoid desc");
$count_products=$result_products->rowCount();
$row_products=$result_products->fetchObject();
if($count_products>0){ $m=1; do{
//product categories
$result_category = $dbh->query("select * from scrap where item='".$row_products->categoryid."' and type='prodcat'");
$row_category=$result_category->fetchObject();
//product subcategories  
$result_subcat = $dbh->query("select * from scrap where item='".$row_products->subcatid."' and type = 'subcat'");
$row_subcat=$result_subcat->fetchObject(); 
//seller 
$result_seller = $dbh->query("select * from users where rolenumber='".$row_products->clientid."'");
$row_seller=$result_seller->fetchObject(); 
//product attributes
$result_attributes = $dbh->query("select * from prod_attributes where productid='".$row_products->productid."'");
$row_attributes=$result_attributes->fetchObject(); 
$count_attributes=$result_attributes->rowCount();
//product images 
$result_cabin = $dbh->query("select * from productimg where productid='$row_products->productid'");
$row_cabin=$result_cabin->fetchObject();
$count_cabin=$result_cabin->rowCount(); 
$image = (!empty($row_cabin->imgName)) ? $row_cabin->imgName : 'uploads/noimage.jpg';  
if($row_products->bargain==1){ $deal = "Negotiable"; }
elseif ($row_products->bargain==2) { $deal = "Not Negotiable"; }
else{ $deal = ""; }
echo "
<tr>
<td>".$m++.".</td>
<td><img src='uploads/".$image."' alt='Add Images' style='width:100px;max-height:100px;height: expression(this.height > 100 ? 100: true);min-height:100px;height: expression(this.height < 100 ? 100: true);'></td>
<td>".$row_category->item2."<br><span style='font-weight:bold;color:maroon;'>[".$row_subcat->item2."]</span><br><span>Price: [".number_format($row_products->price)."]<span><br><span style='color:maroon;font-weight:bold;'>".$deal."</span></td>
<td>";if($count_attributes>0){ do{
echo "<span>".$row_attributes->singleName." </span>&nbsp&nbsp<span style='color:blue;font-weight:bold;'>".$row_attributes->singleValue."</span><br>";  
$result_details = $dbh->query("select * from scrap where autoid='".$row_attributes->multiple_choice."'");
$row_details=$result_details->fetchObject();
$result_att = $dbh->query("select * from subcat_attributes where attrid='".$row_details->item."'");
$row_att=$result_att->fetchObject();
echo "
<span>".$row_att->item_name."</span>&nbsp&nbsp<span style='color:blue;font-weight:bold;'>".$row_details->item2."</span>"; }
while($row_attributes=$result_attributes->fetchObject()); }
echo "</td>
<td>".$row_products->description."</td>
<td>".$row_seller->firstname." ".$row_seller->lastname."<br><span style='color:maroon;font-weight:bold;'>[".$row_seller->phonenumber."]</span><br>".$row_seller->email."</td>
<td class='fa_ic'>
<img src='img/writeonpaper.png' style='width:50%;'>
&nbsp;| &nbsp;<img src='img/trashbin.png' style='width:50%;'></td>
</tr>
";  
}while($row_products=$result_products->fetchObject());}
?>
  
</tbody>  
</table>



</div>
</div>
</div>
</div>
</div>
<!-- Table showing list of seller's products -->


<!--ends here -->



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
 $(document).ready(function () {
    $('#example').DataTable();
});
        </script>
<?php lscript(); ?>

<script src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/6/tinymce.min.js'></script>
<script  src="script.js"></script>
</body>

</html>
