<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>
<style>
.switch {
position: relative;
display: inline-block;
width: 60px;
height: 34px;
}

.switch input {display:none;}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: blue;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;
}

input:checked + .slider {
background-color: #2196F3;
}

input:focus + .slider {
box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
-webkit-transform: translateX(26px);
-ms-transform: translateX(26px);
transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
border-radius: 34px;
}

.slider.round:before {
border-radius: 50%;
}
</style>

</head>

<body class="">
<?php leftbar(); ?>

<?php


if(isset($_POST["delete_user"])){
$rn=$_POST["rn"];

$result_rn=$dbh->query("select * from users where rolenumber='$rn'");
$row_rn=$result_rn->fetchObject();
$result_ks=$dbh->query("select * from keyfields where rolenumber='$rn'");
$row_ks=$result_ks->fetchObject();
$insert_users=$dbh->query("insert into deletedusers (role,firstname,lastname,gender,phonenumber,phonenumber2,email,username,password,fulltitle,department,status,rolenumber,ssid) values('$row_rn->role','$row_rn->firstname','$row_rn->lastname','$row_rn->gender','$row_rn->phonenumber','$row_rn->phonenumber2','$row_rn->email','$row_ks->username','$row_ks->password','$row_rn->fulltitle','$row_rn->department','$row_rn->status','$row_rn->rolenumber','$row_rn->ssid')");

$tables=array('users','keyfields','pwdhist');
foreach ($tables as $del_tables) {$delete_tables=$dbh->query("delete from $del_tables where rolenumber='$rn'");}
}

if(isset($_POST["lockstatus"])){
$lockstatus=$_POST["lockstatus"];
if($lockstatus==1){$lockstatus=$_POST["lockstatus"]; $owner=""; $userstatus="active"; $listss=1;}
elseif($lockstatus==0){$lockstatus=0; $owner="and rolenumber!='$rolenumber'"; $userstatus="0"; $listss=0;}

$rolenumber=$_SESSION["rolenumber"];

$result_pwdexp=$dbh->prepare("select * from keyfields");
$result_pwdexp->execute();
$row_pwdexp=$result_pwdexp->fetchObject();
$count_pwdexp=$result_pwdexp->rowCount();

if($count_pwdexp>0){
do{
$update_pwdexp=$dbh->query("update keyfields set status='$lockstatus', lockuser='$rolenumber' where rolenumber!='$rolenumber'");

$update_users=$dbh->query("update users set status='$userstatus', listings='$listss' where rolenumber!='$rolenumber'");

}while($row_pwdexp=$result_pwdexp->fetchObject());

}
}

$rolenumber=$_SESSION["rolenumber"];
$result_pwdexp=$dbh->prepare("select * from keyfields where status='1' and rolenumber not like '$rolenumber'");
$result_pwdexp->execute();
$row_pwdexp=$result_pwdexp->fetchObject();
$count_pwdexp=$result_pwdexp->rowCount();

if($count_pwdexp>1){$color="green"; $status="ON";}else{$color="danger"; $status="OFF";}
?>
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-warning">
<h4 class="card-title ">Lock Entire System</h4>
</div>
<div class="card-body">
<div style='font-size:15.6px;' class='col-lg-8'>
Lock system<br>
<i>Warning: The switch on the right can lock or Unlock the entire system</i>
</div>
<form method='post'>
<?php
$rolenumber=$_SESSION["rolenumber"];
$result_pwdexp=$dbh->prepare("select * from keyfields where status='1' and rolenumber not like '$rolenumber'");
$result_pwdexp->execute();
$row_pwdexp=$result_pwdexp->fetchObject();
$count_pwdexp=$result_pwdexp->rowCount();

if($count_pwdexp>1){
echo "
<label style='float:right;' class='switch'>
<input type='checkbox' name='lockstatus' onchange='this.form.submit()' value='0'  >
<span style='background-color:green;' class='slider round'></span>
</label>
</form>";

}else{
echo "<label style='float:right;' class='switch'>
<input type='checkbox' name='lockstatus' onchange='this.form.submit()' value='1' >
<span style='background-color:red;' class='slider round'></span>
</label>";
}
?>


</div>
</div>
</div>

<div class="col-md-12">
<div class="card">
<div class="card-header card-header-primary">
<h4 class="card-title ">Lock Out a User</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>No</th>
<th>Names</th>
<th>Phone Nos</th>
<th>Email</th>
<th>Expires on</th>
<td colspan='2' align='center'><b>Action</b></td>
</tr></thead>
<tbody>
<?php
//updating user lock status
if(isset($_POST["userlock"])){
$userlock=$_POST["userlock"];
$userid=$_POST["userid"];
if($userlock==1){$userlock=$_POST["userlock"]; $userst="active";$lists=1;}
elseif($userlock==0){$userlock=0; $userst=0;$lists=0;}

$update_pwdexp=$dbh->query("update keyfields set status='$userlock', lockuser='$rolenumber' where rolenumber='$userid'");
$update_users=$dbh->query("update users set status='$userst', listings='$lists' where rolenumber='$userid'");
}

//updating user lock status
$result_pwdexp=$dbh->prepare("select * from keyfields where rolenumber!='$rolenumber' and rolenumber not like 'tech'");
$result_pwdexp->execute();
$row_pwdexp=$result_pwdexp->fetchObject();
$count_pwdexp=$result_pwdexp->rowCount();

