<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Rules\ValidSponsorship;
use Illuminate\Http\Request;
use App\Http\Requests\Order\OrderRequest;

use App\Models\Teacher;
use Carbon\Carbon;
use Braintree\Gateway;

class SponsorshipController extends Controller
{
    // Metodo per visualizzare i prodotti di sponsorizzazione e selezionare un insegnante
    public function index(Request $request)
    {
        $products = Sponsorship::all();
        $teacher = Teacher::find($request->teacher_id);
        return view('pages.sponsor', compact('products', 'teacher'));
    }

    // Metodo per la pagina di ringraziamento dopo l'acquisto della sponsorizzazione
    public function thanks(){
        return view('pages.sponsor_thanks');
    }

    // Metodo per generare un token di pagamento tramite Braintree
    public function generate(Request $request, Gateway $gateway)
    {
        $data = [
            'success' => true,
            'token' => $gateway->clientToken()->generate(),
        ];
        return response()->json([$data]);
    }

    // Metodo per effettuare il pagamento tramite Braintree
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

    // Metodo per associare una sponsorizzazione a un insegnante
    public function storeSponsorship(Request $request)
    {
        // Validazione dei dati in ingresso
        $validator = Validator::make($request->all(), [
            'sponsorship_id' => 'required|exists:sponsorships,id', // Verifica che l'ID della sponsorizzazione esista nella tabella delle sponsorizzazioni
            'teacher_id' => 'required|exists:teachers,id', // Verifica che l'ID dell'insegnante esista nella tabella degli insegnanti
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'ID non trovato'], 404);
        }
    
        $teacher = Teacher::findOrFail($request->teacher_id);
    
        // Recupera tutte le sponsorizzazioni attive dell'insegnante
        $activeSponsorships = $teacher->sponsorships()
            ->where('expire_date', '>', Carbon::now())
            ->get();
    
        // Trova la sponsorizzazione attiva con la data di scadenza più lontana
        $farthestExpiryDate = $activeSponsorships->max('pivot.expire_date');
    
        $sponsorship = Sponsorship::findOrFail($request->sponsorship_id);
    
        // Calcola la durata della nuova sponsorizzazione
        sscanf($sponsorship->duration, '%d:%d:%d', $hours, $minutes, $seconds);
        $newDurationInSeconds = $hours * 3600 + $minutes * 60 + $seconds;
    
        if ($farthestExpiryDate) {
            // La nuova sponsorizzazione inizia immediatamente dopo la scadenza della sponsorizzazione attiva più lontana
            $start_date = Carbon::parse($farthestExpiryDate)->addSeconds(1); // 1 secondo per garantire che inizi dopo la scadenza
        } else {
            // Se non ci sono sponsorizzazioni attive, la nuova sponsorizzazione inizia immediatamente
            $start_date = Carbon::now();
        }
    
        // Nuova data di scadenza
        $expire_date = $start_date->copy()->addSeconds($newDurationInSeconds);
    
        // Associazione della nuova sponsorizzazione all'insegnante
        $teacher->sponsorships()->attach($sponsorship, [
            'start_date' => $start_date,
            'expire_date' => $expire_date
        ]);
    
        // Ritorna una risposta di successo
        return response()->json(['success' => true, 'message' => 
        "Sponsorizzazione associata all'insegnante con successo"], 200);
    }
    }
