@extends('layouts.app')
@section('content')

<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h3 class="card-title col-6">Transaction Form</h3>
                @if (isset($id))
                    this is update form
                    @else
                    this is create form
                @endif
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('exchange.index')}}" class="btn btn-info" >Table <i class="fe fe-grid fe-16"></i></a>
            </div>
        </div>
      
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
        
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('exchange.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <!-- Amount Field -->
                    <div class="mb-4">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount">
                    </div>
                </div>

                <!-- From Currency Dropdown with Bootstrap Select -->
                <div class="form-group col-md-3">
                    <label for="from">From Currency</label>
                    <select class="form-control select2" style="width: 100%;" id="from" name="from">
                        <option selected="selected" disabled>Select Currency Type</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}" data-rate="{{ $currency->currencyAmount?->last()->amount }}">
                                {{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- To Currency Dropdown with Bootstrap Select -->
                <div class="form-group col-md-3 ">
                    <label for="to">To Currency</label>
                    <select class="form-control select2" style="width: 100%;" id="to" name="to">
                        <option selected="selected" disabled>Select Currency Type</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}" data-rate="{{ $currency->currencyAmount?->last()->amount }}">
                                {{ $currency->currency }} : {{ $currency->currencyAmount?->last()->amount }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Client Dropdown with Bootstrap Select -->
                <div class="form-group col-md-3">
                    <label for="client_id">Client ID</label>
                    <select class="form-control select2" style="width: 100%;" id="client_id" name="client_id">
                        <option value="1" selected="selected" disabled>Unknown</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Phone Dropdown with Bootstrap Select -->
                <div class="form-group col-md-3">
                    <label for="phone">Phone Number</label>
                    <select class="form-control select2" style="width: 100%;" id="phone" name="phone">
                        <option value="1" selected="selected" disabled>Unknown</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->phone }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Fees Field -->
                <div class="form-group col-md-3">
                    <div class="mb-4">
                        <label for="fees" class="form-label">Fees</label>
                        <input type="number" class="form-control" id="fees" name="fees" placeholder="Enter fees">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="constraint" class="form-label">Constraint</label>
                    <input type="text" class="form-control" id="constraint" name="constraint" placeholder="Enter constraint">
                </div>
                

                <!-- Payment Method Dropdown -->
                <div class="col-md-6">
                    <label for="pay_method" class="form-label">Payment Method</label>
                    <select class="form-control select2" id="pay_method" name="pay_method">
                        <option selected>Choose...</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control select2" id="status" name="status">
                        <option selected>Choose...</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>

                <!-- Exchange Rate Field -->
                <div class="col-md-6">
                    <label for="Price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" id="Price" placeholder="Enter total" readonly>
                </div>

                <!-- Total Field -->
                <div class="col-md-6">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control" id="total" name="tottal" placeholder="Enter total" readonly>
                </div>
            </div>
            <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <!-- Action Buttons -->
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary ">Submit</button>
            </div>
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
