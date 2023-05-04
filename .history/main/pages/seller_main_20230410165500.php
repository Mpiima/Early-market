<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php kheader(); ?>
</head>
<body class="">
<?php leftbar(); ?>

<!-- statistics========================= -->
<div class="row">
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-warning card-header-icon">
<div class="card-icon">
<i class="material-icons">products</i>
</div>
<p class="card-category">Expenses</p>
<h3 class="card-title">4,000

</h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons text-danger">warning</i>
<a href="#pablo">Get More Space...</a>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-success card-header-icon">
<div class="card-icon">
<i class="material-icons">store</i>
</div>
<p class="card-category">Active users</p>
<h3 class="card-title">5</h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons">date_range</i> Last 24 Hours
</div>
</div>
</div>
</div>

<div class="col-lg-4 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-info card-header-icon">
<div class="card-icon">
<i class="material-icons">store</i>
</div>
<p class="card-category">Candidates</p>
<h3 class="card-title">4</h3>
</div>
<div class="card-footer">
<div class="stats">
<i class="material-icons">update</i> Just Updated
</div>
</div>
</div>
</div>
</div>
<!-- <!========== !> -->



<div class="col-md-6">
<div class="card">
<div class="card-header card-header-success">
<h4 class="card-title">Update User Details</h4></div>
<div class="card-body">
<?php
if(isset($_POST["submit_user"])){
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$phone1=$_POST["phone1"];
$phone2=$_POST["phone2"];
$email=$_POST["email"];
$uname=$_POST["uname"];
$pword=$_POST["pword"];
$result_user=$dbh->query("select * from users where rolenumber='$rolenumber'");
$row_user=$result_user->fetchObject();
$count_user=$result_user->rowcount();
$result_keyfields=$dbh->query("select * from keyfields where rolenumber='$row_user->rolenumber'");
$row_keyfields=$result_keyfields->fetchObject();
if($count_user>0){ if($row_keyfields->username==$uname && $row_keyfields->password==$pword){
if(!empty($fname)&&!empty($lname)&&!empty($username)&&!empty($pword)){	
$update_users=$dbh->query("update users set firstname='$fname', lastname='$lname', phonenumber='$phone1', phonenumber2='$phone2', email='$email' where rolenumber='$rolenumber'");
if($update_users){echo "<div class='alert alert-success'>Success : User details have been updated successfully. </div>";}}
}else{echo "<div class='alert alert-danger'>Error : Username and password don't match </div>";} }
}
$result_user=$dbh->query("select * from users where rolenumber='$rolenumber'");
$row_user=$result_user->fetchObject();
$count_user=$result_user->rowCount();
?>
<form method="post">
<div class="row">
<div class='col-lg-4'>
<input type='text' class='form-control' name='fname' <?php if(!empty($row_user->firstname)){echo "value='".$row_user->firstname."'"; }else{echo "placeholder='Firstname'";} ?> required></div>
<div class='col-lg-4'>
<input type='text' class='form-control' name='lname' <?php if(!empty($row_user->lastname)){echo "value='".$row_user->lastname."'"; }else{echo "placeholder='Lastname'";} ?> required></div>
<div class='col-lg-4'>
<input type='number' class='form-control' name='phone1' <?php if(!empty($row_user->phonenumber)){echo "value='".$row_user->phonenumber."'"; }else{echo "placeholder='Phone 1'";} ?> required>
</div></div>
<div class='col-lg-12'><br></div>
 <div class="row">
<div class='col-lg-3'>
<input type='number' class='form-control' name='phone2' <?php if(!empty($row_user->phonenumber2)){echo "value='".$row_user->phonenumber2."'"; }else{echo "placeholder='Phone 2'";} ?> >
</div>
<div class='col-lg-3'>
<input type='email' class='form-control' name='email' <?php if(!empty($row_user->email)){echo "value='".$row_user->email."'"; }else{echo "placeholder='Email'";} ?> >
</div>
<div class='col-lg-3'>
<input type='text' class='form-control' name='uname' placeholder='Your User name' required></div>
<div class='col-lg-3'>
<input type='password' class='form-control' name='pword' placeholder='Your Password' required></div></div>
<div class='col-lg-12'><br></div>
<div class="row">
<div class='col-lg-12'>
<input type="submit" style='float:right;' class="btn btn-sm btn-primary form-control" name="submit_user" value="Submit Updates"></div></div>
<h5 class="card-title text-center text-primary">(Fill In Current Username & Password To Complete Action)</h5>
</form></div></div></div>
<div class="col-md-6">
<div class="card">
<div class="card-header card-header-success"><h4 class="card-title">Change Password</h4></div>
<div class="card-body">
<?php
$rolenumber=$_SESSION['rolenumber'];
if(isset($_POST['submit_pass'])){
$mypassword=$_POST['mypassword'];
if(!empty($mypassword)){
$update_keyfields=$dbh->query(" UPDATE  keyfields SET password='$mypassword' WHERE rolenumber='$rolenumber' order by autoid desc limit 1");
if($update_keyfields){echo "<div class='alert alert-success'>Success : Password updated successfully. </div>";}else{echo "<div class='alert alert-danger'>Error : Not Updated</div>"; }}} ?>
<form method='post'>
<div class='form-group'>
<input type='text' class='form-control' name='mypassword' placeholder='New Password' ></div>
<div class='form-group'>
<input type='submit' class='btn btn-sm btn-primary form-control' name='submit_pass' value='Submit'></div>
</form></div></div></div>

<?php lscript(); ?>
</body>

</html>
