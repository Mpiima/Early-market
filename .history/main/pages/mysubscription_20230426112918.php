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
        <h4 class="card-title "><b>SUBSCRIPTION STATUS</b>  : 
        <?php
          $result_sub1=$dbh->query("select * from status_sub where clientid='".$_SESSION['rolenumber']."'");
         $count_sub1=$result_sub1->rowCount();
         $row_sub1=$result_sub1->fetchObject();
         $dt=date('Y-m-d');
       
        if($row_sub1->expirydate > $dt){
        echo '<span style="color:blue;background-color:white;padding:8px;"><b>ACTIVE</b></span>';
        }else{
            echo  '<span style="color:red;background-color:white;padding:8px;"><b>EXPIRED</b></span>';
        }
        ?>
       
        
        </h4> 
        </div>
        <div class="col-lg-3">
       <?php if($row_sub1->expirydate > $dt){
       echo '';
       }else{
              echo '<a class="btn btn-outline" href="renew.php" style="color:white">Renew Subscription</a>';
       }
         ?>
        </div>
    </div>
</div>
<div class="card-body">

<table id="example" class="table table-striped" style="width:100%">
<thead>
<tr>
<th><b>Subscription_Id</b></th>
<th><b>Date of Subscription</b></th>
<th><b>Expiration Date</b></th>
<th><b>Period<span style="color:red;font-size:12px;">(months)</span></b></th>
<th><b>Amount Paid</b></th>
</tr></thead>
<tbody>
    <?php 
    $result_sub=$dbh->query("select * from subscription where client_id='".$_SESSION['rolenumber']."'");
    $count_sub=$result_sub->rowCount();
    $row_sub=$result_sub->fetchObject();
    if($count_sub>0){
        do{ 
        ?>
  <tr><td> <?php echo $row_sub->ref_no; ?></td>
    <td><?php echo $row_sub->created_on; ?></td>
    <td><?php echo $row_sub->expiry_date; ?></td>
    <td><?php echo $row_sub->period; ?></td>
    <td><?php echo $row_sub->amount; ?></td></tr>
    <?php
        }while($row_sub=$result_sub->fetchObject());
    }
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



<?php lscript(); ?>
</body>

</html>
