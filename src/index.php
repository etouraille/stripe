<?php ?>
<html>
<head>
    <title>Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <style>
        .item-input-bank-card {
            width: 30%;
        }
    </style>
</head>
<body>
<div>
    <form id="payment-form">
        <div class="item-input-bank-card">
            <div id="card-element"></div>
        </div>
            <!-- Elements will create input elements here -->
        </div>

        <!-- We'll put the error messages in this element -->
        <div id="card-errors" role="alert"></div>

        <button id="submit">Submit Payment</button>
    </form>
</div>
<script type="text/javascript">
var stripe = Stripe('pk_test_51IFxhyIeSdECPKMuO7nyCyldB8hhiM8m2l9KeINPCuBpPdIi9OOKyY2y8KbUtYQd3NCFcjVKmS9smbSCUcbq4hWi00CMYKXvm1');
let clientSecret
var response = fetch('/secret.php').then(function(response) {
    return response.json();
}).then(function(responseJson) {
    clientSecret = responseJson.client_secret;
    console.log(clientSecret);
    // Render the form to collect payment details, then
    // call stripe.confirmCardPayment() with the client secret.
});
var elements = stripe.elements();
var style = {
    base: {
        color: "#32325d",
    }
};
let card
    card = elements.create("card", { style: style });
    card.mount("#card-element");
var form = document.getElementById('payment-form');

form.addEventListener('submit', function(ev) {
    ev.preventDefault();
    // If the client secret was rendered server-side as a data-secret attribute
    // on the <form> element, you can retrieve it here by calling `form.dataset.secret`
    stripe.confirmCardPayment(clientSecret, {
        payment_method: {
            card: card,
        }
    }).then(function(result) {
        if (result.error) {
            // Show error to your customer (e.g., insufficient funds)
            console.log(result.error.message);
        } else {
            // The payment has been processed!
            if (result.paymentIntent.status === 'succeeded') {
                // Show a success message to your customer
                // There's a risk of the customer closing the window before callback
                // execution. Set up a webhook or plugin to listen for the
                // payment_intent.succeeded event that handles any business critical
                // post-payment actions.
            }
        }
    });
});
</script>
</body>

