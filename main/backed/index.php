<?php session_start(); ?>
<!DOCTYPE html>
<?php

function user_activity($activity,$rn,$stg,$myusername,$mypassword,$vcode){
  include("main/connect.php");
$ip_ad=$_SERVER['REMOTE_ADDR'];
if(isset($_SERVER['HTTP_REFERER'])){$previouspage=$_SERVER['HTTP_REFERER'];}
else{$previouspage='';}
$currentpage=$_SERVER['SCRIPT_NAME'];
$kbrowser=$_SERVER['HTTP_USER_AGENT'];
$insertactivity = $dbh->query("insert into accesscontrol (activity,browser,previouspage,deviceid,userid,currentpage,stage,username,password,vcode,status) values('$activity','$kbrowser','$previouspage','$ip_ad','$rn','$currentpage','$stg','$myusername','$mypassword','$vcode','$stat')");
}
?>
<html lang="en">
<head>
	<title>ACFIM</title>
	
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
<script src="https://hcaptcha.com/1/api.js" async defer></script>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/bg-01.jpg');overflow-y:hidden;">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
					

					 <?php include ("main/connect.php");
// hCAPTCHA API key configuration 
$secretKey = '0x67370AD8c001ACcf5bB401b80f3785144Bec1708'; 
 
// If the form is submitted 
$statusMsg = ''; 

 if(isset($_POST["login_user"])){
$mypassword=$_POST["mypassword"];
$myusername=$_POST["myusername"];

$result_scrappre=$dbh->query("select * from scrap where item='1' and type='preset2fa'");
$count_scrappre = $result_scrappre->rowCount();

if($count_scrappre==1){
$precode=$_POST["precode"]; 
$ourdate=date("Y-m-d");
$result_preset=$dbh->query("select * from preset2fa where ourcode='$precode' and ('$ourdate'>=startdate && '$ourdate'<=enddate)");
$row_preset = $result_preset->fetchObject();
$count_preset = $result_preset->rowCount();
}

        // Validate hCAPTCHA checkbox 
        if(!empty($_POST['h-captcha-response'])&&$_POST['h-captcha-response']!="hjkl"){ 
            // Verify API URL 
            $verifyURL = 'https://hcaptcha.com/siteverify'; 
             
            // Retrieve token from post data with key 'h-captcha-response' 
            $token = $_POST['h-captcha-response']; 
             
            // Build payload with secret key and token 
            $data = array( 
                'secret' => $secretKey, 
                'response' => $token 
                //'remoteip' => $_SERVER['REMOTE_ADDR'] 
            ); 
             
            // Initialize cURL request 
            // Make POST request with data payload to hCaptcha API endpoint 
            $curlConfig = array( 
                CURLOPT_URL => $verifyURL, 
                CURLOPT_POST => true, 
                CURLOPT_RETURNTRANSFER => true, 
                CURLOPT_POSTFIELDS => $data 
            ); 
            $ch = curl_init(); 
            curl_setopt_array($ch, $curlConfig); 
            $response = curl_exec($ch); 
            curl_close($ch); 
             
            // Parse JSON from response. Check for success or error codes 
            $responseData = json_decode($response); 
             
           }
            
            //Username, Password, hcaptcha,precode = True
        if(isset($mypassword)&& isset($myusername)&&!empty($_POST['h-captcha-response'])&&$_POST['h-captcha-response']!="hjkl"&&$responseData->success&&isset($_POST["precode"])){
if($count_preset==1&&$row_preset->ourcode==$precode){ $val="hJKgf386vtL"; $wd=' And Captcha'; $pr=' And Preset 2FA';}
else{echo "<div class='alert alert-danger msg'>Authenication failed.</div>";
$activity="Wrong Preset 2FA"; $rn=''; $stg=13;} }

            //Username, Password, hcaptcha = True But precode = false
        elseif(isset($mypassword)&& isset($myusername)&&!empty($_POST['h-captcha-response'])&&$_POST['h-captcha-response']!="hjkl"&&!isset($_POST["precode"])){
             
if($responseData->success){$val="hJKgf386vtL"; $wd=' And Captcha'; $pr='';}
else{$alert_msg=1; $activity="Wrong Captcha"; $rn=''; $stg=13;}}

        
        //Username, Password, precode = True But hcaptcha = false
        elseif(isset($mypassword)&& isset($myusername)&&$_POST['h-captcha-response']=="hjkl"&&isset($_POST["precode"])){
    
if($count_preset==1&&$row_preset->ourcode==$precode){ $val="hJKgf386vtL"; $wd=''; $pr=' And Preset 2FA';}
else{$alert_msg=1; $activity="Wrong Preset 2FA"; $rn=''; $stg=13;}    }

        //Username, Password = True But precode, hcaptcha = false
        elseif(isset($mypassword)&& isset($myusername)&&$_POST['h-captcha-response']=="hjkl"&&!isset($_POST["precode"])){$val="hJKgf386vtL"; $wd=''; $pr='';}

        else{$alert_msg=1; $activity="Wrong Password and Username OR Captcha OR Preset 2FA"; $rn=''; $stg=13;} 

//Alert Msg        
if($alert_msg==1){echo "<div class='alert alert-danger msg'>Authenication failed.</div>";}


            //Robot verification failed, please try again.
//echo "<p style='color:white;'>".$count_preset." ".$row_preset->ourcode."</p>";

if($val=="hJKgf386vtL"){ 
$status='1';
$currentdate=date("Y-m-d");
$result_users=$dbh->prepare("select * from keyfields where password=:passd and username=:usern and pswdexpiry>='$currentdate' and status=:stat  order by autoid desc limit 1");
$result_users->bindValue(':passd', $mypassword, PDO::PARAM_INT);
$result_users->bindValue(':usern', $myusername, PDO::PARAM_INT);
$result_users->bindValue(':stat', $status, PDO::PARAM_INT);
$result_users->execute();
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();

if($count_users==1){
    $result_use=$dbh->query("select * from users where rolenumber='$row_users->rolenumber' and autoid>0");
    $row_use=$result_use->fetchObject();
$_SESSION["rolenumber"]=$row_users->rolenumber;
$_SESSION["role"]=$row_use->role;
$_SESSION["firstname"]=$row_use->firstname;
$_SESSION["lastname"]=$row_use->lastname;
$_SESSION["ssid"] = $row_users->ssid;
$_SESSION["powers"] = $row_users->powers;
$activity="Correct password and username".$wd.$pr; $rn=$row_users->rolenumber; $stg=40;
echo "<div class='alert alert-success msg'>Login Successfully. Redirecting.</div>";
?>
<script>
var allowed=function(){window.location='main/';}
setTimeout(allowed,1000);
</script>
<?php
}else{echo "<div class='alert alert-danger msg'>Authenication failed. </div>";
$activity="Wrong password and username"; $rn=''; $stg=13;} } 
       
    user_activity($activity,$rn,$stg,$myusername,$mypassword,''); } 
    
    
