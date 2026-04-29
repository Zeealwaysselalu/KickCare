<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletController extends Controller
{

    public function index(){
        $allTransaction = Transaction::all()->findOrFail(Auth::user()->id);
        $allTransaction = $outlet->transactions;
        return view("profile.role.cashier.dashboard", compact($outlet, "outlet"));
    }

    public function create(){

    }
    public function store(Request $request){

    }

    public function show($id){

    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }


}
