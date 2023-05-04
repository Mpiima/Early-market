<?php 
include("../connect.php");
$goodreceivers="and email!=''";
$url="https://acfim.eastafrica.website";

$startdate = date('Y-m-d', strtotime("Monday last week"));
$enddate = date('Y-m-d', strtotime("Sunday last week"));

  $day_s = date("l", strtotime($startdate));
$timestamp_s = strtotime($startdate);
$dateout_s = date('d F Y', $timestamp_s);

$day_e = date("l", strtotime($enddate));
$timestamp_e = strtotime($enddate);
$dateout_e = date('d F Y', $timestamp_e);

$period="and (autodate>='$startdate 00:00:00' && autodate<='$enddate 23:59:59')";
$periods="and (incidentdate>='$startdate' && incidentdate<='$enddate')";

include("../calculate.php");
date_default_timezone_set('Africa/Kampala');

$resultmail=$dbh->query ("select * from users where (role='tech' or role='ss' or role='md') $goodreceivers");
$rowmail=$resultmail->fetchObject();
$countmail=$resultmail->rowCount();

if($countmail>0){do{
$rolenumber=$rowmail->rolenumber;
$to=$rowmail->email;

$receiver=$rowmail->firstname;
$receivername2=$rowmail->lastname;



$subject="ACFIM App Usage Report";
$heading="ACFIM App Usage Report";
$greeting="<h2>Hi ".$receiver.",</h2>";
$buttonwords="Track Progress";
$body="<center>Report showing number of Logins, Submitted & Processed Data per User <br><b>From ".$day_s.", ".$dateout_s." To ".$day_e.", ".$dateout_e."</b></center>";


$body.= "
<table border='1' style='border-collapse: collapse; width: 100%;' >
 <thead>
<tr>
<td><b>No</b></td>
<td><b>User</b></td>
<th>Logged In</th>
<th>Approved/ Entered data </th>
</tr></thead>";



$result_users=$dbh->query("select distinct(role) from users where (role='Monitor' or role='ss')");
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();

if($count_users>0){ $y=1; do{
$result_accesscontrol=$dbh->query("select distinct(userid) from accesscontrol where userid like '%$row_users->role%' $period");
$count_accesscontrol=$result_accesscontrol->rowCount();

$result_usersss=$dbh->query("select * from users where role='$row_users->role'");
$count_usersss=$result_usersss->rowCount();

$result_scrap=$dbh->query("select * from scrap where item2='$row_users->role' and type='role'");
$row_scrap=$result_scrap->fetchObject();

$result_smalltransactA=$dbh->query("select * from smalltransact where ouruser like '%$row_users->role%' and status='2' and rtype='B' $periods ");
$count_smalltransactA=$result_smalltransactA->rowCount();

$result_smalltransactS=$dbh->query("select * from smalltransact where ouruser like '%$row_users->role%' and status='0' and rtype='B' $periods");
$count_smalltransactS=$result_smalltransactS->rowCount();

$body.="<tr>
<td>".$y++.". </td>
<td>".$row_scrap->item."</td>
<td align='center'>".$count_accesscontrol." / ".$count_usersss."</td>
<td align='center'>".$count_smalltransactA." / ".$count_smalltransactS."</td>
</tr>";
}while($row_users=$result_users->fetchObject());}
else{$body.="<tr><td align='center' colspan='10'>There is no data here as yet. </td></tr>";}

$body.="</table><br>";

$body.= "<b>Monitors</b>
<table border='1' style='border-collapse: collapse; width: 100%;' >
 <thead>
<tr>
<td><b>No</b></td>
<td><b>User</b></td>
<th>Logins</th>
<th>Submitted</th>
<th>Position</th>
</tr></thead>";



$result_usagescore=$dbh->query("select distinct(ouruser),ovposition from usagescore where ovposition>0 and ouruser like '%Monitor%' order by ovposition asc");
$row_usagescore=$result_usagescore->fetchObject();
$count_usagescore=$result_usagescore->rowCount();

if($count_usagescore>0){ $y=1; do{

$result_users=$dbh->query("select * from users where rolenumber='$row_usagescore->ouruser'");
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();

$body.="<tr>
<td>".$y++.". </td>
<td>"; if($count_users>0){ $body.="<span style='text-transform:lowercase;'>@".$row_users->username."</span>"; } $body.="</td>";

$aspects=array("logins","submitted");
foreach($aspects as $aspect){
$result_us=$dbh->query("select * from usagescore where ouruser='$row_usagescore->ouruser' and aspect='$aspect'");
$row_us=$result_us->fetchObject();
$count_us=$result_us->rowCount();

if($count_us>0){$val=$row_us->aspscore;}
else{$val=0;}
$body.="<td align='center'>".$val."</td>";
}

$result_ust=$dbh->query("select * from usagescore where ouruser='$row_usagescore->ouruser' and aspect='logins'");
$row_ust=$result_ust->fetchObject();
$count_ust=$result_ust->rowCount();

$body.="
<td style='color:green;' align='center'>"; if($count_ust>0){$body.=$row_ust->ovposition;} $body.="</td>
</tr>";
}while($row_usagescore=$result_usagescore->fetchObject());}
else{$body.="<tr><td align='center' colspan='10'>There is no data here as yet. </td></tr>";}

$body.="</table><br>";


$body.= "<b>Supervisors</b>
<table border='1' style='border-collapse: collapse; width: 100%;' >
 <thead>
<tr>
<td><b>No</b></td>
<td><b>User</b></td>
<th>Logins</th>
<th>Processed</th>
<th>Position</th>
</tr></thead>";



$result_usagescore=$dbh->query("select distinct(ouruser),ovposition from usagescore where ovposition>0 and ouruser like '%ss%' order by ovposition asc");
$row_usagescore=$result_usagescore->fetchObject();
$count_usagescore=$result_usagescore->rowCount();

if($count_usagescore>0){ $y=1; do{

$result_users=$dbh->query("select * from users where rolenumber='$row_usagescore->ouruser'");
$row_users=$result_users->fetchObject();
$count_users=$result_users->rowCount();

$body.="<tr>
<td>".$y++.". </td>
<td>"; if($count_users>0){ $body.="<span style='text-transform:lowercase;'>@".$row_users->username."</span>"; } $body.="</td>";

$aspects=array("logins","processed");
foreach($aspects as $aspect){
$result_us=$dbh->query("select * from usagescore where ouruser='$row_usagescore->ouruser' and aspect='$aspect'");
$row_us=$result_us->fetchObject();
$count_us=$result_us->rowCount();

$result_smalltransactA=$dbh->query("select * from smalltransact where status='0' and rtype='B' $periods ");
$count_smalltransactA=$result_smalltransactA->rowCount();

if($count_us>0){$val=$row_us->aspscore;}
else{$val=0;}
$body.="<td align='center'>"; if($aspect=="processed"){$body.=$val." / ".$count_smalltransactA;}else{$body.=$val;} $body.="</td>";
}

$result_ust=$dbh->query("select * from usagescore where ouruser='$row_usagescore->ouruser' and aspect='logins'");
$row_ust=$result_ust->fetchObject();
$count_ust=$result_ust->rowCount();

$body.="
<td style='color:green;' align='center'>"; if($count_ust>0){$body.=$row_ust->ovposition;} $body.="</td>
</tr>";
}while($row_usagescore=$result_usagescore->fetchObject());}
else{$body.="<tr><td align='center' colspan='10'>There is no data here as yet. </td></tr>";}

$body.="</table><em></b><center>

<br><a href='".$url."'><img class='mb-4' src='../img/acfim.jpg' alt='' style='margin-top:5%;width:70%;'>
</a>


<p>Tower, 1st Floor, Plot, Interservice, 33 Lumumba Ave, Kampala";

$footer="<span style='font-size:13px;'>This email is meant for ".$receiver." ".$receivername2."
<p style='color:#242582'>Sent by <a href='http://ncu.eastafrica.website' style='color:#242582'>ACFIM Management Software</a></p>
<p style='color:#242582'>+256703611691 | <a href='mailto:' style='color:#242582'>info@Kinglinepress.com</a> | <a href='http://Kinglinepress.com' style='color:#242582'>www.kinglinepress.com</a><br></p>

";

$body="<html xmlns='http://www.w3.org/1999/xhtml'>
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

.container .masthead { padding: 40px 0; background: #242582; color: white; }

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

            <!-- body start -->
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

            <!-- body start -->
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
$message=$body;
echo $body;

if ($send=='1'){
    mailtrigger();}


}
while($rowmail = $resultmail->fetchObject());}
?>