<?php

include 'vendor/autoload.php';

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey('sk_test_51IFxhyIeSdECPKMuRXGC7iuMYFp56RYef0N4gDR4LGxDyuln1VK0ZyOEwiLtyhZZ2SoDQijkANNhGJomtc6HTRpt00mglbZvZt');

$intent = \Stripe\PaymentIntent::create([
    'amount' => 1099,
    'currency' => 'eur',
    // Verify your integration in this guide by including this parameter
    'metadata' => ['integration_check' => 'accept_a_payment'],
]);

echo json_encode(array('client_secret' => $intent->client_secret));
