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
<h4 class="card-title "><b>MANAGE CATEGORIES</b></h4>
</div>
<div class="card-body">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th><b>No</b></th>
<th><b>Category</b></th>
<th><b>Sub Category</b></th>
</tr></thead>
<?php
$result_cats = $dbh->query("select * from scrap where type='prodcat' order by item2 asc");
$row_cats = $result_cats->fetchObject();
$count_cats = $result_cats->rowCount();
if($count_cats>0){$y=1;
do{
$result_subcat = $dbh->query("select * from scrap where item3='$row_cats->item' and type='subcat'");
$row_subcat = $result_subcat->fetchObject();
$count_subcat = $result_subcat->rowCount(); 
echo "
<tr>
<td>".$y++."</td>
<td>";if($count_cats>0){echo "<span style='text-transform:uppercase'>".$row_cats->item2."</span>";}echo"</td>
<td>";if($count_subcat>0){$m=1; do{echo"<a href='morecats.php?asin=".$row_subcat->item."&myname=".$row_subcat->item2."'><span style='text-transform:capitalise'>".$m++.".".$row_subcat->item2."</span></a><br>";}while($row_subcat=$result_subcat->fetchObject());}else{echo "No sub categories registered";}echo"</td>
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
