<?php

namespace App\Http\Controllers;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class StripeCheckoutController extends Controller
{
    public function create()
    {
        return view('checkout.create');
    }
    public function paymentIntent()
    {
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey('sk_test_51LcB2nGtXPLkwdHTa9ExPhKp9G7dFOulNyRPlusGeiAgPWcJSwKzIrcWvjAmEyzI7AqgLnItKx0jhm9LnNRZAHNW00pilgUOb6');


        header('Content-Type: application/json');

    try {
    // retrieve JSON from POST body
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);

    // Create a PaymentIntent with amount and currency
    $paymentIntent = \Stripe\paymentIntent::create([
        'amount' => (new CartRepository())->total(),
        'currency' => 'eur',
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
    ]);

    $output = [
        'clientSecret' => $paymentIntent->client_secret,
    ];

    echo json_encode($output);
    } catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    }

    }
}
