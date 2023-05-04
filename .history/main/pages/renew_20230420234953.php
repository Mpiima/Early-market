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
    <div class="row">
        <div class="col-lg-9">
        <h4 class="card-title "><b>SUBSCRIPTION RENEWAL</b></h4> 
        </div>
    </div>
</div>
<div class="card-body">
<form method="POST"  action="https://checkout.flutterwave.com/v3/hosted/pay">
<div class="row">        
        <div class="col-lg-4">
            <select required class="form-control">
                <option> -Select No of Months -</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
            <div class="col-lg-3">
                <input type="hidden" name="public_key" value="FLWPUBK-9dafbff5c68d96f73e373a6ae778316a-X" />
                <input type="hidden" name="customer[email]" value="collinsmpiima@gmail.com" />
                <input type="hidden" name="customer[name]" value="MPIIMA COLLINS" />
                <input type="hidden" name="tx_ref" value="bitethtx-0192033" />
                <input type="text" name="amount" value="1500" disabled="disabled" class="form-control"/>
                <input type="hidden" name="currency" value="USD" />
                <input type="hidden" name="meta[token]" value="54" />
                <input type="hidden" name="redirect_url" value="index.php" id="start-payment-button"/>
            </div>

            <div class="col-lg-2">
                <button type="submit" name="pay" class="btn btn-warning" id="start-payment-button">Continue To Pay</button>
            </div>
</div></form>
</div>
</div>
</div>
</div>
</div>
<!-- Table showing list of seller's products -->
<!--ends here -->

<?php lscript(); ?>
</body>

</html>
