<!DOCTYPE html>
<html lang="en">
<?php session_start(); include 'include/header.php'; include 'main/pages/connect.php'; ?>
<body>
<?php 
if(isset($_GET['id'])){
    $_GET['id'];
    $result_products=$dbh->query("SELECT * FROM products where productid='".$_GET['id']."'");
    $count_products=$result_products->rowCount();
    $row_products=$result_products->fetchObject();

    $result_users=$dbh->query("SELECT * FROM users where rolenumber='".$row_products->clientid."'");
    $row_users=$result_users->fetchObject();
    
}
?>

<!-- LOADER -->
<div class="preloader">
    <div class="lds-ellipsis">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END LOADER -->

<?php //include 'include/popup.php'; ?>
<?php include 'include/header_wrap.php'; ?>

<!-- START MAIN CONTENT -->
<hr/>
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section" >
	<div class="container">
		<div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
              <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img" src='main/pages/uploads/<?php
                            $result_productimg =$dbh->query("SELECT * FROM productimg where productid='".$row_products->productid."' LIMIT 1 ");
                            $row_productimg=$result_productimg->fetchObject();
                            echo $row_productimg->imgName;?>' 
                            data-zoom-image="main/pages/uploads/<?php
                            $result_productimg =$dbh->query("SELECT * FROM productimg where productid='".$row_products->productid."' LIMIT 1 ");
                            $row_productimg=$result_productimg->fetchObject();
                            echo $row_productimg->imgName;?>" alt="product_img1" />
                        <a href="#" class="product_img_zoom" title="Zoom">
                            <span class="linearicons-zoom-in"></span>
                        </a>
                    </div>
                    <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                       
                    <?php
                     $result_productimg =$dbh->query("SELECT * FROM productimg where productid='".$row_products->productid."' ");
                     $row_productimg=$result_productimg->fetchObject();
                     $count_img=$result_productimg->rowCount();
                     if($count_img>0){
                        do{
                            ?>
                      <div class="item">
                            <a href="#" class="product_gallery_item active" data-image="main/pages/uploads/<?php echo $row_productimg->imgName; ?>" data-zoom-image="main/pages/uploads/<?php echo $row_productimg->imgName; ?>">
                                <img src="main/pages/uploads/<?php echo $row_productimg->imgName; ?>" alt="product_small_img1" />
                            </a>
                    </div>

                        <?php
                        }while( $row_productimg=$result_productimg->fetchObject());
                     }
                     ?>
                   

                        <!-- <div class="item">
                            <a href="#" class="product_gallery_item" data-image="assets/images/product_img1-2.jpg" data-zoom-image="assets/images/product_zoom_img2.jpg">
                                <img src="assets/images/product_small_img2.jpg" alt="product_small_img2" />
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="product_gallery_item" data-image="assets/images/product_img1-3.jpg" data-zoom-image="assets/images/product_zoom_img3.jpg">
                                <img src="assets/images/product_small_img3.jpg" alt="product_small_img3" />
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="product_gallery_item" data-image="assets/images/product_img1-4.jpg" data-zoom-image="assets/images/product_zoom_img4.jpg">
                                <img src="assets/images/product_small_img4.jpg" alt="product_small_img4" />
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title"><a href="#"><?php $row_products->title; ?></a></h4>
                        <div class="product_price">
                            <span class="price">ugx <?php echo $row_products->price; ?></span>
                           
                        </div>
                        <div class="pr_desc">
                            <p><?php echo $row_products->description; ?></p>
                        </div>  
                    </div>
                    <hr />
                    <ul class="product-meta">
                        <li>Seller: <a href="#"><?php echo $row_users->firstname. " ".$row_users->lastname; ?></a></li>
                        <li>Shop: <a href="#"><?php 
                        if($row_users->shop != ""){
                            echo $row_users->shop;
                        }else{
                            echo "<b><i>Not Specified</i></b>";
                        }
                        ?></a></li>
                    </ul>
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                        <div class="cart_btn">
                            <button class="btn btn-success" type="button"><i class="fa fa-phone"></i><?php echo $row_users->whatsp ?></button>
                        </div>
                        </div>
                        <div class="cart_btn">
                            <a href="https://wa.me/<?php echo $row_users->whatsp ?>" class="btn btn-primary" type="button"><i class="ion-social-whatsapp"></i>Chart via Whatsp</a>
                        </div>
                    </div>
                    <hr />
                    <div class="product_share">
                        <span>Share:</span>
                        <ul class="social_icons">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-whatsapp"></i></a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="large_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="tab-style3">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                      	</li>
                      	<li class="nav-item">
                        	<a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
                      	</li>
                      	<!-- <li class="nav-item">
                        	<a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews (2)</a>
                      	</li> -->
                    </ul>
                	<div class="tab-content shop_info_tab">
                      	<div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                        	<p><?php echo $row_products->detailed_description; ?></p>
                      	</div>
                      	<div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                          <?php echo $row_products->addintional_info; ?></p>
                      	</div>
                      	<!-- <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        	<div class="comments">
                            	<h5 class="product_tab_title">2 Review For <span>Blue Dress For Woman</span></h5>
                                <ul class="list_none comment_list mt-4">
                                    <li>
                                        <div class="comment_img">
                                            <img src="assets/images/user1.jpg" alt="user1"/>
                                        </div>
                                        <div class="comment_block">
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:80%"></div>
                                                </div>
                                            </div>
                                            <p class="customer_meta">
                                                <span class="review_author">Alea Brooks</span>
                                                <span class="comment-date">March 5, 2018</span>
                                            </p>
                                            <div class="description">
                                                <p>Lorem Ipsumin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment_img">
                                            <img src="assets/images/user2.jpg" alt="user2"/>
                                        </div>
                                        <div class="comment_block">
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:60%"></div>
                                                </div>
                                            </div>
                                            <p class="customer_meta">
                                                <span class="review_author">Grace Wong</span>
                                                <span class="comment-date">June 17, 2018</span>
                                            </p>
                                            <div class="description">
                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                        	</div>
                            <div class="review_form field_form">
                                <h5>Add a review</h5>
                                <form class="row mt-3">
                                    <div class="form-group col-12 mb-3">
                                        <div class="star_rating">
                                            <span data-value="1"><i class="far fa-star"></i></span>
                                            <span data-value="2"><i class="far fa-star"></i></span> 
                                            <span data-value="3"><i class="far fa-star"></i></span>
                                            <span data-value="4"><i class="far fa-star"></i></span>
                                            <span data-value="5"><i class="far fa-star"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text">
                                     </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email">
                                    </div>
                                   
                                    <div class="form-group col-12 mb-3">
                                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                      	</div> -->
                	</div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="small_divider"></div>
            	<div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="heading_s1">
                	<h3>Releted Products</h3>
                </div>
            	<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
