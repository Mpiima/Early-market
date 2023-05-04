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
<div class="card-header card-header-success">
<h4 class="card-title">Add A User</h4>
</div>
<div class="card-body">
<?php
if(isset($_POST["submit_user"])){
$fname=strtoupper($_POST["fname"]);
$constituency=$_POST["constituency"];
$lname=strtoupper($_POST["lname"]);
$gender=$_POST["gender"];
$tel=$_POST["phone1"];
$tel2=$_POST["phone2"];
$email=$_POST["email"];
$title=$_POST["title"];
$department=$_POST["department"];

if(substr($tel,0,1)=="0"){$ftel=substr(str_replace(' ','',$tel),1);}
elseif(substr($tel,0,3)=="256"){$ftel=substr(str_replace(' ','',$tel),3);}
elseif(substr($tel,0,4)=="+256"){$ftel=substr(str_replace(' ','',$tel),4);}
else{$ftel=$tel;}

if(substr($tel2,0,1)=="0"){$ftel2=substr(str_replace(' ','',$tel2),1);}
elseif(substr($tel2,0,3)=="256"){$ftel2=substr(str_replace(' ','',$tel2),3);}
elseif(substr($tel2,0,4)=="+256"){$ftel2=substr(str_replace(' ','',$tel2),4);}
else{$ftel2=$tel2;}

$datefrom=date("Y-m-d");
$dateto=date("Y-m-d", strtotime( $datefrom." +2 month" ));

$result_user=$dbh->prepare("select * from scrap where item2='$title'");
$result_user->execute();
$row_user=$result_user->fetchObject();
$count_user=$result_user->rowCount();

$result_user2=$dbh->prepare("select * from users order by autoid desc");
$result_user2->execute();
$row_user2=$result_user2->fetchObject();

$theno=$row_user2->autoid+1;
$rolenumber=$title.$theno;

if(strlen($ftel)==9&&is_numeric($ftel)==1){
$result_users=$dbh->query("select * from users where phonenumber='$ftel'");
$count_users=$result_users->rowCount();

if($count_users<=0){

$result_scrapl=$dbh->query("select * from scrap where type='timelimit'");
$row_scrapl=$result_scrapl->fetchObject();

$datefrom=date("Y-m-d");
$dateto=date("Y-m-d", strtotime( $datefrom." +".$row_scrapl->item2."" ));

$ourusername=strtolower(substr($fname,0,1).$lname);

$insert_users=$dbh->query("insert into users (role,firstname,lastname,gender,phonenumber,phonenumber2,email,fulltitle,department,status,rolenumber,constituency) values('$title','$fname','$lname','$gender','$ftel','$ftel2','$email','$row_user->item','$department','active','$rolenumber','$constituency')");

$insert_keyfields=$dbh->query("insert into keyfields (rolenumber,username,password,status,pswdexpiry) values('$rolenumber','$ourusername','$ftel','0','$dateto')");

$activation_link="https://early-market.com/activate_account.php?rn=".$rolenumber;
$send=1;
$altselector="newuser";
include('mailer/mailshooter.php'); 
if($insert_users&&$insert_keyfields){echo "<div class='alert alert-success'>Success : Data has been submitted. </div>";}
}else{echo "<div class='alert alert-danger'>Error : Account Already Exists. </div>";}
}else{echo "<div class='alert alert-danger'>Error : Wrong Phone number. </div>";}

}
?>
<form method="post">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<input type='text' class='form-control' name='fname' placeholder='Firstname' required>
</div></div>

<div class="col-md-4">
<div class="form-group">
<input type='text' class='form-control' name='lname' placeholder='Lastname' required>
</div></div>

<div class='col-md-4'>
<div class="form-group">
<select class='form-control' name='gender'>
<option value=''>Gender</option>
<option value='Male'>Male</option>
<option value='Female'>Female</option>
</select>
</div></div>
</div>

<div class="row">
<div class='col-md-4'>
<div class="form-group">
<input type='text' class='form-control' name='phone1' placeholder='Phone 1 (07...)' required>
</div></div>

<div class='col-md-4'>
<div class="form-group">
<input type='text' class='form-control' name='phone2' placeholder='Phone 2 (07...)' >
</div></div>

<div class='col-md-4'>
<div class="form-group">
<input type='text' class='form-control' name='email' placeholder='Email'>
</div></div>
</div>

<div class="row">
<div class='col-md-4'>
<div class="form-group">
<select class="form-control" name="title" required>
<option value="">Full title</option>
<?php
include("connect.php");
$result_user=$dbh->query("select * from scrap where type='role' and item2!='tech'");
$row_user=$result_user->fetchObject();
$count_user=$result_user->rowcount();

if($count_user>0){
do{
echo "<option value='".$row_user->item2."'>".$row_user->item."</option>";
}while($row_user=$result_user->fetchObject());
}else{
echo "<option value=''>Please contact your IT department.</option>";
}
?>
</select>
</div></div>

<div class='col-md-4'>
<div class="form-group">
<input type='text' class='form-control' name='department' placeholder='Department'>
</div></div>
<div class='col-md-4'>
<div class="form-group">
<select class="form-control" name="constituency" required>
<option value="">Address</option>
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
</div></div>

</div>

<div class="row">

<div class='col-md-4'>
<div class="form-group">
<input type="submit" class="btn btn-sm btn-primary" name="submit_user" value="Submit user">
</div></div>
</div>
</form>
</div> 
</div>
</div>

<!--the body-->

<div class="col-md-12">
<div class="card">
<div class="card-header card-header-warning">
<h4 class="card-title">Create New User Category</h4>
</div>
<div class="card-body">
<?php
if(isset($_POST["submit_role"])){
$title=$_POST["title"];
$role=$_POST["role"];
$insert_scrap=$dbh->prepare("insert into scrap (item,item2,type) values('$title','$role','role')");
$insert_scrap->execute();
if($insert_scrap){echo "<div class='alert alert-success'>Success: Category Added</div>";}
}
?>
<form method="post">
<div class="row">
<div class='col-md-4'>
<div class="form-group">
<input type='text' class='form-control' name='title' placeholder='Title' required>
</div></div>

<div class='col-md-4'>
<div class="form-group">
<input type='text' class='form-control' name='role' placeholder='Role Summary' required>
</div></div>

<div class='col-md-4'>
<div class="form-group">
<input type="submit" class="btn btn-sm btn-primary" name="submit_role" value="Submit Role">
</div></div>
</div>

</form>
</div>
</div>
</div>

<script>
function sender(){
var selectedusers = document.getElementById("selectedusers");
var values = [];

<?php
$result_users=$dbh->query("select * from users where role='ss' or role='ltech' order by firstname asc");
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();
if($count_users>0){
do{
?>
if(document.getElementById("chkout<?php echo $row_users->autoid; ?>").checked==true) {
var user = document.getElementById("chkout<?php echo $row_users->autoid; ?>").value;
values.push(user);
}
<?php
}while($row_users=$result_users->fetchObject());
}
?>

selectedusers.value = values.join(",");

}
</script> 
<?php lscript(); ?>
</body>

</html>
