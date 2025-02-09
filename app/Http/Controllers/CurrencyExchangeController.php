<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Client;
use App\Models\Currency;
use App\Models\CurrencyExchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyExchangeController extends Controller
{

    public function index()
    {   
        $data = CurrencyExchange::with(['users','amounts','clients'])->get();
        return view('exchange.index' , compact('data'));
    }


    public function create()
    {
        $currencies =   Currency::with(['currencyAmount.user'])->get();
        $clients = Client::all();
        return view('exchange.form',compact('currencies','clients'));
    }

    public function store(Request $request)
    {
    
        $amount = Amount::create($request->validate(
            [
                "currency_id" => "nullable",
                "amount" => "required|numeric",
                "fees" =>"nullable|numeric",
                "constraint" => "nullable|numeric",
                "tottal" => "required|numeric",	
                "pay_method" => "nullable|string",	
                "status" => "nullable|string",
            ]
            ));
            $validation_data = $request->validate(
                [
                    "client_id" => "nullable|numeric",
                    "price" => "required|numeric",
                    "from" => "nullable|string",
                    "to" => "nullable|string",
                ]
                );
            Auth::user()->exchanges_user()->create([
                'amount_id' => $amount->id, // Associate with the newly created currency
                'client_id' => $validation_data['client_id'],
                'price' => $validation_data['price'], 
                'from' => $validation_data['from'],
                'to' => $validation_data['to'],
            ]);
            return redirect()->back()->with('success', value: 'Currency added successfully!');
    }


    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        $currencies =   Currency::with(['currencyAmount.user'])->get();
        $clients = Client::all();
        return view('exchange.form',compact('currencies','clients' ,'id'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
