<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rave payment Gateway</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <form action="pay.php" method="POST">

        <label>Email</label>
        <input type="email" name="email">
        <br>
        <label>Amount</label>
        <input type="number" name="amount">
        <br>
        <input type="submit" name="pay" vlaue="Send Payment">

        </form>
    </body>


<style>
body {
  font-family: Sans-Serif;
}

#start-payment-button {
    cursor: pointer;
    position: relative;
    background-color: blueviolet;
    color: #fff;
    max-width: 30%;
    padding: 10px;
    font-weight: 600;
    font-size: 14px;
    border-radius: 10px;
    border: none;
    transition: all .1s ease-in;
}
</style>



    <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">
  <div>
    Your order is ₦3,400
  </div>
  <input type="hidden" name="public_key" value="FLWPUBK-9dafbff5c68d96f73e373a6ae778316a-X" />
  <input type="hidden" name="customer[email]" value="jessepinkman@walterwhite.org" />
  <input type="hidden" name="customer[name]" value="Jesse Pinkman" />
  <input type="hidden" name="tx_ref" value="bitethtx-019203" />
  <input type="hidden" name="amount" value="500" />
  <input type="hidden" name="currency" value="UGX" />
  <input type="hidden" name="meta[token]" value="54" />
  <input type="hidden" name="redirect_url" value="index.php" />
  <button type="submit" id="start-payment-button">Pay Now</button>
</form>







</html>