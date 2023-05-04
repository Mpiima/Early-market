<!DOCTYPE html>
<html lang="en">
<?php 
include 'include/header.php'; 
include 'main/pages/connect.php'; 
?>

<body>

<!-- LOADER -->
<div class="preloader">
<div class="lds-ellipsis">
<span></span>
<span></span>
<span></span>
</div>
</div>
<!-- END LOADER -->

<!-- Home Popup Section -->
<!-- <div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-body">
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
</button>
<div class="row g-0">
<div class="col-sm-7">
<div class="popup_content  text-start">
<div class="popup-text">
<div class="heading_s1">
<h3>Subscribe Newsletter and Get 25% Discount!</h3>
</div>
<p>Subscribe to the newsletter to receive updates about new products.</p>
</div>
<form method="post">
<div class="form-group mb-3">
<input name="email" required type="email" class="form-control" placeholder="Enter Your Email">
</div>
<div class="form-group mb-3">
<button class="btn btn-fill-out btn-block text-uppercase" title="Subscribe" type="submit">Subscribe</button>
</div>
</form>
<div class="chek-form">
<div class="custome-checkbox">
<input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
<label class="form-check-label" for="exampleCheckbox3"><span>Don't show this popup again!</span></label>
</div>
</div>
</div>
</div>
<div class="col-sm-5">
<div class="background_bg h-100" data-img-src="assets/images/popup_img3.jpg"></div>
</div>
</div>
</div>
</div>
</div>
</div> -->
<!-- End Screen Load Popup Section --> 

<?php //include 'include/popup.php'; ?>
<!-- End Screen Load Popup Section --> 

<!-- START HEADER -->
<?php include 'include/header_wrap.php';  include 'include/header_wrap2.php';?>
<!-- END HEADER -->

<!-- START SECTION BANNER -->
<div class="mt-4 staggered-animation-wrap">
<div class="custom-container">
<div class="row">
<div class="col-lg-7 offset-lg-3">
<div class="banner_section shop_el_slider">
<div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-bs-ride="carousel">
<div class="carousel-inner">
<div class="carousel-item active background_bg" data-img-src="assets/images/logo.jpg" style='width:100%;max-height:230px;height: expression(this.height > 400 ? 400: true);min-height:400px;height: expression(this.height < 400 ? 400: true);'>
<div class="banner_slide_content banner_content_inner">
<div class="col-lg-7 col-10">
</div>
</div>
</div>

</div>
</div>
</div>
</div>
<div class="col-lg-2 d-none d-lg-block">
<div class="shop_banner2 el_banner1" style='width:100%;max-height:100px;height: expression(this.height > 200 ? 200: true);min-height:200px;height: expression(this.height < 200 ? 200: true);'>
<a href="#" class="hover_effect1">
<div class="el_img">
<!-- <img src="assets/images/logo.jpg" alt="shop_banner_img6"> -->
</div>
</a>
</div>
<div class="shop_banner2 el_banner2" style='width:100%;max-height:100px;height: expression(this.height > 170 ? 170: true);min-height:170px;height: expression(this.height < 170 ? 170: true);'>
<a href="#" class="hover_effect1">
<div class="el_img">
<!-- <img src="assets/images/logo.jpg" alt="shop_banner_img7"> -->
</div>
</a>
</div>
</div>
</div>
</div>
</div>
<!-- END SECTION BANNER -->

<!-- END MAIN CONTENT -->
<div class="main_content">
    <!-- START SECTION CATEGORIES -->
<div class="section pt-0 small_pb">
<div class="container">
<div class="row">
<div class="col-12">
<div class="cat_overlap radius_all_5">
<div class="row align-items-center">
<div class="col-lg-3 col-md-4">
<div class="text-center text-md-start">
<h4>EARLY MARKET</h4>
<p class="mb-2">World's largest market</p>
</div>
</div>
<div class="col-lg-9 col-md-8">
<div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "1"}, "380":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "4"}}'>
<div class="item">
<div class="categories_box">
<a href="#">
<i class="flaticon-bed"></i>
<span>Post Ad</span>
</a>
</div>
</div>
<div class="item">
<div class="categories_box">
<a href="#">
<i class="flaticon-table"></i>
<span>Sell</span>
</a>
</div>
</div>
<div class="item">
<div class="categories_box">
<a href="#">
<i class="flaticon-sofa"></i>
<span>Buy</span>
</a>
</div>
</div>
<div class="item">
<div class="categories_box">
<a href="#">
<i class="flaticon-armchair"></i>
<span>Subscribe</span>
</a>
</div>
</div>
</div></div>
</div></div></div></div></div>
</div>
<!-- END SECTION CATEGORIES -->

