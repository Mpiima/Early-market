<?php
 $del_item=$_POST["del_item"];
 $typez=$_POST["typez"];
 $act=$_POST["activity"]; 
 $activity="Deleted ".$typez." : ".$act;

 $cols=array('bigcatid','subcatid','smallcatid','candid','candpost','candconsist','candpolparty','canddist');
$c=''; foreach($cols as $col){$c.=" or $col='$del_item'";}
$result_strans=$dbh->query("select * from smalltransact where autoid=0 $c"); 
$count_strans=$result_strans->rowCount();

 $colss=array('candidateid','fi1','fi2','fi3','fi4','fi5','fi6','fi7','fi8','fi9','fi10','fi11','fi12','fi13','fi14','fi15');
$b=''; foreach($colss as $cols){$b.=" or $cols='$del_item'";}
$result_btrans=$dbh->query("select * from bigtransact where autoid=0 $b"); 
$count_btrans=$result_btrans->rowCount();

if($count_strans<=0&&$count_btrans<=0){

if($typez=="Candidate"){
$delete_cand=$dbh->query("delete from candidates where candidateid='$del_item'");
  if($delete_cand){echo "Success : Candidate has been deleted.";}}

else{ 

 $delete_item=$dbh->query("delete from scrap where item='$del_item'");
  if($delete_item){echo "Success : Item has been deleted.";}}

  $ip_ad=$_SERVER['REMOTE_ADDR'];
if(isset($_SERVER['HTTP_REFERER'])){$previouspage=$_SERVER['HTTP_REFERER'];}
else{$previouspage='';}
$currentpage=$_SERVER['SCRIPT_NAME'];
$kbrowser=$_SERVER['HTTP_USER_AGENT'];
$insertactivity = $dbh->query("insert into useractivity (activity,browser,previouspage,deviceid,userid,currentpage) values('$activity','$kbrowser','$previouspage','$ip_ad','$rolenumber','$currentpage')");

}else{echo "Error : Item has data attached to him/her. Can't be deleted.";}

?>