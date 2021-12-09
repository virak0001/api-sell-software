<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Stock as ResourcesStock;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\Stock;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
class StockController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
    * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $page = $request->has('page') ? $request->get('page') : 0;
        $limit = $request->has('limit') ? $request->get('limit') : 15;
        $products = DB::table('stocks')->whereNull('deleted_at')->skip($page)->take($limit)->get();
        return response()->json(['data' => $products, 'page' => $page, 'limit' => $limit]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'product_id' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $stock = Stock::create($input);
        return $this->sendResponse(new ResourcesStock($stock), 'Stock created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
