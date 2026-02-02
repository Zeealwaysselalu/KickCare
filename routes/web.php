<?php

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bar', function () {
    return view('testbarcode');
});

Route::get('/send', function () {
    Mail::to("aaaaa@gmail.com")->send(new InvoiceMail());
});