<!-- START SECTION SHOP -->
<div class="section small_pt pb-0">
<div class="custom-container">
<div class="row">
<div class="col-xl-3 d-none d-xl-block">
<div class="sale-banner">
<a class="hover_effect1" href="#">
<img src="assets/images/logo.jpg" alt="shop_banner_img6">
</a>
</div>
</div>
<div class="col-xl-9">
<div class="row">
<div class="col-12">
<div class="heading_tab_header">
<div class="heading_s2">
<h4>Exclusive Products</h4>
</div>
<div class="tab-style2">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#tabmenubar" aria-expanded="false"> 
<span class="ion-android-menu"></span>
</button>
<ul class="nav nav-tabs justify-content-center justify-content-md-end" id="tabmenubar" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="arrival-tab" data-bs-toggle="tab" href="#arrival" role="tab" aria-controls="arrival" aria-selected="true">Top Ads</a>
</li>
<li class="nav-item">
<a class="nav-link" id="sellers-tab" data-bs-toggle="tab" href="#sellers" role="tab" aria-controls="sellers" aria-selected="false">Best Sellers</a>
</li>
<li class="nav-item">
<a class="nav-link" id="featured-tab" data-bs-toggle="tab" href="#featured" role="tab" aria-controls="featured" aria-selected="false">Trending</a>
</li>
<li class="nav-item">
<a class="nav-link" id="special-tab" data-bs-toggle="tab" href="#special" role="tab" aria-controls="special" aria-selected="false">Special Offer
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="tab_slider">

<div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
<div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>


<!-- end of tab one -->
</div>
</div>
<div class="tab-pane fade" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
<div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
<div class="item">
<div class="product_wrap">
<div class="product_img">
<a href="product-detail">
<img src="assets/images/el_img7.jpg" alt="el_img7">
<img class="product_hover_img" src="assets/images/el_hover_img7.jpg" alt="el_hover_img7">
</a>
</div>
<div class="product_info">
<h6 class="product_title"><a href="product-detail">Audio Theaters</a></h6>
<div class="product_price">
<span class="price">0780958321</span>
</div>
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:80%"></div>
</div>
<span class="rating_num">(21)</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
<div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
<div class="item">
<div class="product_wrap">
<span class="pr_flash bg-danger">Hot</span>
<div class="product_img">
<a href="product-detail">
<img src="assets/images/el_img8.jpg" alt="el_img8">
<img class="product_hover_img" src="assets/images/el_hover_img8.jpg" alt="el_hover_img8">
</a>
</div>
<div class="product_info">
<h6 class="product_title"><a href="product-detail">Surveillance camera</a></h6>
<div class="product_price">
<span class="price">0780958321</span>
</div>
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:68%"></div>
</div>
<span class="rating_num">(15)</span>
</div></div></div>
</div></div></div>
<div class="tab-pane fade" id="special" role="tabpanel" aria-labelledby="special-tab">
<div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
<div class="item">
<div class="product_wrap">
<div class="product_img">
<a href="product-detail">
<img src="assets/images/el_img2.jpg" alt="el_img2">
<img class="product_hover_img" src="assets/images/el_hover_img2.jpg" alt="el_hover_img2">
</a>
</div>
<div class="product_info">
<h6 class="product_title"><a href="product-detail">Smart Watch External</a></h6>
<div class="product_price">
<span class="price">0780958321</span>
</div>
<div class="rating_wrap">
<div class="rating">
<div class="product_rate" style="width:68%"></div>
</div>
<span class="rating_num">(15)</span>
</div></div></div></div>
</div></div></div></div></div></div></div></div></div>
<!-- END SECTION SHOP -->

