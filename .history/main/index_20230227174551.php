<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>EARLY-MARKET</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="login/css/util.css">
<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
<style>
.msg{text-align:center;text-transform:capitalize;font-size:18px;}
</style>
</head>
<!-- <script src="https://hcaptcha.com/1/api.js" async defer></script> -->
<body>
<div class="limiter">
<div class="container-login100" style="background-image: url('login/images/bg-01.jpg');overflow-y:hidden;">
<div class="wrap-login100 p-t-30 p-b-50">
<span class="login100-form-title p-b-41">
Account Login

<?php
if(isset($_POST["login_user"])){
include("pages/connect.php");
$mypassword=$_POST["mypassword"];
$myusername=$_POST["myusername"];
$status='1';
$currentdate=date("Y-m-d");
$result_users=$dbh->prepare("select * from keyfields where password='$mypassword' and username='$myusername' and pswdexpiry>='$currentdate' and status='$status'  order by autoid desc limit 1");
$result_users->bindValue(':passd', $mypassword, PDO::PARAM_INT);
$result_users->bindValue(':usern', $myusername, PDO::PARAM_INT);
$result_users->bindValue(':stat', $status, PDO::PARAM_INT);
$result_users->execute();
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();


if($count_users>0){
$result_use=$dbh->query("select * from users where rolenumber='$row_users->rolenumber' and autoid>0");
$row_use=$result_use->fetchObject();
$_SESSION["rolenumber"]=$row_users->rolenumber;
$_SESSION["role"]=$row_use->role;
$_SESSION["firstname"]=$row_use->firstname;
$_SESSION["lastname"]=$row_use->lastname;


echo "<div class='alert alert-success' style='text-align:center'>Login Successfully. Redirecting.</div>";
?>
<script>
var allowed=function(){window.location='pages/';}
setTimeout(allowed,1000);
</script>
<?php
}else{echo "<div class='alert alert-danger' style='text-align:center'>Authenication failed. </div>";}
}
echo "</span> 
<form class='login100-form validate-form p-b-33 p-t-5' method='post'>";
echo "<input type='hidden' name='wasgoinghere' value=''>
<div class='wrap-input100 validate-input' data-validate = 'Enter username'>
<input class='input100' type='text' name='myusername' placeholder='User name'>
<span class='focus-input100' data-placeholder='&#xe82a;'></span>
</div>
<div class='wrap-input100 validate-input' data-validate='Enter password'>
<input class='input100' type='password' name='mypassword'  placeholder='Password'>
<span class='focus-input100' data-placeholder='&#xe80f;'></span>
</div>
<div class='container-login100-form-btn m-t-32'>
<button class='login100-form-btn'  type='submit' name='login_user'>
Sign In
</button>
</div>
</form>";
?>	
</div>
</div>
</div>


<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/bootstrap/js/popper.js"></script>
<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/daterangepicker/moment.min.js"></script>
<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="login/js/main.js"></script>

</body>
</html>