if($count_pwdexp>0){
$x=1;
do{


$result_users=$dbh->prepare("select * from users where rolenumber='$row_pwdexp->rolenumber'");
$result_users->execute();
$row_users=$result_users->fetchObject();
$count_pwdexp=$result_users->rowCount();
echo "
<tr>
<td>".$x++."</td>
<td>"; if($count_pwdexp>0){echo $row_users->firstname." ".$row_users->lastname; } echo "</td>
<td>"; if($count_pwdexp>0){echo $row_users->phonenumber.", ".$row_users->phonenumber2; } echo "</td>
<td>"; if($count_pwdexp>0){echo $row_users->email; } echo "</td>
<td>".$row_pwdexp->pswdexpiry."</td>
<td>
<form method='post'>
<input type='hidden' name='userid' value='".$row_pwdexp->rolenumber."'>"; 
if($row_pwdexp->status==1){
echo "
<label style='float:right;' class='switch'>
<input type='checkbox' name='userlock' onchange='this.form.submit()' value='0'  >
<span style='background-color:red;' class='slider round'></span>
</label>";

}elseif($row_pwdexp->status==0){
echo "
<label style='float:right;' class='switch'>
<input type='checkbox' name='userlock' onchange='this.form.submit()' value='1'  >
<span style='background-color:green;' class='slider round'></span>
</label>";
}
echo "
</form></td>"; ?>

<td><form method='post' onsubmit="return delete_checker('<?php if($count_pwdexp>0){echo $row_users->firstname." ".$row_users->lastname; } ?>','deleted from');">
<input type='hidden' name='rn' value='<?php echo $row_pwdexp->rolenumber; ?>'>
<input type='submit' name='delete_user' class='btn btn-sm btn-danger' value='Delete'>

<?php echo "</form>
</td>
</tr>";
}while($row_pwdexp=$result_pwdexp->fetchObject());
}else{
echo "
<tr>
<td colspan='7' align='center'>Please contact the developers. </td>
</tr> ";
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php
if(isset($_POST["restore_user"])){
$rn=$_POST["rn"];

$result_rn=$dbh->query("select * from deletedusers where rolenumber='$rn'");
$row_rn=$result_rn->fetchObject();

$insert_users=$dbh->query("insert into users (role,firstname,lastname,gender,phonenumber,phonenumber2,email,fulltitle,department,status,rolenumber,ssid) values('$row_rn->role','$row_rn->firstname','$row_rn->lastname','$row_rn->gender','$row_rn->phonenumber','$row_rn->phonenumber2','$row_rn->email','$row_rn->fulltitle','$row_rn->department','$row_rn->status','$row_rn->rolenumber','$row_rn->ssid')");

$datefrom=date("Y-m-d");
$dateto=date("Y-m-d", strtotime( $datefrom." +1 month" ));

$insert_pwdexpiry=$dbh->query("insert into keyfields (rolenumber,username,password,status,pswdexpiry) values('$row_rn->rolenumber','$row_rn->username','$row_rn->password','1','$dateto')");

$tables=array('deletedusers');
foreach ($tables as $del_tables) {$delete_tables=$dbh->query("delete from $del_tables where rolenumber='$rn'");}

}
?>
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-danger">
<h4 class="card-title ">Deleted Users</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table">
<table class='table'>
<thead>
<tr>
<th>No</th>
<th>Names</th>
<th>Phone Nos</th>
<th>Email</th>
<th>Title & Department</th>
<th>Action</th>
</tr></thead>
<?php
$result_deleteuser = $dbh->query("select * from deletedusers order by autoid desc");
$row_deleteuser = $result_deleteuser->fetchObject();
$count_deleteuser = $result_deleteuser->rowCount();

if($count_deleteuser>0){
$r=1;
do{

echo "<tr>
<td>".$r++."</td>
<td>".$row_deleteuser->firstname." ".$row_deleteuser->lastname."<br>
<span style='color:red;'><i>Deleted On : ".$row_deleteuser->datecreated."</i></span></td>
<td>".$row_deleteuser->phonenumber.", ".$row_deleteuser->phonenumber2."</td>
<td>".$row_deleteuser->email."</td>
<td>".$row_deleteuser->fulltitle."<br>".$row_deleteuser->department."</td>
<td>"; ?>
<form method='post' onsubmit="return delete_checker('<?php echo $row_deleteuser->firstname." ".$row_deleteuser->lastname; ?>','restored back in');">
<input type='hidden' name='rn' value='<?php echo $row_deleteuser->rolenumber; ?>'>
<input type='submit' name='restore_user' class='btn btn-sm btn-warning' value='Restore'>
</form>

<?php echo "</td></tr>";
}while($row_deleteuser = $result_deleteuser->fetchObject());
}else{echo "<tr><td colspan='10' align='center'>There are no users deleted here , so far. </td></tr>";}
?>
</table>
</div></div>
</div> 

<script>
function delete_checker(names, act){
var confirmer=confirm("User : "+names+" will be "+act+" the system; Are u sure.? ");
if(confirmer==false){return false;} }
</script>





<?php lscript(); ?>
</body>

</html>
