<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
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


 //get Contact
 Route::get('/getcontacts', [ContactController::class, 'getContacts']);
 //Save Contacts
 Route::post('/save_contact', [ContactController::class, 'saveContact']);
 //Delete Contacts
 Route::delete('/deleteContact/{id}', [ContactController::class, 'deleteContact']);
 //get Contacts details
 Route::get('/get_contact/{id}', [ContactController::class, 'getContact']);
 //update Contacts details
 Route::post('/update_contact/{id}', [ContactController::class, 'updateContact']);