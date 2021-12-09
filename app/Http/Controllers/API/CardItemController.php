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

class CardItemController extends BaseController {
    
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
        $card = Card::where('user_id', '=',  $user->id)-> first();
        if(!$product) {
            return $this->sendError('Product not found!');
        }
        $checkIsExist = DB::table('card_items')->where('product_id', '=', $product->id)->where('card_id', '=', $card->id)->first();
        if($checkIsExist) {
            $value = ['quantity' => (int)$input['quantity'] + $checkIsExist->quantity];
            DB::table('card_items')->where('product_id', '=', $product->id)->where('card_id', '=', $card->id)->update($value);
            return Response() -> json($value);
        }
        $value = ['card_id' => $card->id, 'product_id' => $product->id, 'quantity' => (int)$input['quantity']];
        $cardItem = DB::table('card_items')->insert($value);
        if($cardItem) {
            return Response() -> json($value);
        }
        return $this->sendError('Cannot add product to card!', $validator->errors());
    }
}