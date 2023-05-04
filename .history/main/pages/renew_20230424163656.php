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
    <?php 
    $yy=date("Y"); $fyy=substr($yy,2,2);$mm=date("m"); $dd=date("d");
    $hi=date("h"); $mi=date("i");$sa=date("sa"); $fsa=substr($sa,0,2); 
    $ref="REF";  
    $result_subscription=$dbh->query("select * from subscription  order by autoid desc");
    $row_subscription=$result_subscription->fetchObject();
     $txtref= $ref.($row_subscription->autoid+1);
     $reference=$txtref.$fyy.$mm.$dd.$hi.$mi.$fsa;
    
    ?>
<form method="POST"  action="https://checkout.flutterwave.com/v3/hosted/pay">
<div class="row">        
        <div class="col-lg-3">
            <select required class="form-control" name="period">
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
                <input type="hidden" name="customer[email]" value="<?php echo $_SESSION['email']; ?>" >
                <input type="hidden" name="tx_ref" value="<?php echo $reference; ?>" />
           
                <input type="hidden" name="amount" value="<?php echo '4000'; ?>"  class="form-control"/>
                <input type="text" name="amountt" value="<?php echo '4000'; ?>" disabled="disabled"  class="form-control"/>
                <!-- <input type="hidden" name="currency" value="USD" /> -->
            </div><div class="col-lg-3">
                <select class="form-control" name="currency" required="true">
                    <option value="UGX">-select currency -</option>
                    <?php 
                    $result_currency=$dbh->query("select * from currency");
                    $row_currency=$result_currency->fetchObject();
                    $count_currency=$result_currency->rowCount();
                    if($count_currency>0){
                        do{
                            ?>
                            <option value="<?php echo $row_currency->currency; ?>"><?php echo $row_currency->currency; ?></option>
                            <?php
                        }while($row_currency=$result_currency->fetchObject());
                    }
                    ?>
                </select>
                <input type="hidden" name="meta[token]" value="54" />
                <input type="hidden" name="redirect_url" value="http://early-market.com/main/pages/renew.php" id="start-payment-button"/>
            </div>

            <div class="col-lg-2">
                <button type="submit" name="pay" class="btn btn-warning" id="start-payment-button">Continue To Pay</button>
            </div>
</div></form>

<select id="my-select">
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
  <script>
document.getElementById('my-select').addEventListener('change', function() {
  document.writeIn("This is cool");
});
  </script>
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
