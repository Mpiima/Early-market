<?php 
$status=$_GET['status'];
if($status=="cancelled"){
//message and redirect
}else if($status == "success"){
    $clientid=$_POST['clientid'];
    $amount=$_POST['amount'];
    $period=$POST['period'];
    $ref_no=$_POST['ref_no'];
    $stat=1;
    $expirydate= $expirydta;
    //insert into database subscription
    // `autoid`, `status`, `ref_no`, `amount`, 
    // `client_id`, `period`, `created_on`, `expiry_date`, `update_on`
    $insert_sub=$dbh->query("INSERT into subscription(status,ref_no,amount,client_id,
    period,expiry_date)values('$status','$ref_no','$amount','$clientid','$period','$expirydate')");
    if($insert_sub){
      echo "Your subscription hasbeen recieved Successfully, Thank you for renewing your account !";
    }else{

    }

    //message and success, add to the database table  subscription

}else if($status=="failed"){
    //message and redirect

}else if($status=="insufficient"){
    //message and redirect


}

?>