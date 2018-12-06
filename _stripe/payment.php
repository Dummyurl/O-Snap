<?php
require_once("lib/Stripe.php");

//Stripe::setApiKey('sk_test_rbSodBKRiRMCdfueLNMzCTtZ');
Stripe::setApiKey('sk_test_DPnYA26xq44GlpztDmeY6MdM');


//\Stripe\Stripe::setClientId(getenv('STRIPE_CLIENT_ID'));
//\Stripe\Stripe::setClientId(getenv('STRIPE_CLIENT_ID'));
//print_r($_REQUEST);
 $charge = Stripe_Charge::create(array(
  "amount" => 1500,
  "currency" => "usd",
  "source" => $_POST['stripeToken'],
  "description" => "Charge for Facebook Login code."
));


 print_r($charge);
?>
