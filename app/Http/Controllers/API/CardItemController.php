<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CardItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Card;
use Validator;
use Facade\FlareClient\Http\Response;
use Auth;

use function PHPSTORM_META\map;

class CardItemController extends BaseController
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
        $user = auth()->user();
        $card = Card::where('user_id', '=',  $user->id)->first();
        $cardItem = DB::table('card_items')
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
            ->skip($page)
            ->take($limit)
            ->where('card_items.card_id', '=', $card->id)
            ->get();
        $transform = $cardItem->map(function ($data) {
            return [
                "name" => $data->name,
                "price" => $data->price,
                "description" => $data->description,
                "year" => $data->year,
                "model" => $data->model,
                "quantity" => $data->quantity,
                "image_url" => $data->image_url,
                "subTotalPrice" => $data->quantity * $data->price,
            ];
        });
        return response()->json(['data' => $transform, 'page' => $page, 'limit' => $limit]);
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
            'quantity' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $productId = $input['product_id'];
        $product = Product::find($productId);
        $user = auth()->user();
        $card = Card::where('user_id', '=',  $user->id)->first();
        if (!$product) {
            return $this->sendError('Product not found!');
        }
        $checkIsExist = DB::table('card_items')->where('product_id', '=', $product->id)->where('card_id', '=', $card->id)->first();
        if ($checkIsExist) {
            $value = ['quantity' => (int)$input['quantity'] + $checkIsExist->quantity];
            DB::table('card_items')->where('product_id', '=', $product->id)->where('card_id', '=', $card->id)->update($value);
            return Response()->json($value);
        } else {
            $value = ['card_id' => $card->id, 'product_id' => $product->id, 'quantity' => (int)$input['quantity']];
            $cardItem = DB::table('card_items')->insert($value);
            if ($cardItem) {
                return Response()->json($value);
            }
        }
        return $this->sendError('Cannot add product to card!', $validator->errors());
    }
}
