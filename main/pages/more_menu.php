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
<div class="card-heading card-header-success">
<h4 class="card-title">SYSTEM USER OPERATIONS</h4>
</div>
<div class="card-body">
<div class='row'>
<?php
$role=$_SESSION["role"];
$result_menutype1=$dbh->query("select * from menu where type='mo' and role like '%$role%' limit 0,8");
$row_menutype1=$result_menutype1->fetchObject();
$count_menutype1=$result_menutype1->rowCount();

if($count_menutype1>0){
echo "<div class='col-lg-6'>
<div class='list-group'>
<a class='list-group-item active'>User Menu </a>";
do{
echo "<a href='".$row_menutype1->link."' class='list-group-item list-group-item-action' title='".$row_menutype1->title."' ><i class='material-icons'>".$row_menutype1->img."</i> &nbsp;  &nbsp;".$row_menutype1->item."</a>
"; 
}while($row_menutype1=$result_menutype1->fetchObject());
echo "</div></div>";}


$result_menutype1=$dbh->query("select * from menu where type='mo' and role like '%$role%' limit 8,16");
$row_menutype1=$result_menutype1->fetchObject();
$count_menutype1=$result_menutype1->rowCount();


if($count_menutype1>0){ 
echo "<div class='col-lg-6'>
<div class='list-group'>
<a class='list-group-item active'> Extra Tools Menu </a>";
do{
echo "<a href='".$row_menutype1->link."' class='list-group-item list-group-item-action title='".$row_menutype1->title."' ><i class='material-icons'>".$row_menutype1->img."</i></i> &nbsp;  &nbsp;".$row_menutype1->item."</a>
"; 
}while($row_menutype1=$result_menutype1->fetchObject());
echo "</div></div>";}


?>

</div></div>
</div></div>


<?php lscript(); ?>
</body>

</html>
