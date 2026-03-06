<?php

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    if ($role == 'admin') {
        return view('role.admin.dashboard');
    }
    if ($role == 'kasir') {
        return view('role.cashier.dashboard');
    }
    return view('role.user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/bar', function () {
    return view('testbarcode');
});

Route::get('/send', function () {
    Mail::to("aaaaa@gmail.com")->send(new InvoiceMail());
});
