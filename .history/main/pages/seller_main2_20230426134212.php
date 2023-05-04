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



<!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>




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
       
        if($row_sub1->expirydate < $dt){
            echo  '<a class="btn btn-outline" onclick="causeAlert()" href="" style="color:white">Add Product</a>';
        }else{
          echo  '<a type="button" class="btn btn-primary btn btn-outline" data-toggle="modal" data-target=".bd-example-modal-lg" href="addproducts.php" style="color:white">Add Product</a>';
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

                </td>
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
