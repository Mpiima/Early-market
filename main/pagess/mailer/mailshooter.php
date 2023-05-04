<?php
date_default_timezone_set('Africa/Kampala');


if (isset($_GET['selector'])){$selector=$_GET['selector'];} 
elseif (isset($_POST['selector'])){$selector=$_POST['selector'];} 
elseif (isset($altselector)){$selector=$altselector; $send=1;}
else {$selector= ""; echo "No Selector";}

//if (isset($_GET['send'])){$send="1";} else {$send=""; /*echo "No send";*/}


function mailtrigger()
{
include("connect.php");

global $to;
global $subject;
global $message;
$headers = 'From: info@zinitechnology.com' . "\r\n" .
'Reply-To: info@zinitechnology.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= 'Cc: kazibwedavis6@gmail.com' . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($to, $subject, $message, $headers);
}

if ($selector=="newuser"){ include("activate_account.php"); }

?>   