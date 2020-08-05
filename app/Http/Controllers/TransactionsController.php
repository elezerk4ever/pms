<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Transaction;

class TransactionsController extends Controller
{
    function index(){}

    function create(){
        $users = User::where('id','!=',auth()->user()->id)->get();
        return view('transactions.create',compact('users'));
    }

    function store(Request $request){
        $data = $this->validate($request,[
            'name'=>'required',
            'to_id'=>'required'
        ]);
        
        auth()->user()->transactions()->create($data);
        return back()->withSuccess('Done!');
    }

    function show(Transaction $transaction){
        return view('transactions.show',compact('transaction'));
    }
}
