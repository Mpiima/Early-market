<!DOCTYPE html>
<html lang="en">
<?php
include 'main/pages/connect.php';
 include 'include/header.php'; ?>
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
                            <?php 
                            if(isset($_POST['register'])){
                                $fname=$_POST['fname'];
                                $lname=$_POST['lname'];
                                $email=$_POST['email'];
                                $tel=$_POST['tel'];
                                $whatsp=$_POST['whatsp'];
                                $country=$_POST['country'];
                                $shop=$_POST['shop'];
                                $password=$_POST['password'];
                                $cpassword=$_POST['cpassword'];
                                $yy=date("Y"); $fyy=substr($yy,2,2);$mm=date("m"); $dd=date("d");
                                $hi=date("h"); $mi=date("i");$sa=date("sa"); $fsa=substr($sa,0,2);   
                                $role="sls";
                                $result_user=$dbh->query("select * from users where role='sls' order by autoid desc");
                                $row_user=$result_user->fetchObject();
                                $rolenumber= $role.$row_user->autoid;
                                $id=$rolenumber.$fyy.$mm.$dd.$hi.$mi.$fsa;
                                $address=$_POST['address'];
                                $status="active";
                                $username=$email;
                                //insert into users
                                // INSERT INTO `users`(`autoid`, `role`, `datecreated`,
                                //  `firstname`, `lastname`, `gender`, `phonenumber`, `phonenumber2`,
                                //   `email`, `listings`, `fulltitle`, `department`, `status`, `ssid`, `rolenumber`, `constituency`, 
                                // `birthday`, `payment_plan`, `address`, `country`, `shop`)
                                $insert_users=$dbh->query("INSERT INTO users(role,firstname,lastname,phonenumber,whatsp,
                                email,status,rolenumber,address,country,shop)value('$role','$fname','$lname','$tel','$whatsp','$email',
                                '$status','$rolenumber','$address','$country','$shop')");
                                $insert_keyfeilds=$dbh->query("INSERT INTO keyfields(rolenumber,username,password,pswdexpiry,status
                                )value('$rolenumber','$username','$password','2030-12-31',1)");
                                if($insert_users){
                                    echo "<div class='alert alert-success'>You have successfully registered , continue to 
                                    <a href='login'> login</a></div>";
                                }else{
                                    echo "<div class='alert alert-danger'>Failed to Register, Try again </div>";
                                }
                                //insert into keyfields

                            }
                            ?>
                        </div>
                        <form method="post">
                            <div class="form-group mb-3">
                                <input type="text" required="true" class="form-control" name="fname" placeholder="Enter Your Firstname">
                            </div>
                             <div class="form-group mb-3">
                                <input type="text" required="true" class="form-control" name="lname" placeholder="Enter Your Lastname">
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" required="true" class="form-control" name="email" placeholder="Enter Your Email">
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" required="true" class="form-control" name="tel" placeholder="Enter Your Phone_no">
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" required="true" class="form-control" name="whatsp" placeholder="Enter Your Whatsp No">
                            </div>
                           
                            <div class="form-group mb-3">
                            <select class="form-control" required name="country">
                            <option value="">- select country -</option>
                            <?php 
                            $result_country = $dbh->query("select * from countries");
                            $row_country = $result_country->fetchObject();
                            $count_country = $result_country->rowCount();
                            if($count_country>0){
                                do{
                                echo "<option value='$row_country->code'>$row_country->country</option>";
                                }while($row_country = $result_country->fetchObject());
                            }
                            ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <textarea class="form-control" name="address" placeholder="Enter your full Address"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="shop" placeholder="Enter Your Shop Name/No.">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" required="" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" required="" type="password" name="cpassword" placeholder="Confirm Password">
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