if(isset($_POST["submit_phone"])){
$tel=$_POST["tel"];
 if(substr($tel,0,1)=="0"){$ftel=substr(str_replace(' ','',$tel),1);}
elseif(substr($tel,0,3)=="256"){$ftel=substr(str_replace(' ','',$tel),3);}
elseif(substr($tel,0,4)=="+256"){$ftel=substr(str_replace(' ','',$tel),4);}
else{$ftel=$tel;}

$result_users=$dbh->query("select * from users where phonenumber='$ftel'");
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();

if(is_numeric($ftel)==1&&strlen($ftel)==9){
if($count_users==1){
$code_time=date("Y-m-d h:i");

$scode=rand(0,1000);
if(strlen($scode)==3){$fcode="0".$scode;}
elseif(strlen($scode)==2){$fcode="00".$scode;}
elseif(strlen($scode)==1){$fcode="000".$scode;}


include("main/sender/verify.php");
 $yy=date("Y"); $fyy=substr($yy,2,2);
$mm=date("m"); $dd=date("d");
$hi=date("h"); $mi=date("i");
$sa=date("sa"); $fsa=substr($sa,0,2);
$ravenid="rv".$fyy.$mm.$dd.$hi.$mi.$fsa;
$ip_ad=$_SERVER['REMOTE_ADDR']; 
$insert_raven=$dbh->query("insert into ravens (ravenid,rolenumber,category,content,sender,receiver,stage) values('$ravenid','$ip_ad','sms','$content','ACFIM','$ftel','Davisbot 2FA Verification')");
              
echo "<div class='alert alert-success msg'>Davisbot 2FA Verification code has been set to 0".$ftel.". @ ".date("h:i")." </div>";

$activity="Verification Code sent to ".$ftel; $stg=12;$fc=$fcode;
?><script>
var chg=function(){$("#cd_box").slideDown(); $("#ph_box").slideUp();}
setTimeout(chg,100);
</script> <?php
}
else{echo "<div class='alert alert-danger msg'>Phone Number is NOT Registered. Please Contact System Admin at ACFIM </div>";
$activity="Phone Number is NOT Registered"; $stg=13;$fc='';}

}else{echo "<div class='alert alert-danger msg'>Incorrect Phone Number Format : (07...). </div>";
$activity="Incorrect Phone Number"; $stg=13; $fc='';}
user_activity($activity,'',$stg,'','',$fc);}


