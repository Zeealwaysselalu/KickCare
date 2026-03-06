<?php

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('role.user.dashboard');
});

Route::get('/dash', function () {
    return view('role.cashier.dashboard');
});

Route::get('/bar', function () {
    return view('testbarcode');
});

Route::get('/send', function () {
    Mail::to("aaaaa@gmail.com")->send(new InvoiceMail());
});
