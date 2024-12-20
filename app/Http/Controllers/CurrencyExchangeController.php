<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Client;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('exchange.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies =   Currency::with(['currencyAmount.user'])->get();
        $clients = Client::all();
        return view('exchange.form',compact('currencies','clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            return redirect()->back()->with('success', 'Currency added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
