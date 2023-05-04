<?php include("kfunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php kheader(); ?>

</head>

<body class="">
<?php leftbar(); ?>
<?php 
$id=$_GET['asin'];
$myname=$_GET['myname'];
?>
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-primary">
<h4 class="card-title ">SUB CATEGORY ATTRIBUTES</h4>
</div>
<div class="card-body">
  <h2 class="card-title text-center"><u style="font-weight:bold;text-transform: uppercase;"><?php echo $myname; ?> ATTRIBUTES</u></h2>
<table class="table table-bordered">
<thead>
<tr>
<th>No</th>
<th>Attributes</th>
</tr></thead>
<?php
$result_cats=$dbh->prepare("select * from subcat_attributes where subcatid=:memid order by item_name asc");
$result_cats->bindParam(':memid',$id);
$result_cats->execute();
$row_cats = $result_cats->fetchObject();
$count_cats = $result_cats->rowCount();
if($count_cats>0){$y=1;
do{
$result_subcat=$dbh->query("select * from scrap where item='$row_cats->attrid' and item3='$row_cats->subcatid'");
$row_subcat=$result_subcat->fetchObject();
$count_subcat = $result_subcat->rowCount();   
echo "
<tr>
<td>".$y++."</td>
<td><span style='color:maroon;font-weight:bold;'>[".$row_cats->item_name."]</span><br>"; 
if($row_cats->item_type==2){ $x=1; do{ echo "<span>".$row_subcat->item2."</span><br>"; }while($row_subcat=$result_subcat->fetchObject());}else{echo "No Attributes In This Section";}echo"</td>
</tr>";
}while($row_cats=$result_cats->fetchObject());
}else{echo "<tr><td align='center' colspan='10'>There is NO data</td></tr>";}
?>
</table>
</div>
</div>
</div>
</div>
</div>

<?php lscript(); ?>
</body>

</html>
