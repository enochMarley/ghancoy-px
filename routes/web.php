<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('filament.admin.auth.login');
});


// Print PDF of sales history
Route::get(
    "/print-history/{from}/{to}",
    [SaleController::class, 'printSaleHistory']
)->name('sales.print.history');


// Print PDF of credit history
Route::get(
    "/print-credit-history/{from}/{to}",
    [SaleController::class, 'printCreditHistory']
)->name('sales.print.credit-history');


// Print PDF for personnel credit
Route::get(
    "/print-personnel-credit",
    [SaleController::class, 'printPersonnelCredit']
)->name('sales.print.personnel-credit');
