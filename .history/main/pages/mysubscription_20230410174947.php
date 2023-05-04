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
