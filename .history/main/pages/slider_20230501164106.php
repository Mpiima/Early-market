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
<!-- //image upload================================ -->
<div class="col-md-12"><br></div>
<div class="row">
<div class="col-lg-6">
<label style='font-weight:bold;color:#000000;'>Link</label>
<input type="text" class="form-control" name="linkto"  value="#">
</div>
<div class="col-lg-6">
<label style='font-weight:bold;color:#000000;'>Position</label>
<select class="form-control" name="position" required>
    <option>-Select-</option>
    <option value="1">Main Slider</option>
    <option value="2">Mini SLider1</option>
    <option value="3">Mini Slider2</option>
    
</select>
</div>
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
        <h4 class="card-title "><b>SLIDERS</b><br></h4> 
        <?php
      if (isset($_POST['submitbtn'])) {
        $clientid=$_SESSION['rolenumber'];
        $link=$_POST['linkto'];
        $uploadFolder = 'uploads/sliders/';

        foreach ($_FILES['imageFile']['tmp_name'] as $key => $image) {
            $imageTmpName = $_FILES['imageFile']['tmp_name'][$key];
            $imageName = $_FILES['imageFile']['name'][$key];
            $result = move_uploaded_file($imageTmpName,$uploadFolder.$imageName);
            // save to database
            $query = "INSERT INTO sliders SET imgName='$imageName',clientid='$clientid', status=1, linkto='$link' " ;
            $run = $dbh->query($query);
        }
        if ($result) {
            echo '<script>alert("Images uploaded successfully !")</script>';
        }
    }

      ?>
        
        </div>
        <div class="col-lg-2">
    
<a type="button" class="btn btn-primary btn btn-outline" data-toggle="modal" data-target=".bd-example-modal-lg" href="" style="color:white">Add SLIDER</a>
        </div>
    </div>
</div>
<div class="card-body">

<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Linkto</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $result_products=$dbh->query("SELECT * FROM products where clientid='".$_SESSION['rolenumber']."'");
            $count_products=$result_products->rowCount();
            $row_products=$result_products->fetchObject();
            if($count_products>0){
                do{
                    ?>
                      <tr>
                <td><?php echo $row_products->title; ?></td>
                <td><?php echo $row_products->price; ?></td>
                            
            </tr>
                    <?php

                }while( $row_products=$result_products->fetchObject());
            }
            ?>
           
        </tbody>
        <tfoot>
            <tr>
            <th>Product</th>
                <th>Price</th>
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

<script src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/6/tinymce.min.js'></script>
<script  src="script.js"></script>
</body>

</html>
