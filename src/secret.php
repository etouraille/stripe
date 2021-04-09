<?php
session_start();

include 'vendor/autoload.php';

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey('sk_test_51IFxhyIeSdECPKMuRXGC7iuMYFp56RYef0N4gDR4LGxDyuln1VK0ZyOEwiLtyhZZ2SoDQijkANNhGJomtc6HTRpt00mglbZvZt');

$intent = \Stripe\PaymentIntent::create([
    'amount' => 1199,
    'currency' => 'eur',
    'payment_method_types' => ['card'],
    'capture_method'=> 'manual',
]);

$_SESSION['intent_id'] = $intent->id;

echo json_encode(array('client_secret' => $intent->client_secret));
