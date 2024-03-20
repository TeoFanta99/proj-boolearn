<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Rules\ValidSponsorship;
use Illuminate\Http\Request;
use App\Http\Requests\Order\OrderRequest;

use Braintree\Gateway;

class SponsorshipController extends Controller
{
    public function index(Request $request){
        $products = Sponsorship::all();
        return $products->toArray();
    }
    public function generate(Request $request, Gateway $gateway)
    {
        $data = [
            'success' => true,
            'token' => $gateway->clientToken()->generate(),
        ];
        // dd($gateway->clientToken()->generate());
        return response()->json([$data]);
        // return 'generate, 200';
    }
    public function makePayments(OrderRequest $request, Gateway $gateway)
    {

        

        

        $product = Sponsorship::find($request->product);
        $data = [
            'success' => true,
            'token' => $gateway->clientToken()->generate(),
        ];
        $result = $gateway->transaction()->sale([
            'amount' => $product->price,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $data = [
                'success' => true,
                'message' => "Transazione eseguita con Successo!"
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => "Transazione Fallita!!"
            ];
            return response()->json($data, 401);
        }
    }
}