<!-- START SECTION BANNER --> 
<!-- <div class="section pb_20 small_pt">
<div class="custom-container">
<div class="row">
<div class="col-md-4">
<div class="sale-banner mb-3 mb-md-4">
<a class="hover_effect1" href="#">
<img src="assets/images/shop_banner_img7.jpg" alt="shop_banner_img7">
</a>
</div>
</div>
<div class="col-md-4">
<div class="sale-banner mb-3 mb-md-4">
<a class="hover_effect1" href="#">
<img src="assets/images/shop_banner_img8.jpg" alt="shop_banner_img8">
</a>
</div>
</div>
<div class="col-md-4">
<div class="sale-banner mb-3 mb-md-4">
<a class="hover_effect1" href="#">
<img src="assets/images/shop_banner_img9.jpg" alt="shop_banner_img9">
</a>
</div>
</div>
</div>
</div>
</div> -->
<!-- END SECTION BANNER --> 

<!-- START SECTION SHOP -->
<div class="section pt-0 pb-0">
<div class="custom-container">
<div class="row">
<div class="col-md-12">
<div class="heading_tab_header">
<div class="heading_s2">
<h4>Deal Of The Day</h4>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="product_slider carousel_slider owl-carousel owl-theme nav_style3" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "1"}, "650":{"items": "2"}, "1199":{"items": "2"}}'>
<div class="item">
<div class="deal_wrap">
<div class="product_img">
<a href="product-detail">
<img src="assets/images/el_img1.jpg" alt="el_img1">
</a>
</div>
<div class="deal_content">
<div class="product_info">
<h5 class="product_title"><a href="product-detail">Red & Black Headphone</a></h5>
<div class="product_price">
<span class="price">$45.00</span>
<del>$55.25</del>
</div>
</div>
<div class="deal_progress">
<span class="stock-sold">Already Sold: <strong>6</strong></span>
<span class="stock-available">Available: <strong>8</strong></span>
<div class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width:46%"> 46% </div>
</div>
</div>
<div class="countdown_time countdown_style4 mb-4" data-time="2021/10/02 12:30:15"></div>
</div>
</div>
</div>
<div class="item">
<div class="deal_wrap">
<div class="product_img">
<a href="product-detail">
<img src="assets/images/el_img2.jpg" alt="el_img2">
</a>
</div>
<div class="deal_content">
<div class="product_info">
<h5 class="product_title"><a href="product-detail">Smart Watch External</a></h5>
<div class="product_price">
<span class="price">$55.00</span>
<del>$95.00</del>
</div>
</div>
<div class="deal_progress">
<span class="stock-sold">Already Sold: <strong>4</strong></span>
<span class="stock-available">Available: <strong>22</strong></span>
<div class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100" style="width:26%"> 26% </div>
</div>
</div>
<div class="countdown_time countdown_style4 mb-4" data-time="2021/09/02 12:30:15"></div>
</div>
</div>
</div>
<div class="item">
<div class="deal_wrap">
<div class="product_img">
<a href="product-detail">
<img src="assets/images/el_img3.jpg" alt="el_img3">
</a>
</div>
<div class="deal_content">
<div class="product_info">
<h5 class="product_title"><a href="product-detail">Nikon HD camera</a></h5>
<div class="product_price">
<span class="price">$68.00</span>
<del>$99.25</del>
</div>
</div>
<div class="deal_progress">
<span class="stock-sold">Already Sold: <strong>16</strong></span>
<span class="stock-available">Available: <strong>20</strong></span>
<div class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100" style="width:28%"> 28% </div>
</div>
</div>
<div class="countdown_time countdown_style4 mb-4" data-time="2021/11/02 12:30:15"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- END SECTION SHOP -->

<!-- START SECTION SHOP -->
<div class="section small_pt small_pb">
<div class="custom-container">

</div>
</div>
<!-- END SECTION SHOP -->



<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_default small_pt small_pb">
<div class="custom-container">  
<div class="row align-items-center">    
<div class="col-md-6">
<div class="newsletter_text text_white">
<h3>Join Our Newsletter Now</h3>
<p> Register now to get updates on promotions. </p>
</div>
</div>
<div class="col-md-6">
<div class="newsletter_form2 rounded_input">
<form>
<input type="text" required="" class="form-control" placeholder="Enter Email Address">
<button type="submit" class="btn btn-dark btn-radius" name="submit" value="Submit">Subscribe</button>
</form>
</div>
</div>
</div>
</div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->

</div>


<?php include 'include/footer.php'; ?>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 
<?php include 'include/script.php'; ?>

</body>
</html>