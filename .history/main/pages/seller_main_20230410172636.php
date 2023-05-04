<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php kheader(); ?>
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
        <h4 class="card-title "><b>PRODUCTS</b></h4> 
        </div>
        <div class="col-lg-2">
        <a class="btn btn-success" href="addproduct.php">Add Product</a>
        </div>
    </div>
</div>
<div class="card-body">

<table class="table table-striped table-bordered">
<thead>
<tr>
<th><b>No</b></th>
<th><b>Name</b></th>
<th><b>Price</b></th>
<th><b>Image</b></th>
<th><b>Today's Views</b></th>
<th><b>Weekly Views</b></th>
<th><b>Monthly Views</b></th>
<th><b>Action</b></th>
</tr></thead>
<tbody>
    <tr><td>1</td>
    <td>Sugar</td>
    <td>60000</td>
    <td>image</td>
    <td>4</td>
    <td>6</td>
    <td>6</td>
    <td>edit|delete|view more</td></tr>
</tbody>

</table>
</div>
</div>
</div>
</div>
</div>
<!-- Table showing list of seller's products -->


<!--ends here -->



<?php lscript(); ?>
</body>

</html>
