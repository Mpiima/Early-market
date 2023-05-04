<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php kheader(); ?>
</head>
<body class="">
<?php leftbar(); ?>

<div class="col-md-12">
<div class="card">
<div class="card-header card-header-primary">
    <div class="row">
        <div class="col-lg-9">
        <h4 class="card-title "><b>SUBSCRIPTION</b></h4> 
        </div>
        <div class="col-lg-3">
        <a class="btn btn-outline" href="renew.php" style="color:white">Renew Subscription</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
        <h4 class="card-title "><b>STATUS</b>  : <span style="color:red"><b>EXPIRED</b></span></h4> 
        </div>
        <div class="col-lg-3">
        
        </div>
    </div>
</div>
<div class="card-body">

<table class="table table-striped table-bordered">
<thead>
<tr>
<th><b>Subscription_Id</b></th>
<th><b>Date of Subscription</b></th>
<th><b>Expiration Date</b></th>
<th><b>Period</b></th>
<th><b>Amount Paid</b></th>
</tr></thead>
<tbody>
    <tr><td>SUB0001</td>
    <td>02/04/2023</td>
    <td>30/04/2023</td>
    <td>30 <span style="color:red">days</span></td>
    <td>30000</td>
</tr>
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
