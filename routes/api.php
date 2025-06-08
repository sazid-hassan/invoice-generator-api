<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;


Route::get('/', function (){
    return 'API';
});

Route::apiResource('invoices', InvoiceController::class);
