<?php
include 'vendor/autoload.php';
//secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey('sk_test_51IFxhyIeSdECPKMuRXGC7iuMYFp56RYef0N4gDR4LGxDyuln1VK0ZyOEwiLtyhZZ2SoDQijkANNhGJomtc6HTRpt00mglbZvZt');

$intent = \Stripe\PaymentIntent::retrieve(file_get_contents("intent.txt"));
($intent->capture(['amount_to_capture' => 750]));

echo json_encode([]);
