<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentController;
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

Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::resource('invoices', InvoiceController::class, ['except' => ['create', 'edit']]);

Route::middleware('auth:api')->group(function () {
    Route::post('payments/pay/invoice', [PaymentController::class, 'payInvoice']);
    Route::get('history/payment', [HistoryController::class, 'getUserPaymentHistory']);
});
