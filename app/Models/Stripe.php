<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stripe;
class StripeModel extends Model
{
    use HasFactory;

    public function createCard(Request $request,$customer)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $response = \Stripe\Token::create(array(
            "customer" => $custome->get('id'),
            "card" => array(
              "number"    => $request->input('card_number'),
              "exp_month" => $request->input('exp_month'),
              "exp_year"  => $request->input('exp_year'),
              "cvc"       => $request->input('cvc'),
              "name"      => $request->input('first_name') . " " . $request->input('last_name')
          )));
    }

    public function createCustomer(Request $request, $user)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create(array(
            'email' =>  $request->input("email_address"),
            'source' =>  $request->input("token"),
            'name'  => $request->input("customer_name"),
            'address'  => array(
                'line1'  =>  $request->input("customer_address"),
                'postal_code' => $request->input("customer_pin"),
                'city'  =>  $request->input("customer_city"),
                'state'  =>  $request->input("customer_state"),
                'country'  => 'US'
            )
        ));
        return $customer;
    }
}
