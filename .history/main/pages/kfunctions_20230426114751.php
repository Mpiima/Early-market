<?php
@session_start();
include("connect.php");
$goodusers="and status='active'";
$rolenumber=$_SESSION["rolenumber"];
$role=$_SESSION["role"];
if (!isset($_SESSION['rolenumber'])) {
header('Location:../logout.php');
}
$today=date("Y-m-d");
$todaynow=date("Y-m-d h:i:s");
$currentyear=date("y");
$currentmonth=date("m");
//log Out if session has expired
$result_scrap = $dbh->prepare("select * from scrap where type='timeout'");
$result_scrap->execute();
$row_scrap  = $result_scrap->fetchObject();
?>
<script>
var sess_taker=function(){
var sess = "<?php echo $_SESSION["rolenumber"]; ?>";
if(sess == ''){window.location='../logout.php';} }
setInterval(sess_taker,500);

var timeout;
document.onmousemove = function(){
clearTimeout(timeout);
timeout = setTimeout(function(){window.location='../logout.php'}, <?php echo $row_scrap->item; ?>);

}
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
 $(document).ready(function () {
    $('#example').DataTable();
});
        </script>
<?php
//log Out if session has expired

function kheader(){
echo "<meta charset='utf-8' />
<link rel='apple-touch-icon' sizes='76x76' href='../assets/img/apple-icon.png'>
<link rel='icon' type='image/png' href='../assets/img/favicon.png'>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
<title>
EARLY MARKET
</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons' />
<link rel='stylesheet' href='css/font-awesome.min.css'>
<!-- CSS Files -->
<link href='../assets/css/material-dashboard.css?v=2.1.1' rel='stylesheet' />
<style type='text/css'>
.pagination {
list-style-type: none;padding: 10px 0;display: inline-flex;
justify-content: space-between;box-sizing: border-box;}
.pagination li {box-sizing: border-box;padding-right: 10px;}
.pagination li a {box-sizing: border-box;background-color: #e2e6e6;padding: 8px;
text-decoration: none;font-size: 12px;font-weight: bold;color: #616872;border-radius: 4px;}.pagination li a:hover {background-color: #d4dada;}
.pagination .next a, .pagination .prev a {text-transform: uppercase;font-size: 12px;}
.pagination .currentpage a {background-color: #518acb;color: #fff;}
.pagination .currentpage a:hover {background-color: #518acb;}
</style>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css'>
";
}

function leftbar(){
include("connect.php");
$rolenumber=$_SESSION["rolenumber"];
$result_users=$dbh->query("select * from users where rolenumber='$rolenumber'");
$row_users=$result_users->fetchObject();

echo "<div class='wrapper '>
<div class='sidebar' data-color='green' data-background-color='white' data-image='../assets/img/sidebar-1.jpg'>
<!--
Tip 1: You can change the color of the sidebar using: data-color='purple | azure | green | orange | danger'

Tip 2: you can also add an image using data-image tag
-->
<div class='logo'>
<a href='index.php' class='simple-text logo-normal'>
EARLY MARKET<br>".$_SESSION["firstname"]." ".$_SESSION["lastname"]."<br><span style='font-size:15px;color:maroon;'>".$row_users->fulltitle."</span>
</a>
</div>
<div class='sidebar-wrapper'>
<ul class='nav'>";
echo $_SESSION['rolenumber'];
$result_sub1=$dbh->query("select * from status_sub where clientid='".$_SESSION['rolenumber']."'");
$count_sub1=$result_sub1->rowCount();
$row_sub1=$result_sub1->fetchObject();
// echo $dt=date('Y-m-d');
echo $row_sub1->expirydate;
if($row_sub1->expirydate>$dt){
$st=".isDisabled {
                color: currentColor;
                cursor: not-allowed;
                opacity: 0.5;
                text-decoration: none;
              }
";
}else{
$st="";
}
$role=$_SESSION["role"];
$result_menu=$dbh->query("select * from menu where role like '%$role%' and type='' or type='head' order by itemorder asc");
$row_menu=$result_menu->fetchObject();
$count_menu=$result_menu->rowCount();
if($count_menu>0){ do{
if(substr($_SERVER['REQUEST_URI'],6)==$row_menu->link){$act="active";}
else{$act='';}
echo "<li class='nav-item ".$act." ".$st."'>
<i class='material-icons'><span style='font-weight:bold:color:maroon'></span></i>
<a class='nav-link' href='./".$row_menu->link."'>
<p style='font-weight:bold:color:#000000;'>".$row_menu->item."</p>
</a>
</li>";
}while($row_menu=$result_menu->fetchObject());}
echo "
<div class='card' style='width:100%;height:150px;text-align:center;'>
<div class='card-body'>
<img src='img/elog.png' style='width:60%;'>
</div>
</div>
</ul>
</div>
</div>
<div class='main-panel'>
<!-- Navbar -->
<nav class='navbar navbar-expand-lg bg-white navbar-absolute fixed-top '>
<div class='container-fluid'>
<button class='navbar-toggler' type='button' data-toggle='collapse' aria-controls='navigation-index' aria-expanded='false' aria-label='Toggle navigation'>
<span class='sr-only'>Toggle navigation</span>
<span class='navbar-toggler-icon icon-bar'></span>
<span class='navbar-toggler-icon icon-bar'></span>
<span class='navbar-toggler-icon icon-bar'></span>
</button>
<div class='collapse navbar-collapse justify-content-end'>
<form class='navbar-form'>
<div class='input-group no-border'>
<input type='text' value='' class='form-control' placeholder='Search...'>
<button type='submit' class='btn btn-white btn-round btn-just-icon'>
<i class='material-icons'>search</i>
<div class='ripple-container'></div>
</button>
</div>
</form>
<ul class='navbar-nav'>
<li class='nav-item'>
<a class='nav-link' href='#pablo'>
<i class='material-icons'>dashboard</i>
<p class='d-lg-none d-md-block'>
Stats
</p>
</a>
</li>
<li class='nav-item dropdown'>
<a class='nav-link' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
<i class='material-icons'>messages</i>
<span class='notification'>9</span>
</a>
<div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownMenuLink'>
<a class='btn btn-sm btn-primary' style='width:100%;text-align:center;' href='message_compose.php'>New Message</a>
<a href='#'><br></a>
<a class='btn btn-sm btn-warning' style='width:100%;text-align:center;' href='message.php?msgt=unr'>View Messages</a>
</div>
</li>
<li class='nav-item dropdown'>
<a class='nav-link' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
<i class='material-icons'>notifications</i>
<span class='notification'>20</span>
<p class='d-lg-none d-md-block'>
Some Actions
</p>
</a>
<div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownMenuLink'>
<a class='dropdown-item alert alert-warning' style='color:#fff;' href='#'>Un-Approved Expenses</a>
</li>
<li class='nav-item dropdown'>
<a class='nav-link' href='#pablo' id='navbarDropdownProfile' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
<i class='material-icons'>person</i>
<p class='d-lg-none d-md-block'>
Account
</p>
</a>
<div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownProfile'>
<a class='dropdown-item' href='edit_profile.php'>Profile</a>
<a class='dropdown-item' href='#'>Settings</a>
<div class='dropdown-divider'></div>
<a class='dropdown-item' href='../logout.php'>Log out</a>
</div>
</li>
</ul>
</div>
</div>
</nav>
<!-- End Navbar -->
<div class='content'>
<div class='container-fluid'>";

}
function user_activity($activity){
include("connect.php");
global $rolenumber;
$ip_ad=$_SERVER['REMOTE_ADDR'];
if(isset($_SERVER['HTTP_REFERER'])){$previouspage=$_SERVER['HTTP_REFERER'];}
else{$previouspage='';}
$currentpage=$_SERVER['SCRIPT_NAME'];
$kbrowser=$_SERVER['HTTP_USER_AGENT'];
$insertactivity = $dbh->query("insert into useractivity (activity,browser,previouspage,deviceid,userid,currentpage) values('$activity','$kbrowser','$previouspage','$ip_ad','$rolenumber','$currentpage')");
}

function datediff_est($date1){
include("connect.php");

$date2=date("Y-m-d H:i:s");
$zdt=substr($date1,0,10);
$zhr=substr($date1,11,2);
$zmn=substr($date1,13);

$result = $dbh->query("select * from autodatetranslatortoeat where fdate='$zhr'");
$row = $result->fetchObject();
$fdate=$zdt." ".$row->ldate.$zmn;

$date_1 = new DateTime($fdate);
$date_2 = new DateTime($date2);
$diff = $date_1->diff($date_2);

if ($diff->days > 365) {
return $date_1->format('Y-m-d');
} elseif ($diff->days > 7) {
return $date_1->format('M d');
} elseif ($diff->days > 2) {
return $date_1->format('l - H:i');
} elseif ($diff->days == 2) {
return "Yesterday ".$date_1->format('H:i');
} elseif ($diff->days > 0 OR $diff->h > 1) {
return $date_1->format('H:i');
} elseif ($diff->i >= 1) {
return $diff->i." min ago";
} else {
return "Just now";
}
}


function report_filters(){
include("connect.php");
echo "<form method='post'>
<div class='row' style='color:maroon;'>
<h4 class='col-md-1' style='margin-right:-20px;'><b>Filters : </b></h4>
<div class='col-md-1' style='margin-right:-35px;'><b>From :</b></div>
<div class='col-md-2'><input type='date' name='datefrom' class='form-control'></div>

<div class='col-md-1' style='margin-right:-60px;'><b>To :</b></div>
<div class='col-md-2'><input type='date' name='dateto' class='form-control'></div>  

<div class='col-md-2'><select class='form-control' name='category'>
<option value=''>All Forms</option>";

$result_scrap = $dbh->query("select * from scrap where type='cat'");
$row_scrap = $result_scrap->fetchObject();
$count_scrap = $result_scrap->rowCount();

if($count_scrap>0){ do{
echo "<option value='".$row_scrap->item."'>".$row_scrap->item3." - ".$row_scrap->item2."</option>";
}while($row_scrap = $result_scrap->fetchObject());}
else{echo "<option value=''>There is no data as yet. </option>";}
?>
</select></div>

<div class='col-md-2'><select class='form-control' name='district'>
<option value=''>All District</option>
<?php
$result_scrap = $dbh->query("select * from scrap where type='district'");
$row_scrap = $result_scrap->fetchObject();
$count_scrap = $result_scrap->rowCount();

if($count_scrap>0){ do{
echo "<option value='".$row_scrap->item."'>".$row_scrap->item2."</option>";
}while($row_scrap = $result_scrap->fetchObject());}
else{echo "<option value=''>There is no data as yet. </option>";}
?>
</select></div>
<div class="col-md-2"><select class='form-control' name='constituency'>
<option value=''>All Constituencies</option>
<?php
$result_scrap = $dbh->query("select * from scrap where type='con_dis'");
$row_scrap = $result_scrap->fetchObject();
$count_scrap = $result_scrap->rowCount();

if($count_scrap>0){ do{
echo "<option value='".$row_scrap->item."'>".$row_scrap->item2."</option>";
}while($row_scrap = $result_scrap->fetchObject());}
else{echo "<option value=''>There is no data as yet. </option>";}

echo "</select></div>
<div class='col-lg-12'>
<input type='submit' style='float:right;' class='btn btn-sm btn-success' name='filter' value='Filter'></div>
</div>
</form>";

if(isset($_POST["filter"])){
$datefrom=$_POST["datefrom"];
$dateto=$_POST["dateto"];
$category=$_POST["category"];
$district=$_POST["district"];
$constituency=$_POST["constituency"];

$result_scrapc = $dbh->query("select * from scrap where type='cat' and item='$category'");
$row_scrapc = $result_scrapc->fetchObject();

$result_scrapd = $dbh->query("select * from scrap where type='district' and item='$district'");
$row_scrapd = $result_scrapd->fetchObject();

$result_scrapco = $dbh->query("select * from scrap where type='con_dis' and item='$constituency'");
$row_scrapco = $result_scrapco->fetchObject();

echo  "<span style='color:green;'><b>FILTERED ;</b><br></span>";
if(!empty($datefrom)&&!empty($dateto)){$dadate="and ('$datefrom'>=incidentdate && '$dateto'<=incidentdate)"; 
echo "<span style='color:maroon;'><i> FROM INCIDENT DATE : </i></span>".$datefrom."<span style='color:maroon;'><i> TO : </i></span>".$dateto."; ";}

elseif(!empty($datefrom)&&empty($dateto)){$dadate="and incidentdate='$datefrom'";
echo  "<span style='color:maroon;'><i> INCIDENT DATE : </i></span>".$datefrom."; ";}

elseif(empty($datefrom)&&!empty($dateto)){$dadate="and incidentdate='$dateto'";
echo  "<span style='color:maroon;'><i> INCIDENT DATE : </i></span>".$dateto."; ";}

elseif(empty($datefrom)&&empty($dateto)){$dadate='';}

if(!empty($category)){$dacat="and bigcatid='$category'";
echo "<span style='color:maroon;'><i>FORM : </i></span>".$row_scrapc->item2."; ";}else{$dacat='';}

if(!empty($district)){$dadis="and canddist='$district'";
echo  "<span style='color:maroon;'><i> DISTRICT : </i></span>".$row_scrapd->item2."; ";}else{$dadis='';}

if(!empty($constituency)){$dacon="and candconsist='$constituency'";
echo  "<span style='color:maroon;'><i> CONSTITUENCY : </i></span>".$row_scrapco->item2."; ";}else{$dacon='';}

}
else{$dadate=''; $dacat=''; $dadis=''; $dacon='';}
$GLOBALS["dadate"]=$dadate;
$GLOBALS["dacat"]=$dacat;
$GLOBALS["dadis"]=$dadis;
$GLOBALS["dacon"]=$dacon;

}


function lscript(){
echo "</div></div>
</div><footer class='footer'>

<div class='copyright float-right'>
&copy;
<script>
document.write(new Date().getFullYear())
</script>EARLY-MARKET.
</div>
</div>
</footer>
</div>

</div><!--   Core JS Files   -->
<script src='../assets/js/core/jquery.min.js'></script>
<script src='../js/jquery.js'></script>
<script src='../assets/js/core/popper.min.js'></script>
<script src='../assets/js/core/bootstrap-material-design.min.js'></script>
<script src='../assets/js/plugins/perfect-scrollbar.jquery.min.js'></script>
<!-- Plugin for the momentJs  -->
<script src='../assets/js/plugins/moment.min.js'></script>
<!--  Plugin for Sweet Alert -->
<script src='../assets/js/plugins/sweetalert2.js'></script>
<!-- Forms Validations Plugin -->
<script src='../assets/js/plugins/jquery.validate.min.js'></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src='../assets/js/plugins/jquery.bootstrap-wizard.js'></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src='../assets/js/plugins/bootstrap-selectpicker.js'></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src='../assets/js/plugins/bootstrap-datetimepicker.min.js'></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src='../assets/js/plugins/jquery.dataTables.min.js'></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src='../assets/js/plugins/bootstrap-tagsinput.js'></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src='../assets/js/plugins/jasny-bootstrap.min.js'></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src='../assets/js/plugins/fullcalendar.min.js'></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src='../assets/js/plugins/jquery-jvectormap.js'></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src='../assets/js/plugins/nouislider.min.js'></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js'></script>
<!-- Library for adding dinamically elements -->
<script src='../assets/js/plugins/arrive.min.js'></script>
<!--  Google Maps Plugin    -->
<script src='https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'></script>
<!-- Chartist JS -->
<script src='../assets/js/plugins/chartist.min.js'></script>
<!--  Notifications Plugin    -->
<script src='../assets/js/plugins/bootstrap-notify.js'></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src='../assets/js/material-dashboard.js?v=2.1.1' type='text/javascript'></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src='../assets/demo/demo.js'></script>"; ?>
<script>
$(document).ready(function() {
$().ready(function() {
$sidebar = $('.sidebar');

$sidebar_img_container = $sidebar.find('.sidebar-background');

$full_page = $('.full-page');

$sidebar_responsive = $('body > .navbar-collapse');

window_width = $(window).width();

fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
$('.fixed-plugin .dropdown').addClass('open');
}

}

$('.fixed-plugin a').click(function(event) {
// Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
if ($(this).hasClass('switch-trigger')) {
if (event.stopPropagation) {
event.stopPropagation();
} else if (window.event) {
window.event.cancelBubble = true;
}
}
});

$('.fixed-plugin .active-color span').click(function() {
$full_page_background = $('.full-page-background');

$(this).siblings().removeClass('active');
$(this).addClass('active');

var new_color = $(this).data('color');

if ($sidebar.length != 0) {
$sidebar.attr('data-color', new_color);
}

if ($full_page.length != 0) {
$full_page.attr('filter-color', new_color);
}

if ($sidebar_responsive.length != 0) {
$sidebar_responsive.attr('data-color', new_color);
}
});

$('.fixed-plugin .background-color .badge').click(function() {
$(this).siblings().removeClass('active');
$(this).addClass('active');

var new_color = $(this).data('background-color');

if ($sidebar.length != 0) {
$sidebar.attr('data-background-color', new_color);
}
});

$('.fixed-plugin .img-holder').click(function() {
$full_page_background = $('.full-page-background');

$(this).parent('li').siblings().removeClass('active');
$(this).parent('li').addClass('active');


var new_image = $(this).find("img").attr('src');

if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
$sidebar_img_container.fadeOut('fast', function() {
$sidebar_img_container.css('background-image', 'url("' + new_image + '")');
$sidebar_img_container.fadeIn('fast');
});
}

if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

$full_page_background.fadeOut('fast', function() {
$full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
$full_page_background.fadeIn('fast');
});
}

if ($('.switch-sidebar-image input:checked').length == 0) {
var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

$sidebar_img_container.css('background-image', 'url("' + new_image + '")');
$full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
}

if ($sidebar_responsive.length != 0) {
$sidebar_responsive.css('background-image', 'url("' + new_image + '")');
}
});

$('.switch-sidebar-image input').change(function() {
$full_page_background = $('.full-page-background');

$input = $(this);

if ($input.is(':checked')) {
if ($sidebar_img_container.length != 0) {
$sidebar_img_container.fadeIn('fast');
$sidebar.attr('data-image', '#');
}

if ($full_page_background.length != 0) {
$full_page_background.fadeIn('fast');
$full_page.attr('data-image', '#');
}

background_image = true;
} else {
if ($sidebar_img_container.length != 0) {
$sidebar.removeAttr('data-image');
$sidebar_img_container.fadeOut('fast');
}

if ($full_page_background.length != 0) {
$full_page.removeAttr('data-image', '#');
$full_page_background.fadeOut('fast');
}

background_image = false;
}
});

$('.switch-sidebar-mini input').change(function() {
$body = $('body');

$input = $(this);

if (md.misc.sidebar_mini_active == true) {
$('body').removeClass('sidebar-mini');
md.misc.sidebar_mini_active = false;

$('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

} else {

$('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

setTimeout(function() {
$('body').addClass('sidebar-mini');

md.misc.sidebar_mini_active = true;
}, 300);
}

// we simulate the window Resize so the charts will get updated in realtime.
var simulateWindowResize = setInterval(function() {
window.dispatchEvent(new Event('resize'));
}, 180);

// we stop the simulation of Window Resize after the animations are completed
setTimeout(function() {
clearInterval(simulateWindowResize);
}, 1000);

});
});
});
</script>
<script>
$(document).ready(function() {
// Javascript method's body can be found in assets/js/demos.js
md.initDashboardPageCharts();

});
</script>

<?php  } 

//useractivity
$ip_ad=$_SERVER['REMOTE_ADDR'];
if(isset($_SERVER['HTTP_REFERER'])){$previouspage=$_SERVER['HTTP_REFERER'];}
else{$previouspage='';}
$currentpage=$_SERVER['SCRIPT_NAME'];
$kbrowser=$_SERVER['HTTP_USER_AGENT'];
$insertactivity = $dbh->exec("insert into useractivity 
(activity,browser,previouspage,deviceid,userid,currentpage) 
values('On page','$kbrowser','$previouspage','$ip_ad','$rolenumber','$currentpage')");
//useractivity
?>

