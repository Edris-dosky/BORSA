@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">Transaction Form</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('exchange.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount">
                    </div>
                    <div class="col-md-6">
                        <label for="from" class="form-label">From</label>
                        <select class="form-select" id="from" name="from">
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}" data-rate="{{ $currency->currencyAmount?->last()->amount }}">
                                    {{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="to" class="form-label">To</label>
                        <select class="form-select" id="to" name="to">
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}" data-rate="{{ $currency->currencyAmount?->last()->amount }}">
                                    {{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="client_id" class="form-label">Client ID</label>
                        <select class="form-select" id="client_id" name="client_id">
                            <option value="1" selected>Unknown</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <select class="form-select" id="phone" name="phone">
                            <option value="1" selected>Unknown</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->phone }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="fees" class="form-label">Fees</label>
                        <input type="number" class="form-control" id="fees" name="fees" placeholder="Enter fees">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="constraint" class="form-label">Fees Percentage %</label>
                        <input type="text" class="form-control" id="constraint" name="constraint" placeholder="Enter constraint">
                    </div>
                    <div class="col-md-6">
                        <label for="pay_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="pay_method" name="pay_method">
                            <option selected>Choose...</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option selected>Choose...</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="Price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="Price" placeholder="Enter total" readonly>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total" name="tottal" placeholder="Enter total" readonly>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
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
    const priceInput = document.getElementById('Price');
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
