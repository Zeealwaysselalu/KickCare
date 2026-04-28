<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletController extends Controller
{

    public function index(){
        $outlet = Auth::user()->outlet;
        dd($outlet);
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
