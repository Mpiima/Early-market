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
  <div class="modal-dialog modal-lg" role="document">
  <<div class="modal-dialog" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
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

</form>
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
