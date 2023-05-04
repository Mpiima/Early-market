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
<form>
<div class="row">
  
        
        <div class="col-lg-7">
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
                <input type="text" value="100000" disabbled = "true" />
            </div>

            <div class="col-lg-2">
                <input type="submit" value="Continue"/>
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
