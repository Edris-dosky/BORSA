@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-2xl font-semibold">Transaction Form</h2>
    <form action="{{ route('exchange.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="amount" placeholder="Enter amount">
            </div>
            <div class="flex gap-1">
                <div class="w-1/2">
                    <label for="from" class="block text-sm font-medium text-gray-700">From</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="from" name="from">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}" data-rate="{{ $currency->currencyAmount?->last()->amount }}">
                                {{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/2">
                    <label for="to" class="block text-sm font-medium text-gray-700">To</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="to" name="to">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}" data-rate="{{ $currency->currencyAmount?->last()->amount }}">
                                {{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex gap-1">
                <div class="w-1/2">
                    <label for="client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="client_id" name="client_id">
                       <option value="0" selected>Unknown</option>
                      @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/2">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="phone" name="phone">
                      <option value="0" selected>Unknown</option>
                      @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->phone }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex gap-1 w-full">
                <div class="w-1/2">
                    <label for="fees" class="block text-sm font-medium text-gray-700">Fees</label>
                    <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="fees" placeholder="Enter fees">
                </div>
                <div class="w-1/2">
                    <label for="constraint" class="block text-sm font-medium text-gray-700">Fees Percentage %</label>
                    <input type="number" step="1" min="0" max="100" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="constraint" placeholder="Enter constraint">
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex gap-1">
                <div class="w-1/2">
                    <label for="pay_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="pay_method" name="pay_method">
                        <option selected>Choose...</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="status" name="status">
                        <option selected>Choose...</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-1">
              <div class="w-1/2">
                <label for="Price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="Price" placeholder="Enter total" readonly>
            </div>
              <div class="w-1/2">
                  <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                  <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="total" placeholder="Enter total" readonly>
              </div>
             
          </div>
        </div>
        
        <button type="submit" class="mt-4 px-6 py-2 bg-indigo-500 text-white font-medium text-sm rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
    </form>
</div>

<script>
// Function to convert currency and update the total input field
function convertCurrency(amount, fromRate, toRate) {
    let amountInUSD = (amount / fromRate) * 100;
    let convertedAmount = (amountInUSD / 100) * toRate;
    return convertedAmount;
}

document.addEventListener('DOMContentLoaded', function () {
    const amountInput = document.getElementById('amount');
    const fromSelect = document.getElementById('from');
    const toSelect = document.getElementById('to');
    const totalInput = document.getElementById('total');
    const priceInput = document.getElementById('Price');  // New price input
    const clientSelect = document.getElementById('client_id');
    const phoneSelect = document.getElementById('phone');
    const feesInput = document.getElementById('fees');
    const constraintInput = document.getElementById('constraint');

    // Sync Client ID and Phone Number fields
    clientSelect.addEventListener('change', function () {
        const selectedClientId = this.value;
        const selectedClient = [...phoneSelect.options].find(option => option.value === selectedClientId);
        if (selectedClient) {
            phoneSelect.value = selectedClient.value;
        }
    });

    phoneSelect.addEventListener('change', function () {
        const selectedPhone = this.value;
        const selectedClient = [...clientSelect.options].find(option => option.value === selectedPhone);
        if (selectedClient) {
            clientSelect.value = selectedClient.value;
        }
    });

    // Add event listeners for when the user selects a currency or changes the amount
    amountInput.addEventListener('input', updateTotalAndSync);
    fromSelect.addEventListener('change', updateTotalAndSync);
    toSelect.addEventListener('change', updateTotalAndSync);
    feesInput.addEventListener('input', updateTotalAndSync);
    constraintInput.addEventListener('input', updateTotalAndSync);

    // Function to update the total, price, fees, and constraint
    function updateTotalAndSync() {
        const amount = parseFloat(amountInput.value);
        const fromOption = fromSelect.selectedOptions[0];
        const toOption = toSelect.selectedOptions[0];

        // Extract exchange rates from the selected options
        const fromRate = parseFloat(fromOption.getAttribute('data-rate'));
        const toRate = parseFloat(toOption.getAttribute('data-rate'));

        if (isNaN(amount) || isNaN(fromRate) || isNaN(toRate)) {
            totalInput.value = '';
            priceInput.value = '';  // Clear Price input if any value is invalid
            return;
        }

        // Get the converted total amount
        let total = convertCurrency(amount, fromRate, toRate);

        // Calculate and fill the "Price" input with the converted amount
        priceInput.value = total.toFixed(2); // "Price" will reflect the converted amount directly

        // Get current fees and constraint values
        let fees = parseFloat(feesInput.value) || 0;
        let constraint = parseFloat(constraintInput.value) || 0;

        // Sync Fees and Constraint
        if (fees > 0) {
            // Calculate and update constraint as a percentage based on fees
            constraintInput.value = ((fees / total) * 100).toFixed(2);
        } else if (constraint > 0) {
            // Calculate and update fees based on constraint percentage
            feesInput.value = ((total * constraint) / 100).toFixed(2);
        }

        // Apply the fee and constraint to calculate the final total
        total -= fees; // Subtract the fee
        total -= (total * (constraint / 100)); // Apply constraint as percentage reduction

        // Ensure total does not go below zero
        if (total < 0) total = 0;

        // Display the final total, formatted to two decimal places
        totalInput.value = total.toFixed(2);
    }

    // Initialize total value on page load
    updateTotalAndSync();
});
</script>
  
@endsection
