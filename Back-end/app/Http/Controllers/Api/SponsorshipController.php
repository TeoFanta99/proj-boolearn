<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Rules\ValidSponsorship;
use Illuminate\Http\Request;
use App\Http\Requests\Order\OrderRequest;

use App\Models\Teacher;

use Braintree\Gateway;

class SponsorshipController extends Controller
{
    public function index(Request $request){
        $products = Sponsorship::all();
        $teacher = Teacher::find($request->teacher_id);
        return view('pages.sponsor',compact('products','teacher'));
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
                'verifyCard' => true,
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
    public function storeSponsorship(Request $request){
        try {
            // Validazione dei dati in ingresso
            $request->validate([
                'sponsorship_id' => 'required|exists:sponsorships,id', // Verifica che l'ID della sponsorizzazione esista nella tabella delle sponsorizzazioni
                'teacher_id' => 'required|exists:teachers,id', // Verifica che l'ID dell'insegnante esista nella tabella degli insegnanti
            ]);
            
            // Trova la sponsorizzazione tramite l'ID
            $sponsorship = Sponsorship::findOrFail($request->sponsorship_id);
            
            // Trova l'insegnante tramite l'ID
            $teacher = Teacher::findOrFail($request->teacher_id);
            
            // Associa la sponsorizzazione all'insegnante
            $teacher->sponsorships()->syncWithoutDetaching($sponsorship);
        
            // Ritorna una risposta di successo
            return response()->json(['success' => true, 'message' => 'Sponsorizzazione associata all\'insegnante con successo'], 200);
        }catch (\Exception $e) {
            // Gestisci eventuali eccezioni
            return response()->json(['success' => false, 'message' => 'Errore durante l\'associare la sponsorizzazione agli insegnanti'], 500);
        }

    }
}
