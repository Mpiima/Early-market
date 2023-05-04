<?php
$senderecnumber="%2B256".$ftel;
$fullname=$row_users->firstname;


$content="ACFIM : Hello ".$fullname.", Your credentials; Username : ".$row_keyfields->username." And Password : ".$row_keyfields->password."";

$fcontent=str_replace(' ','+',$content);


$url = "http://www.egosms.co/api/v1/plain/?number=".$senderecnumber."&message=".$fcontent."&username=captain&password=0703611691q&sender=Egosms";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
$result = curl_exec ($ch); 
curl_close ($ch);


?>
