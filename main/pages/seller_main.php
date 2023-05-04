<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<head>
<?php kheader(); ?>

<script>
      function causeAlert() {
         window.alert("Hello, our dear client, Your Account Has Expired, Renew or contact us for support. Thank you");
      }
    </script>
</head>
<body class="">
<?php leftbar(); ?>

<!-- statistics========================= -->
<div class="row">
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-warning card-header-icon">
<div class="card-icon">
<i class="material-icons">products</i>
</div>
<p class="card-category">Available products</p>
<h3 class="card-title">4,000

</h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons text-danger"></i>
<a href="#pablo"></a>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-success card-header-icon">
<div class="card-icon">
<i class="material-icons">Views</i>
</div>
<p class="card-category">Total Product Views</p>
<h3 class="card-title">5,000</h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons"></i> 
</div>
</div>
</div>
</div>

<div class="col-lg-4 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-info card-header-icon">
<div class="card-icon">
<i class="material-icons">Subscription</i>
</div>
<p class="card-category">Days</p>
<h3 class="card-title">4</h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons"></i>
</div>
</div>
</div>
</div>
</div>
<!-- <!======end ==== !> -->
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-primary">
    <div class="row">
        <div class="col-lg-10">
        <h4 class="card-title "><b>PRODUCTS VIEW STATISTICS</b></h4> 
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
          echo  '<a class="btn btn-outline" href="products.php" style="color:white">View Product</a>';
        }
        ?>
       
        </div>
    </div>
</div>
<div class="card-body">

<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
               <th>No</th>
                <th>Image</th>
                <th>Product</th>
                <th>Today's Views</th>
                <th>Weekly Views</th>
                <th>Monthly Views</th>
                <th>Action</th>
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
<td><br><span style='font-weight:bold;color:maroon;'>".$row_products->title."</span><br>".$row_category->item2."<br><span style='font-weight:bold;color:maroon;'>[".$row_subcat->item2."]</span><br><span>Price: [".number_format($row_products->price)."]<span><br><span style='color:maroon;font-weight:bold;'>".$deal."</span></td>
<td>28</td>
<td>400</td>
<td>600</td>
<td><i style='color:red;' class='fa fa-trash'></i>  | <i style='color:orange;' class='fa fa-eye'></i>
</td>
</tr>
";  
}while($row_products=$result_products->fetchObject());}
?>
  
</tbody> 


        </tbody>
        <tfoot>
            <tr>
            <th>Product</th>
                <th>Price</th>
                <th>Today's Views</th>
                <th>Weekly Views</th>
                <th>Monthly Views</th>
                <th>Action</th>
            </tr>
        </tfoot>

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
</body>

</html>
