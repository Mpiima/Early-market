<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>
<script src='../js/jquery.js'></script>
<script type="text/javascript">
function change_values(obj){
var page="split_id";
var val=obj.value;
var tt=obj.id;
$.ajax({
type: "POST",
url: "middlez.php",
data: {page:page,val:val,tt:tt},
success: function(user_out){
  $("#lt"+obj.id).show();
document.getElementById("lt"+obj.id).innerHTML=user_out;
}
});
return false; }

function get_values(names,uid,obj){
document.getElementById("id"+obj).value=uid;
document.getElementById(obj).value=names;
$("#lt"+obj).hide();

if(obj=="seller"){
var page="pplan";
$.ajax({
type: "POST",
url: "middlez.php",
data: {page:page,uid:uid},
success: function(user_out){
document.getElementById("div_cp").innerHTML=user_out;
}
});
return false;}}
</script>

</head>

<body class="">
<?php leftbar(); ?>

<div class="col-lg-12">
<div class="card">
<div class="card-header card-header-tabs card-header-primary">
<div class="nav-tabs-navigation">
<div class="nav-tabs-wrapper">
<ul class="nav nav-tabs" data-tabs="tabs">
<li class="nav-item">
<a class="nav-link active" href="#entryprod" data-toggle="tab">
<i class="material-icons">create</i>Enter Payment
<div class="ripple-container"></div>
</a></li>
<li class="nav-item">
<a class="nav-link" href="#listprods" data-toggle="tab">
<i class="material-icons">list</i> View Payment
<div class="ripple-container"></div>
</a></li></ul>
</div></div></div>
<div class="card-body">
<div class="tab-content">
<div class="tab-pane active" id="entryprod">
<!--entry plans reports-->
<?php 
if (isset($_POST['submit_payment'])) {
$get_seller=$_POST['get_seller'];
$pplan=$_POST['get_plan'];
$monthpaid=$_POST['monthpaid'];
$totalamount=$_POST['totalamount'];
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$paidamount=$_POST['paidamount'];
$balance=($totalamount-$paidamount);

$yy=date("Y");$fyy=substr($yy,2,2);
$mm=date("m");$dd=date("d");
$hi=date("h");$mi=date("i");
$sa=date("sa");$fsa=substr($sa,0,2);   
$payid="pm".$fyy.$mm.$dd.$hi.$mi.$fsa;
$insert_payment=$dbh->query("insert into payments(sellerid,planid,expected_amount,paid_amount,balance,fromdate,enddate,paymentid,ouruser,monthpaid) values('$get_seller','$pplan','$totalamount','$paidamount','$balance','$date1','$date2','$payid','$rolenumber','$monthpaid')");
if($insert_payment){echo "<a class='list-group-item'><div class='alert alert-success'>Success : Subscription fee added. </div></a>";
}else{"<a class='list-group-item'><div class='alert alert-danger'>Error : Payment not added. </div></a>"; } } ?>

<form method="post" autocomplete="off">
<div class="row">
<div class="col-lg-3">
<label style="font-weight:bold;color: #000000;">Attach Seller</label>
<input type="hidden" id="idseller" name="idseller">
<input type='text' onKeyup="change_values(this)" class='form-control' id='seller' placeholder='Search By Name' name="seller">
<div id='ltseller' class='lt'></div>
</div>
<div class='col-lg-3' id="div_cp">
<label style="font-weight:bold;color: #000000;">Payment Plan Type</label>
<input type='text' class='form-control'  id="pplan" name="pplan" readonly></div>
<div class='col-lg-3'>
<label style="font-weight:bold;color: #000000;">Plan Price:</label>
<input type='text' class='form-control' value="0"  id="pprice" name="pprice" readonly>
</div>
<div class='col-lg-3'>
<label style="font-weight:bold;color: #000000;">Months Paid:</label>
<input type='text' class='form-control' value="0" id="monthpaid" name="monthpaid"></div>
</div>
<br>
<div class="row">

