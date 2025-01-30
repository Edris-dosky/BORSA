<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\CurrencyAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {   
    
        $currency_value =   Currency::with(['currencyAmount.user', 'users'])->latest()->paginate(10);
       return view('currency', compact('currency_value'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'amount' => 'nullable|numeric|min:0',
        ]);
        $lastRow =Auth::user()->userCurrencies()->create($request->validate(
            [
                'currency' => 'required|string|max:255',
            ]
        ));
        if ($validatedData['amount']) {
            Auth::user()->currencyAmounts()->create([
                'currency_id' => $lastRow->id, // Associate with the newly created currency
                'amount' => $validatedData['amount'],
            ]);
        }
         return redirect()->back()->with('success', 'Currency added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currency_type = Currency::findOrFail($id);
        $currency_value = CurrencyAmount::with(['user'])->where('currency_id', $id)->latest()->get();
    
        if ($currency_value->isEmpty()) {
            return response()->json(['error' => 'Currency value not found'], 404);
        }
    
        return response()->json([
            'currency_value' => $currency_value,
            'currency_type' => $currency_type
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $currency = Currency::findOrFail($id);
    
        // Validate the input
        $validated = $request->validate([
            'currency' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);
    
        // Update the currency
        $currency->currency = $validated['currency'];
        $currency->save();
    
        // Create a new currency amount entry if the amount has changed
        $last_amount = CurrencyAmount::where('currency_id', $id)->latest()->first();
        if ($last_amount && $last_amount->amount != $validated['amount']) {
            $currency->currencyAmount()->create([
                'amount' => $validated['amount'],
                'user_id' => auth()->id(), // Assuming you're tracking which user made the update
            ]);
        }
    
        // Fetch the latest data after update
        $updatedCurrency = Currency::find($id);
        $updatedCurrencyAmount = CurrencyAmount::where('currency_id', $id)->latest()->first();
    
        return response()->json([
            'currency_id' => $updatedCurrency->id,
            'currency' => $updatedCurrency->currency,
            'amount' => $updatedCurrencyAmount->amount,
            'created_at' => $updatedCurrencyAmount->created_at->toDateTimeString(),
            'user_name' => $updatedCurrencyAmount->user->name, // Assuming the relationship exists
        ]);
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $currency = Currency::findOrFail($id);
            $currency->delete();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
