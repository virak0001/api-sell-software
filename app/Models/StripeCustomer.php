<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stripe\Stripe;
use Illuminate\Http\Request;
class StripeCustomer extends Model
{
    use HasFactory;

    public function createCard(Request $request,$customer)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
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

    public static function createCustomer(Request $request, $user)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $input = $request->all();
        $customer = \Stripe\Customer::create(array(
            'email'   => $user->email,
            'source'  => $input["token_id"],
            'name'   => $user->name,
            'address'  => array(
                'line1'   => 'Need implement',
                'postal_code' => 'Need implement',
                'city'   => 'Need implement',
                'state'   => 'Need implement',
                'country'  => 'Cambodia'
            )
            ));
        return $customer;
    }
}
