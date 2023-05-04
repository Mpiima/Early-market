<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
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
        <?php
          $result_sub1=$dbh->query("select * from status_sub where clientid='".$_SESSION['rolenumber']."'");
         $count_sub1=$result_sub1->rowCount();
         $row_sub1=$result_sub1->fetchObject();
         $dt=date('Y-m-d');
       
        if($row_sub1->expirydate > $dt){
        
        }else{
          echo  '<a class="btn btn-outline" href="addproducts.php" style="color:white">Add Product</a>';
        }
        ?>
       
        </div>
    </div>
</div>
<div class="card-body">

<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Today's Views</th>
                <th>Weekly Views</th>
                <th>Monthly Views</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Laptop</td>
                <td>40000</td>
                <td>29</td>
                <td>100</td>
                <td>410</td>
                <td>delete|edit|viewMore</td>
            </tr> 
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