<?php 
$result_products=$dbh->query("SELECT * FROM products WHERE ");
$count_products=$result_products->rowCount();
$row_products=$result_products->fetchObject();
if($count_products>0){
    do {
       
?>
<div class="item">
<div class="product_wrap">
<div class="product_img">
<a href="product-detail">
<img src="main/pages/uploads/
<?php
 $result_productimg =$dbh->query("SELECT * FROM productimg where productid='".$row_products->productid."' LIMIT 1 ");
 $row_productimg=$result_productimg->fetchObject();
 echo $row_productimg->imgName;
?>" alt="el_img1">
<img class="product_hover_img" src="main/pages/uploads/
<?php
 $result_productimg =$dbh->query("SELECT * FROM productimg where productid='".$row_products->productid."' LIMIT 1");
 $row_productimg=$result_productimg->fetchObject();
 echo $row_productimg->imgName;
?>" alt="el_hover_img1">
</a> 
</div>
<div class="product_info">
<h6 class="product_title"><a href="product-detail?id=<?php echo $row_products->productid; ?>"><?php echo $row_products->title; ?></a></h6>
<div class="product_price">
<span class="price">UGX <?php echo $row_products->price; ?></span>
</div>
<div class="product_title">
<span class="product_title">  <a style="text-decoration:none;" href = "https://wa.me/<?php
  $row_products->clientid; 
 $result_users=$dbh->query("SELECT * FROM users where rolenumber='".$row_products->clientid."'");
 $row_users=$result_users->fetchObject();
 echo $row_users->whatsp;
 ?>"> <?php echo $row_users->whatsp; ?></a></span>
</div>
</div>
</div>
</div>
<?php }while($row_products=$result_products->fetchObject()); } ?>
                  
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_default small_pt small_pb">
	<div class="container">	
    	<div class="row align-items-center">	
            <div class="col-md-6">
                <div class="heading_s1 mb-md-0 heading_light">
                    <h3>Subscribe Our Newsletter</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsletter_form">
                    <form>
                        <input type="text" required="" class="form-control rounded-0" placeholder="Enter Email Address">
                        <button type="submit" class="btn btn-dark rounded-0" name="submit" value="Submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->

</div>
<!-- END MAIN CONTENT -->

<!-- START FOOTER -->
<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 
<!-- START FOOTER -->
<?php include 'include/footer.php'; ?>
<!-- END FOOTER -->
<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 
<?php include 'include/script.php'; ?>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 


</body>
</html>