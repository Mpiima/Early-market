<?php 
include("connect.php");
$goodreceivers="and email!=''";

$result_users=$dbh->query("select * from users where rolenumber='$rolenumber'");
$row_users=$result_users->fetchObject();

do{
$to=$row_users->email;
$receiver=$row_users->firstname;
$receivername2=$row_users->lastname;
$url=$activation_link;


$subject="EARLY MARKET ACCOUNT ACTIVATION";
$heading="EARLY MARKET";
$greeting="<h2>Hi ".$receiver.",</h2>";
//$buttonwords="Track Progress";


$body.= "<table width='100%' style='font-size:15px;'>
<tr><td><b>Account Activation:</b></td></tr>
<tr><td colspan='3'><p>
Successfully registered for Early Market Services<b style='color:maroon'>Please Click the link below to activate your account</b> <a href='".$activation_link."' style=' display: inline-block; color: white; background: #242582; border: solid #242582; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; width:90%;' >Click To Activate</a></td></tr>
";

$body.= "</table>
<p></p><p> Thank you for Using Early Market<br> Click to visit EARLY MARKET : <a href='https://early-market.com' style='font-size:16px;'>Early Market Platform</a>";

$footer="<span style='font-size:13px;'>This email is meant for ".$receiver." ".$receivername2."
<p style='color:#242582'>Sent by <a href='https://early-market.com' style='color:#242582'>Early Market Management System</a></p>
<p style='color:#242582'>+256-780958321 | <a href='mailto:' style='color:#242582'>info@early-market.com</a> | <a href='https://early-market.com' style='color:#242582'>www.early-market.com</a><br></p>
<b width='100%' style='font-size:15px;'>Disclaimer: This is an auto-generated mail. Please do not reply to it.</b>

";

$message="<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width'/>

    <!-- For development, pass document through inliner -->

    <style type='text/css'>
* { margin: 0; padding: 0; font-size: 100%; font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height: 1.65; }

img { max-width: 100%; margin: 0 auto; display: block; }

body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; }

a { color: #71bc37; text-decoration: none; }

a:hover { text-decoration: underline; }

.text-center { text-align: center; }

.text-right { text-align: right; }

.text-left { text-align: left; }

.button { display: inline-block; color: white; background: #242582; border: solid #242582; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; width:90%; }

.button:hover { text-decoration: none; }

h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }

h1 { font-size: 32px; }

h2 { font-size: 28px; }

h3 { font-size: 24px; }

h4 { font-size: 20px; }

h5 { font-size: 16px; }

p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }

.container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important; border: solid 1px #242582;}

.container table { width: 100% !important; border-collapse: collapse; }

.container .masthead { padding: 40px 0; background: #32CD32; color: white; }

.container .masthead h1 { margin: 0 auto !important; max-width: 90%;  }

.container .content { background: white; padding: 30px 35px; }

.container .content.footer { background: none; border:none !important; }

.container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; border:none !important;}

.container .content.footer a { color: #888; text-decoration: n one; font-weight: bold; border:none !important;}

.container .content.footer a:hover { text-decoration: underline; border:none !important;}

    

    </style>
</head>
<body>
<table class='body-wrap'>
    <tr>
        <td class='container'>

            <!-- Message start -->
            <table>
                <tr>
                    <td align='center' class='masthead'>

                        <h1>".$heading."</h1>

                    </td>
                </tr>
                <tr>
                    <td class='content'>

                        

                      ".$greeting.$body."

                      

        </td>
    </tr>
    <tr>
        <td class='container' style='border-left:none !important; 'border-right:none !important;'>

            <!-- Message start -->
            <table style='border:none !important;'>
                <tr style='border:none !important;'>
                    <td class='content footer' align='center' style='border:none !important;'>
                        ".$footer."
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>";
//echo $message;

if($send==1){mailtrigger();}

}while($row_users=$result_users->fetchObject());
?>