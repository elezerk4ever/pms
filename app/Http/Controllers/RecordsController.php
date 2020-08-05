<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Transaction;

class RecordsController extends Controller
{
    public function index(){}
    
    public function store(Request $request,Transaction $transaction){
        $data = $this->validate($request,[
            'amount'=>'required',
            'details'=>''
        ]);
        if($data['amount'] <= 0) return back();
        $transaction->records()->create($data);

        return back()->withSuccess('Done!');
    }
}
