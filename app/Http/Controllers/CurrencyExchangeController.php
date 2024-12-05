<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Currency;
use Illuminate\Http\Request;

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
        //
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
