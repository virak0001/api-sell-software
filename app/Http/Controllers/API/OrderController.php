<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\StripeCustomer;
use Stripe\Stripe;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user = Auth::user();
        // $customer_id = $user->get('customer_id');
        // $customer;
        // if(!$customer_id) {
        //     $custmer = StripeCustomer::createCustomer($request, $user);
        // }
        // $order_number = rand(100000, 999999);
        // StripeCustomer::createCustomer

        // $user = Auth()->user();
        // $charge = \Stripe\Charge::create(array(
        //     'customer'  => $customer->id,
        //     'amount'  => $request("total_amount"),
        //     'currency'  => $request("currency_code"),
        //     'description' => $request("item_details"),
        //     'metadata'  => array(
        //         'order_id'  => $order_number
        //     )
        // ));
        // print_r($user);
        // dd($user);
        // return response()->json(['data' => $user]);
        $input = $request->all();

        $user = Auth()->user();
        Stripe::setApiKey(env('STRIPE_SECRET'));

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

        $order_number = rand(100000, 999999);
 
        $charge = \Stripe\Charge::create(array(
            'customer'  => $customer->id,
            'amount'  => 100,
            'currency'  => 'usd',
            'description' => 'Testing mode',
            // 'source'  => $input["token_id"],
            'metadata'  => array(
                'order_id'  => $order_number
            )
        ));
    
        $response = $charge->jsonSerialize();
        return response()->json(['data' => $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
