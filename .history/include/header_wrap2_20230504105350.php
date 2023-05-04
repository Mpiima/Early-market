<header class="header_wrap">
<div class="bottom_header dark_skin main_menu_uppercase border-top border-bottom">
<div class="custom-container">
<div class="row"> 
<div class="col-lg-3 col-md-4 col-sm-6 col-3">
<div class="categories_wrap">
<button type="button" data-bs-toggle="collapse" data-bs-target="#navCatContent" aria-expanded="false" class="categories_btn">
<i class="linearicons-menu"></i><span>Categories </span>
</button>
<div id="navCatContent" class="nav_cat navbar collapse">
<ul> 
<?php 
$result_catmain=$dbh->query("select * from scrap where type='prodcat' order by item2 asc");
$count_catmain=$result_catmain->rowCount();
$row_catmain=$result_catmain->fetchObject();
if($count_catmain>0){do{
echo "
<li class='dropdown dropdown-mega-menu'>
<a class='dropdown-item nav-link dropdown-toggler' href='categories.php?basin=".$row_catmain->item."' data-bs-toggle='dropdown'><i class='flaticon-tv'></i> <span>".$row_catmain->item2."</span></a>
<div class='dropdown-menu'>
<ul class='mega-menu d-lg-flex'>
<li class='mega-menu-col col-lg-7'>
<ul class='d-lg-flex'>
<li class='mega-menu-col col-lg-6'>
<ul> 
<li class='dropdown-header'>SubCotegories</li>";
$result_subcats=$dbh->query("select * from scrap where type='subcat' and item3='".$row_catmain->item."'");
$count_subcat=$result_subcats->rowCount();
$row_subcat=$result_subcats->fetchObject();
if($count_subcat>0){ do{echo "<li><a class='dropdown-item nav-link nav_item' href='types.php?memid=".$row_categories->item."'>".$row_subcat->item2."</a></li>";}while($row_subcat=$result_subcats->fetchObject());}else{echo "No Types Registered For This Category";}
echo"</ul>
</li></ul></li>
<li class='mega-menu-col col-lg-5'>
<div class='header-banner2'>
<img src='assets/images/logo.jpg' alt='menu_banner'>
</div>
</li>
</ul>
</div>
</li>
";	
}while($row_catmain=$result_catmain->fetchObject());}
?>	
</ul>
</div>
</div>
</div>
<div class="col-lg-9 col-md-8 col-sm-6 col-9">
<nav class="navbar navbar-expand-lg">
<button class="navbar-toggler side_navbar_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSidetoggle" aria-expanded="false"> 
<span class="ion-android-menu"></span>
</button>
<div class="pr_search_icon">
<a href="javascript:void(0);" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
</div> 
<div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
<ul class="navbar-nav">
<!-- <li><span class="nav-link nav_item" style="font-size: bold;">SELL FASTER, BUY SMARTER</span></li>  -->
</ul>
</div>
<div class="contact_phone contact_support">
<i class="linearicons-phone-wave"></i>
<span>+256-780-958321</span>
</div>
</nav>
</div>
</div>
</div>
</div>
</header>