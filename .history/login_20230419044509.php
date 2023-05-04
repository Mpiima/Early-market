<!DOCTYPE html>
<html lang="en">
<?php include 'include/header.php'; ?>
<body>

<!-- LOADER -->
<div class="preloader">
<div class="lds-ellipsis">
<span></span>
<span></span>
<span></span>
</div>
</div>
<!-- END LOADER -->

<?php //include 'include/popup.php'; ?>
<?php include 'include/header_wrap.php'; ?>

<hr/>
<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START LOGIN SECTION -->
<div class="login_register_wrap section">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-6 col-md-10">
<div class="login_wrap">
<div class="padding_eight_all bg-white">
<div class="heading_s1">
<h3>Login</h3>
</div>
<?php
session_start();
if(isset($_POST["login_user"])){
include("main/pages/connect.php");
$mypassword=$_POST["mypassword"];
$myusername=$_POST["myusername"];
$status='1';
$currentdate=date("Y-m-d");
$result_users=$dbh->prepare("select * from keyfields where password=:passd and username=:usern and pswdexpiry>='$currentdate' and status=:stat  order by autoid desc limit 1");
$result_users->bindParam(':passd', $mypassword);
$result_users->bindParam(':usern', $myusername);
$result_users->bindParam(':stat', $status);
$result_users->execute();
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();

if($count_users>0){
$result_use=$dbh->query("select * from users where rolenumber='$row_users->rolenumber' and autoid>0");
$row_use=$result_use->fetchObject();
$_SESSION["username"] = $row_users->username;
$_SESSION["firstname"]= $row_use->firstname;
$_SESSION["lastname"]= $row_use->lastname;
$_SESSION["role"] = $row_use->role;
$_SESSION["rolenumber"] = $row_users->rolenumber;
// $_SESSION["db_name"] = $row_use->db_name;

echo "<div class='alert alert-success' style='text-align:center'>Access Granted.</div>";
?>
<script>
var allowed=function(){window.location='main/pages/';}
setTimeout(allowed,1000);
</script>
<?php
}else{echo "<div class='alert alert-danger' style='text-align:center'>Authenication failed. </div>";}
}
?>

<form method="post">

<div class="form-group mb-3">
<input type="email" required="true" class="form-control" name="myusername" placeholder="Enter Your Email">
</div>
<div class="form-group mb-3">
<input class="form-control" required="true" type="password" name="mypassword" placeholder="Password">
</div>


<div class="form-group mb-3">
<button type="submit" class="btn btn-fill-out btn-block" name="login_user">Login</button>
</div>
</form>

<div class="form-note text-center">Don't have an account? <a href="register">Register</a></div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- END LOGIN SECTION -->

<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_default small_pt small_pb">
<div class="container">	
<div class="row align-items-center">	
<div class="col-md-6">
<div class="heading_s1 mb-md-0 heading_light">
<h3>Subscribe Our Newsletter</h3>
</div>
</div>
<div class="col-md-6">
<div class="newsletter_form">
<form>
<input type="text" required="" class="form-control rounded-0" placeholder="Enter Email Address">
<button type="submit" class="btn btn-dark rounded-0" name="submit" value="Submit">Subscribe</button>
</form>
</div>
</div>
</div>
</div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->

</div>
<!-- END MAIN CONTENT -->


<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 
<!-- START FOOTER -->
<?php include 'include/footer.php'; ?>
<!-- END FOOTER -->
<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 
<?php include 'include/script.php'; ?>


</body>
</html>