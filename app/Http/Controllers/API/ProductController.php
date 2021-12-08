<?php

namespace App\Http\Controllers\API;

use App\Interfaces\Controllers\ProductControllerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Resources\Product as ProductResource;

class ProductController extends BaseController implements ProductControllerInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $page = $request->has('page') ? $request->get('page') : 0;
        $limit = $request->has('limit') ? $request->get('limit') : 1;
        $products = DB::table('products')->skip($page)->take($limit)->get();
        return response()->json(['data' => $products, 'page' => $page, 'limit' => $limit]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
//        $input = $request->all();
//
//        $validator = Validator::make($input, [
//            'name' => 'required',
//            'detail' => 'required'
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError('Validation Error.', $validator->errors());
//        }

//        $product->name = $input['name'];
//        $product->detail = $input['detail'];
//        $product->save();

//        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $product->delete();
        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
