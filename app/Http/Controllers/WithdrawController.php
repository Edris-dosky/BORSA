<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        
        $data = Withdraw::with(['users','amounts','clients','currencies'])->get();
        return view('transaction.withdraw',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $clients = Client::all();
        $currencies = Currency::all();
        return view('transaction.form', compact('currencies', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $amount = Amount::create($request->validate(
            [
                "currency_id" => "required|numeric",
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
                    "client_id" => "required|numeric",
                ]
                );
            Auth::user()->withdraw_user()->create([
                'amount_id' => $amount->id, // Associate with the newly created currency
                'client_id' => $validation_data['client_id'],
            ]);
            return redirect()->back()->with('success', value: 'Currency added successfully!');
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
        $data = Withdraw::findOrFail($id);
        $clients = Client::all();
        $currencies = Currency::all();
        return view('transaction.form', compact('data', 'currencies', 'clients'));

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
