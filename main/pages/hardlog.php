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
<div class="card-header card-header-primary">
<h4 class="card-title ">System Logs</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th width="200px">Time</th>
<th width="200px">IP Address</th>
<th width="200px">User</th>
<th width="20px">CRpage</th>
<th width="20px">FMRpage</th>
<th width="20px">Browser</th>

</tr></thead>
<tbody>
<?php
$result = $dbh->query("select * from useractivity order by autoid desc limit 10");
$row = $result->fetchObject();
$count = $result->rowCount();

if($count>0){
do{

$result2 = $dbh->query("select * from users where rolenumber='$row->userid'");
$row2 = $result2->fetchObject();
$count2 = $result2->rowCount(); 

echo "
<tr>
<td>".$row->autodate."</td>
<td>".$row->deviceid."</td>
<td>"; if(!empty($row->userid)){echo $row2->firstname."&nbsp".$row2->lastname;} if($row->activity!="On page"){echo "<br><span style='color:maroon;'>".$row->activity."</span><br>";}  echo "</td>
<td style='word-wrap: break-word;' title='".$row->currentpage."'>".substr($row->currentpage,0,45)."</td>
<td style='word-wrap: break-word;' title='".$row->previouspage."'>".substr($row->previouspage,0,55)."</td>
<td>".substr($row->browser,0,49)."</td>
</tr>";}while($row = $result->fetchObject());
}else{echo "<tr><td align='center' colspan='10'>There is NO data</td></tr>";}
?>
</tbody>
</table>
</div></div>
</div>

<?php lscript(); ?>
</body>

</html>
