<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>
</head>

<body class="">
<?php leftbar(); ?>


<?php
//submit active users details
if(isset($_POST["active_users"])){

//update user status
$statusz=$_POST["statusz"];
$payment_plan=$_POST["payment_plan"];
$roleno=$_POST["roleno"];
if($statusz=="active"){$ks=1;}else{$ks=0;}

$update_usersc=$dbh->query("update users set payment_plan='$payment_plan' where rolenumber='$roleno' and (payment_plan='' or payment_plan IS NULL)");

$update_users=$dbh->query("update users set status='$statusz' where rolenumber='$roleno'");
$update_keyfields=$dbh->query("update keyfields set status='$ks' where rolenumber='$roleno'");
if($update_users&&$update_keyfields){echo "<div class='alert alert-success'>Success : User has been deactivated.</div>";}

}

//submit inactive users details
if(isset($_POST["inactive_users"])){
$statusz=$_POST["statusz"];
$roleno=$_POST["roleno"];
if($statusz=="active"){$ks=1;}else{$ks=0;}
$update_users=$dbh->query("update users set status='$statusz' where rolenumber='$roleno'");
$update_keyfields=$dbh->query("update keyfields set status='$ks' where rolenumber='$roleno'");
if($update_users&&$update_keyfields){echo "<div class='alert alert-success'>Success : User has been activated.</div>";}
}
?>
</div>
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-success">
<h4 class="card-title">Active Users</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>No</th>
<th>Names</th>
<th>Phone Nos</th>
<th>Account Expires on</th>
<th colspan='2'>Action</th>
</tr></thead>
<tbody>
<?php
$result_users = $dbh->prepare("select * from users where status='active' and (role='sls' or role='ss') order by firstname asc");
$result_users->execute();
$row_users = $result_users->fetchObject();
$count_users = $result_users->rowCount();

if($count_users>0){
$x=1;
do{
$result_pwdexpiry = $dbh->prepare("select * from keyfields where rolenumber='$row_users->rolenumber'");
$result_pwdexpiry->execute();
$row_pwdexpiry = $result_pwdexpiry->fetchObject();
$count_pwdexpiry = $result_pwdexpiry->rowCount();

echo "
<tr>
<td>".$x++."</td>
<td>".$row_users->firstname." ".$row_users->lastname."</td>
<td>".$row_users->phonenumber.", ".$row_users->phonenumber2."</td>
<td>"; if($count_pwdexpiry>0){echo $row_pwdexpiry->pswdexpiry; } echo "</td>

<td><form method='post'><input type='hidden' name='roleno' value='".$row_users->rolenumber."'>";
if(empty($row_users->payment_plan)){
echo "<select class='form-control' name='payment_plan'>
<option value=''>Subscription Plan</option>";

$result_scrap=$dbh->query("select * from scrap where type='payment_plan' order by item2 asc");
$row_scrap=$result_scrap->fetchObject();
$count_scrap=$result_scrap->rowcount();

if($count_scrap>0){
do{
echo "<option value='".$row_scrap->item."'>".$row_scrap->item2." -> ".$row_scrap->item3."</option>";
}while($row_scrap=$result_scrap->fetchObject());
}else{
echo "<option value=''>Please contact your IT department.</option>";
}

echo "</select>";}
else{echo "<input type='hidden' name='payment_plan' value='".$row_users->payment_plan."'>";}
echo "</td><td>
<select class='form-control' name='statusz'>";
if($row_users->status=="active"){echo "<option value='".$row_users->status."'>Active</option>";}
elseif($row_users->status==0){echo "<option value='".$row_users->status."'>Inactive</option>";}
echo "
<option value='active'>Active</option>
<option value='0'>Inactive</option>
</select>
</td>
<td><input type='submit' style='float:right;' name='active_users' class='btn btn-sm btn-primary' value='Submit'></form></td>
</tr>";
}while($row_users = $result_users->fetchObject());
}else{
echo "
<tr>
<td colspan='7' align='center'>Currently, there is NO users in this table. </td>
</tr>";}
?>
</tbody>
</table>
</div></div>
</div></div>

<div class="col-md-12">
<div class="card">
<div class="card-header card-header-warning">
<h4 class="card-title">Inactive Users</h4>
</div>
<div class="card-body">
<table class="table">
<thead>
<tr>
<th>No</th>
<th>Names</th>
<th>Phone Nos</th>
<th>Expires on</th>
<th colspan="2">Action</th>
</tr></thead>
<tbody>
<?php
$result_users = $dbh->prepare("select * from users where status='0' and (role='sls' or role='ss') order by firstname asc");
$result_users->execute();
$row_users = $result_users->fetchObject();
$count_users = $result_users->rowCount();

if($count_users>0){
$x=1;
do{
$result_pwdexpiry = $dbh->prepare("select * from keyfields where rolenumber='$row_users->rolenumber'");
$result_pwdexpiry->execute();
$row_pwdexpiry = $result_pwdexpiry->fetchObject();
$count_pwdexpiry = $result_pwdexpiry->rowCount();

echo "
<tr>
<td>".$x++."</td>
<td>".$row_users->firstname." ".$row_users->lastname."</td>
<td>".$row_users->phonenumber.", ".$row_users->phonenumber2."</td>
<td><form method='post'><input type='hidden' name='roleno' value='".$row_users->rolenumber."'>"; if($count_pwdexpiry>0){echo $row_pwdexpiry->pswdexpiry; } echo "</td>
<td>
<select class='form-control' name='statusz'>";
if($row_users->status=="active"){echo "<option value='".$row_users->status."'>Active</option>";}
elseif($row_users->status=="0"){echo "<option value='".$row_users->status."'>Inactive</option>";}
echo "
<option value='active'>Active</option>
<option value='0'>Inactive</option>
</select>
</td>
<td><input type='submit' style='float:right;' name='inactive_users' class='btn btn-sm btn-primary' value='Submit'></form></td>
</tr>";
}while($row_users = $result_users->fetchObject());
}else{
echo "
<tr>
<td colspan='7' align='center'>Currently, there is NO users in this table. </td>
</tr>";}
?>
</tbody>
</table>
</div>
</div></div>
</div>
</div>

<?php lscript(); ?>
</body>

</html>
