<?php

require './../vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
 if(!empty($_POST['charity']) && !empty($_POST['currency'])  && !empty($_POST['donation']))
 {
    $paymentMethodType = [
        'gbp' => ['card'],
        'eur' => ['car', 'giropay', 'ideal']
    ];
    $post = filter_var_array($_POST, FILTER_SANITIZE_STRING);

     $stripe = new \Stripe\StripeClient('INSERT_YOUR_STRIPE_SECRET_KEY_HERE');
     $session = $stripe->checkout->sessions->create([
        'success_url' => 'http://localhost:8080/frontend/index.html?status=success',
        'cancel_url' => 'http://localhost:8080/frontend/index.html?status=failure',
        'mode' => 'payment',
        'submit_type' => 'donate',
        'payment_method_types'  => $paymentMethodType[$post['currency']],
        'line_items' => [
            [
                'quantity' => 1,
                'price_data' =>[
                    'currency' => $post['currency'],
                    'unit_amount' => $post['donation'],
                    'product_data' => [
                        'name' => $post['charity']
                    ]
                ]
            ]
        ]
        
     ]);

    echo $session->id;
 }


}




?>