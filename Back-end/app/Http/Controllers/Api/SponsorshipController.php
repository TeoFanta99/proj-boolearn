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
    public function index(Request $request)
    {
        $products = Sponsorship::all();
        $teacher = Teacher::find($request->teacher_id);
        return view('pages.sponsor', compact('products', 'teacher'));
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

        // Recupera la sponsorizzazione associata all'insegnante

        // Recupera la data di scadenza esistente
        $existingSponsorship = $teacher->sponsorships()->first();

        $sponsorship = Sponsorship::findOrFail($request->sponsorship_id);

        if ($existingSponsorship) {
            // Recupera la data di scadenza esistente
            $existingExpireDate = $existingSponsorship->pivot->expire_date;
            $existingExpireDate = Carbon::parse($existingExpireDate);

            // Ottieni la durata della nuova sponsorizzazione
            $durationString = $sponsorship->duration;
            sscanf($durationString, '%d:%d:%d', $hours, $minutes, $seconds);

            // Calcola la data di inizio della nuova sponsorizzazione
            $start_date = Carbon::now();

            if ($existingExpireDate > $start_date) {
                // Se c'è una sponsorizzazione attiva, la nuova sponsorizzazione inizia subito dopo la scadenza della sponsorizzazione attiva
                $start_date = $existingExpireDate;
            }

            // Calcola la nuova data di scadenza
            $expire_date = $start_date->copy()->addHours($hours)->addMinutes($minutes)->addSeconds($seconds);

            // Aggiorna la sponsorizzazione dell'insegnante con la nuova data di scadenza
            $teacher->sponsorships()->attach($sponsorship, [
                'start_date' => $start_date,
                'expire_date' => $expire_date
            ]);
        } else {
            // Se non ci sono sponsorizzazioni attive, la nuova sponsorizzazione inizia immediatamente
            $start_date = Carbon::now();

            // Ottieni la durata della nuova sponsorizzazione
            $durationString = $sponsorship->duration;
            sscanf($durationString, '%d:%d:%d', $hours, $minutes, $seconds);

            // Calcola la nuova data di scadenza
            $expire_date = $start_date->copy()->addHours($hours)->addMinutes($minutes)->addSeconds($seconds);

            // Aggiungi la nuova sponsorizzazione
            $teacher->sponsorships()->attach($sponsorship, [
                'start_date' => $start_date,
                'expire_date' => $expire_date
            ]);
        }

        // Ritorna una risposta di successo
        return response()->json(['success' => true, 'message' => 'Sponsorizzazione associata all\'insegnante con successo'], 200);


    }
}