<div class='col-lg-3'>
<label style="font-weight:bold;color: #000000;">Expected Amount:</label>
<input type='text' class='form-control' name="totalamount" value="0" id="totalamount" readonly></div>
<div class='col-lg-3'>
<label style="font-weight:bold;color: #000000;">Paid Amount:</label>
<input type='text' class='form-control' name="paidamount" value="0" id="paidamount"></div>
<div class='col-lg-3'>
<label style="font-weight:bold;color: #000000;">Subscription Start Date</label>
<input size='16'  type='date' id='date1' name="date1" class='form-control' required></div>
<div class='col-lg-3'>
<label style="font-weight:bold;color: #000000;">Subscription End Date</label>
<input size='16' type='date' id='date2' name="date2" class='form-control' required>
</div>
</div><br>
<div class='form-group'>
<input type="submit" class="btn btn-sm btn-success btn-block" name="submit_payment"  value="Submit">
</div>
</form>
</div>

<!--entry plans reports-->


<div class="tab-pane" id="listprods">

<!--listplans-->
<table id="example" class="table table-striped" style="width:100%">
<thead>
<tr>
<th>No</th>
<th>Seller</th>
<th>Plan Details</th>
<th>Payment Details</th>
<th>Validity</th>
<th>Received By</th>
<th>Action</th>
</tr></thead>
<?php
$result_payments=$dbh->query("select * from payments order by autoid desc");
$count_payments=$result_payments->rowCount();
$row_payments=$result_payments->fetchObject();
if($count_payments>0){$m=1; do{
$result_scrap=$dbh->query("select * from scrap where item='$row_payments->planid' and type='payment_plan'");
$row_scrap=$result_scrap->fetchObject();
$result_users=$dbh->query("select * from users where rolenumber='$row_payments->sellerid'");
$row_users=$result_users->fetchObject();
$result_user2=$dbh->query("select * from users where rolenumber='$row_payments->ouruser'");
$row_user2=$result_user2->fetchObject();
echo "
<tr>
<td>".$m++."</td>
<td>".$row_users->firstname." ".$row_users->lastname."<br><span style='color:maroon;font-weight:bold;'>[".$row_users->phonenumber."]</span></td>
<td>".$row_scrap->item2." Plan<br><span style='color:maroon;font-weight:bold;'>[".number_format($row_scrap->item3)."]</span></td>
<td>Expected:".number_format($row_payments->expected_amount)."<br>
Paid:<span style='color:maroon;font-weight:bold;'>[".number_format($row_payments->paid_amount)."]</span><br>Balance:".number_format($row_payments->balance)."<br>Months Paid: ".$row_payments->monthpaid."</td>
<td>".$row_payments->enddate."</td>
<td>".$row_user2->firstname." ".$row_user2->lastname."<br><span style='color:maroon;font-weight:bold;'>[".$row_user2->phonenumber."]</span></td>
<td>
<button class='btn btn-sm btn-success'>Approve</button>
<button class='btn btn-sm btn-warning'>Edit</button>
<button class='btn btn-sm btn-danger'>Reject</button>
</td>
</tr>
";	
}while($row_payments=$result_payments->fetchObject());}
?>
</table>
<!--listplans-->
</div>

</div>
</div>
</div>
</div>
</div>

 <script>
var countnewitems=function() {
if(document.getElementById('monthpaid').value==''){var monthpaid =0; }else{var monthpaid=document.getElementById('monthpaid').value; }	
if(document.getElementById('get_seller').value==''){var sellerid =''; var sitem=''}else{var sellerid=document.getElementById('get_seller').value; }var sitem=sellerid;   

<?php
$result_users=$dbh->query("select * from users where autoid>0");
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();

if($count_users>0){ do{ 
  $result_scrap=$dbh->query("select * from scrap where item='$row_users->payment_plan'");
  $row_scrap=$result_scrap->fetchObject();
?>

if(sitem=="<?php echo $row_users->rolenumber; ?>"){

  document.getElementById("totalamount").value=parseInt(<?php echo $row_scrap->item3; ?>)*parseInt(monthpaid);
  document.getElementById("totalamount").style.color = 'blue';


  var price=parseInt("<?php echo $row_scrap->item3; ?>");
  document.getElementById("pprice").value=price.toLocaleString();
  document.getElementById("pprice").style.color = 'blue';

  document.getElementById("pplan").style.color = 'blue';
  document.getElementById("seller").style.color = 'maroon';
 
  }

<?php }while($row_users=$result_users->fetchObject());} ?>           
        }
        setInterval(countnewitems,500);
</script>
<?php lscript(); ?>
</body>

</html>
