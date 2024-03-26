<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\SponsorshipController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => '/v1'], function(){
    
    // Route::get('login', [ApiController::class, 'VerifyCredit']);
    Route :: get('teachers', [ ApiController :: class, 'getTeachers']);

    //Route :: post('subject', [ ApiController :: class, 'getSubjects']);

    Route :: get('subject', [ ApiController :: class, 'test']);

    Route :: get('review', [ ApiController :: class, 'reviews']);

    Route :: post('result', [ ApiController :: class, 'results']);
    Route :: post('filtered', [ ApiController :: class, 'filtered']);

    Route :: post('hgs', [ ApiController :: class, 'frontTeachers']);


    //inserimento nuovo messaggio,recensione,votazione 
    Route :: post('message', [ApiController :: class, 'getMessage']);

    Route :: post('review', [ ApiController :: class, 'getReview']);

    Route :: post('rating', [ ApiController :: class, 'getRating']);
    

    Route::get('products',[SponsorshipController::class, 'index']);
    Route :: post('orders/generate', [ SponsorshipController :: class, 'generate'])->name('generate.token');
    Route :: post('orders/payment', [ SponsorshipController :: class, 'makePayments'])->name('make.payment');
    Route::post('/sponsorship-associate', [SponsorshipController::class, 'storeSponsorship'])
    ->name('save.sponsorship');
   
    // Route :: get('technologies', [ApiController :: class, 'getTechnologies']);

    // Route :: post('technologies', [ApiController :: class, 'createTechnologies']);


});