if(isset($_POST["submit_code"])){ 
    include("main/connect.php");
$vcode=$_POST["vcode"];
$ai=$_POST["ai"];
$fai=$ai-1;
$ip_ad=$_SERVER['REMOTE_ADDR']; 

$result_accessc=$dbh->query("select * from accesscontrol where deviceid='$ip_ad' and stage='13' and status='0' order by autoid desc");
$count_accessc = $result_accessc->rowCount();

if($count_accessc>0){
$update_access=$dbh->query("update accesscontrol set status='1' where deviceid='$ip_ad' and stage='13' and status='0'");
}
}
     
     $ip_ad=$_SERVER['REMOTE_ADDR'];
$result_access=$dbh->query("select * from accesscontrol where deviceid='$ip_ad' and stage='13' and status='0' order by autoid desc");
$row_access=$result_access->fetchObject();
$count_access = $result_access->rowCount();

if($count_access<2){
    
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
					";
$result_scrappre=$dbh->query("select * from scrap where item='1' and type='preset2fa'");
$count_scrappre = $result_scrappre->rowCount();

if($count_scrappre==1){
 echo "<div class='wrap-input100 validate-input' data-validate = 'Enter username'>
						<input class='input100' type='number' name='precode' placeholder='Week’s Security Code'>
						<span class='focus-input100' data-placeholder='&#xe82a;'></span>
					</div>";  
}
					  
$result=$dbh->query("select * from accesscontrol where deviceid='$ip_ad' and stage='40'");
$count = $result->rowCount();

    if($count<=0){
					echo "<center><div class='h-captcha' data-sitekey='65e27550-a834-443c-9798-b21af5048b3a'></div></center>";
				
    }else{echo "<input type='hidden' name='h-captcha-response' value='hjkl'>";}

					echo "<div class='container-login100-form-btn m-t-32'>
						<button class='login100-form-btn'  type='submit' name='login_user'>
							Sign In
						</button>
					</div>

				</form>";}
else{
    $ai=$row_access->autoid;
    $fai=$ai-1;
  
    $update_access=$dbh->query("update accesscontrol set status='0' where deviceid='$ip_ad' and stage='13' and status='1' and autoid='$ai'");
    
    $update_access=$dbh->query("update accesscontrol set status='0' where deviceid='$ip_ad' and stage='13' and status='1' and autoid='$fai'");
    
    
echo "<div id='ph_box'><form  method='post' class='login100-form' style='padding:10px 10px 10px 10px;'>
				
				
						<input class='form-control' type='tel' name='tel' placeholder='Phone No (Format : 07...)' required>
						
					
						<button class='btn btn-sm btn-primary'  type='submit' name='submit_phone'>
							Send
						</button>
				</form></div>
					
					<div id='cd_box' style='display:none;'><form class='login100-form' method='post' style='padding:10px 10px 10px 10px;'>
				<input type='hidden' name='ai' value='".$ai."'>
				
						<input class='form-control' type='number' name='vcode' placeholder='Enter Davisbot 2FA Code Here' required>
						
					
					
						<button class='btn btn-sm btn-primary'  type='submit' name='submit_code'>
							Send
						</button>
					</form></div>";}
		
		?>	
		
			</div>
		</div>
	</div>
	
<script>

var refreshButton = document.querySelector(".refresh-captcha");
refreshButton.onclick = function() {
  document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
}
</script>
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