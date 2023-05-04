<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>
</head>

<body class="">
<?php leftbar(); ?>


<form method='post' autocomplete="off">
<div class="col-lg-12">
<div class='row'>

<input type='text' list='userlist' name='usernames' class='form-control' placeholder='Enter username'>
<datalist id='userlist'>
<?php
include("connect.php");
$result_users = $dbh->prepare("select firstname, lastname, rolenumber from users where autoid>0 $goodusers order by autoid desc");
$result_users->execute();
$row_users = $result_users->fetchObject();
$count_users = $result_users->rowCount();
if($count_users>0){
do{
echo "<option value='".$row_users->firstname." ".$row_users->lastname."'>";
}while($row_users = $result_users->fetchObject());
}
?>
</datalist>
<input type='submit' name='submit_username' class='btn btn-sm btn-primary' value='Filter'>
</div>
</div>
</form>


<?php
if(isset($_POST["passwordexpiry"])){
$periodz=$_POST["periodz"];
$usernames=$_POST["usernames"];
if($usernames=="active" || $usernames=="Active"){$fstatus="active"; $output="status='$fstatus'"; $xname="";}
elseif($usernames=="inactive" || $usernames=="Inactive"){$fstatus="0"; $output="status='$fstatus'"; $xname="";}
else{
$fname=explode(" ",$usernames);
if(isset($fname)){$xname="firstname like '%$fname[0]%' and lastname like '%$fname[1]%'";}
else{$xname="";}
$output="";}


$result_users = $dbh->prepare("select * from users where $output $xname");
$result_users->execute();
$row_users = $result_users->fetchObject();
$count_users = $result_users->rowCount();

if($count_users>0){
do{
$rolenumber=$_POST["rolenumber".$row_users->autoid.""];

$result_passwordexpiry=$dbh->prepare("select * from keyfields where rolenumber='$rolenumber'");
$result_passwordexpiry->execute();
$count_passwordexpiry = $result_passwordexpiry->rowCount();

//checking in password expiry = true
if($count_passwordexpiry>0){
//update paswword expiry
if($periodz=="monthly"){
$datefrom=date("Y-m-d");
$dateto=date("Y-m-d", strtotime( $datefrom." +1 month" ));
}elseif($periodz=="weekly"){
$datefrom=date("Y-m-d");
$dateto=date("Y-m-d", strtotime( $datefrom." +1 week" ));
}

$update_pwdexpiry=$dbh->prepare("update keyfields set pswdexpiry='$dateto' where rolenumber='$rolenumber'");
$update_pwdexpiry->execute();
if($update_pwdexpiry){echo "<div class='alert alert-danger'>Account validity has been changed to 1 ".$periodz."</div>";}
}
//checking in password expiry = false
else{
//insert paswword expiry
if($periodz=="monthly"){
$datefrom=date("Y-m-d");
$dateto=date("Y-m-d", strtotime( $datefrom." +1 month" ));
}elseif($periodz=="weekly"){
$datefrom=date("Y-m-d");
$dateto=date("Y-m-d", strtotime( $datefrom." +1 week" ));
}

$insert_pwdexpiry=$dbh->prepare("insert into keyfields (rolenumber,password,pswdexpiry) values('$rolenumber','$row_users->password','$dateto')");
$insert_pwdexpiry->execute();

$insert_pwdhist=$dbh->prepare("insert into pwdhist (rolenumber,password,datefrom,dateto) values('$rolenumber','$row_users->password','$datefrom','$dateto')");
$insert_pwdhist->execute();
}
//insert paswword expiry
}while($row_users = $result_users->fetchObject());
}else{ echo "<div class='alert alert-danger>Error: Nothing has been submitted. </div>";} }

if(isset($_POST["submit_pwd"])){
$rolenumber=$_POST["rolenumber"];
$pwd=$_POST["pwd"];

$updatet=$dbh->query("update keyfields set password='$pwd' where rolenumber='$rolenumber'");
if($updatet){echo "<div class='col-lg-12'><div class='alert alert-success'>Success : Password has been updated successfully. </div></div>";}
}
?>
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-warning">
<h4 class="card-title ">Password expiry for selected users</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<form method='post'>
<table class="table">
<thead>
<tr>
<th>No</th>
<th>Names</th>
<th>Phone Nos</th>
<th>Email</th>
<th>Expires on</th>
<th>Username</th>
<th>Password</th>
<th>Action</th>
</tr></thead>
<tbody>
<?php
if(isset($_POST["submit_username"])){
echo "
<div class='col-lg-3'>
Period of expiry :
<select class='form-control' name='periodz'>
<option value='monthly'>Monthly</option>
<option value='weekly'>Weekly</option>
</select>
</div>
<div style='float:right;' class='col-lg-1'>
<input type='submit' style='float:right;' name='passwordexpiry' class='btn btn-sm btn-warning' value='Submit'>
</div>";
$usernames=$_POST["usernames"];
if($usernames=="active" || $usernames=="Active"){$fstatus="active"; $output="status='$fstatus'"; $xname="";}
elseif($usernames=="inactive" || $usernames=="Inactive"){$fstatus="0"; $output="status='$fstatus'"; $xname="";}
else{
$fname=explode(" ",$usernames);
if(isset($fname)){$xname="firstname like '%$fname[0]%' and lastname like '%$fname[1]%'";}
else{$xname="";}
$output="";}


$result_users = $dbh->prepare("select * from users where $output $xname");
$result_users->execute();
$row_users = $result_users->fetchObject();
$count_users = $result_users->rowCount();

if($count_users>0){
$x=1;
echo "<input type='hidden' name='usernames' value='".$usernames."'>";
do{
$result_keyfields = $dbh->prepare("select * from keyfields where rolenumber='$row_users->rolenumber'");
$result_keyfields->execute();
$row_keyfields = $result_keyfields->fetchObject();
$count_keyfields = $result_keyfields->rowCount();

echo "
<input type='hidden' name='rolenumber".$row_users->autoid."' value='".$row_users->rolenumber."'>
<tr>
<td>".$x++."</td>
<td>".$row_users->firstname." ".$row_users->lastname."</td>
<td>".$row_users->phonenumber.", ".$row_users->phonenumber2."</td>
<td>".$row_users->email."</td>
<td>"; if($count_keyfields>0){echo $row_keyfields->pswdexpiry; } echo "</td>
<td>"; if($count_keyfields>0){echo $row_keyfields->username; } echo "</td>
<form method='post'>
<input type='hidden' name='rolenumber' value='".$row_users->rolenumber."'>
<td><input type='text' class='form-control' name='pwd' value='"; if($count_keyfields>0){echo $row_keyfields->password; } echo "'></td>
<td><input type='submit' name='submit_pwd' class='btn btn-sm btn-primary' value='Update'></td>
</form>
</tr>";
}while($row_users = $result_users->fetchObject());
}else{
echo "
<tr>
<td colspan='20' align='center'>Currently, there is NO users in this table. </td>
</tr>";}
}else{
echo "
<tr>
<td colspan='20' align='center'>Search Firstname or Lastname, Active or Inactive Users  in the field above. </td>
</tr>";
}
?>
</tbody>
</table>
</div></div>

</div>


<?php lscript(); ?>
</body>

</html>
