<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\StripeCustomer;
use App\Models\User;
use Stripe\Stripe;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Stripe\Customer as StripeCustomers;
use App\Models\Card;
use Illuminate\Support\Collection;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth()->user();
        $page = $request->has('page') ? $request->get('page') : 0;
        $limit = $request->has('limit') ? $request->get('limit') : 15;
        $order_item = DB::table('order_items')
        ->select(
            'order_item_name',
            'order_item_quantity',
            'order_item_price',
        )
        ->skip($page)
        ->take($limit)
        ->where('user_id', '=', $user->id)
        ->get();

        $transform = $order_item->map(function ($data) {
            return [
                "name" => $data->order_item_name,
                "price" => $data->order_item_quantity,
                "description" => $data->order_item_price,
                "subTotalPrice" => $data->order_item_quantity * $data->order_item_price,
            ];
        });
        return response()->json(['data' => $transform, 'page' => $page, 'limit' => $limit]);
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

        $employee_id = Auth::user()->employee_id;
        $token_id = Auth::user()->token_id;
        // if(!is_null($employee_id)) {
            $customer = StripeCustomer::createCustomer($request, $user);
            $userUpdate = User::find(Auth()->user()->id);
            $userUpdate -> customer_id = $customer->id;
            $userUpdate -> token_id = $input['token_id'];
            $userUpdate -> save();
            $employee_id = $customer->id;
            $token_id = $input['token_id'];
        // };
        $order_number = rand(100000, 999999);

        // $retrieve = \Stripe\Customer::retrieve($employee_id, []);

        $card = Card::where('user_id', '=',  $user->id)->first();
        $order_item = DB::table('card_items')
        ->leftJoin('products', 'card_items.product_id', '=', 'products.id')
        ->leftJoin('cards', 'card_items.card_id', '=', 'cards.id')
        ->select(
            'products.name',
                'products.price',
                'products.description',
                'products.year',
                'products.model',
                'products.image_url',
                'card_items.quantity as quantity'
        )
        ->where('card_items.card_id', '=', $card->id)
        ->get();

        $amount = $order_item->map(function ($data) {
            return $data->quantity * $data->price;
        });
        $totalAmount = 0;
        foreach ($amount as $item) {
            $totalAmount = $item + $totalAmount;
        }
 
        $charge = \Stripe\Charge::create(array(
            'customer'  => $employee_id,
            'amount'  => 100,
            'currency'  => 'usd',
            // 'source' => $token_id,
            'description' => 'Testing mode',
            'metadata'  => array(
                'order_id'  => $order_number
            )
        ));
    
        $response = $charge->jsonSerialize();
        if($response['status'] == 'succeeded') {
            $value = [
                'order_number' => $order_number, 
                'order_total_amount' => $totalAmount, 
                'transaction_id' => $response['balance_transaction'],
                'order_status' => $response['status'],
                'email' => $user->email,
                'customer_name' => $user->name,
                'customer_address' => 'Cambodia',
                'customer_city' => 'Cambodia',
                'customer_pin' => 'Cambodia',
                'customer_state' => 'Cambodia',
                'customer_country' => 'Cambodia',
            ];
            $orders_table_id = DB::table('orders')->insertGetId($value);
            foreach ($order_item as $item) {
                $value = [
                    'order_id' => $orders_table_id, 
                    'order_item_name' => $item-> name,
                    'order_item_quantity' => $item-> quantity,
                    'order_item_price' => $item-> price,
                    'user_id' => $user-> id,
                ];
                DB::table('order_items')->insert($value);
            }
        }
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
