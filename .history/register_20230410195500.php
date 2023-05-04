<!DOCTYPE html>
<html lang="en">
<?php include 'include/header.php'; ?>
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

<?php //include 'include/popup.php'; ?>
<?php include 'include/header_wrap.php'; ?>

<hr/>
<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START LOGIN SECTION -->
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
            		<div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Create an Account</h3>
                        </div>
                        <form method="post">
                            <div class="form-group mb-3">
                                <input type="text" required="true" class="form-control" name="name" placeholder="Enter Your Name">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" required="true" class="form-control" name="email" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group mb-3">
                                <select class="form-control" required>
                                <option value="">- select country -</option>
                                <option value="Uganda">Uganda</option>
                                </select>
                                <input type="text" required="true" class="form-control" name="country" placeholder="Enter Your Country">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="shop" placeholder="Enter Your Shop Name/No.">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" required="" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" required="" type="password" name="password" placeholder="Confirm Password">
                            </div>
                            <div class="login_footer form-group mb-3">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                        <label class="form-check-label" for="exampleCheckbox2"><span>I agree to terms &amp; Policy.</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-fill-out btn-block" name="register">Register</button>
                            </div>
                        </form>
                        <div class="form-note text-center">Already have an account? <a href="login">Log in</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->

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


<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 
<!-- START FOOTER -->
<?php include 'include/footer.php'; ?>
<!-- END FOOTER -->
<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 
<?php include 'include/script.php'; ?>


</body>
</html>