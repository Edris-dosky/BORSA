@extends('layouts.app')
@section('content')

<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h3 class="card-title col-6">withdraw Form {{ isset($data) ? "edit" : "add" }}</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('withdraw.index')}}" class="btn btn-info" >Table <i class="fe fe-grid fe-16"></i></a>
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
        <form action="{{ isset($data) ? route('withdraw.update', $data->id) : route('withdraw.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <!-- Amount Field -->
                    <div class="mb-4">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount" value="{{ isset($data) ? $data->amounts?->amount : old('amount')}}">
                    </div>
                    @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- From Currency Dropdown with Bootstrap Select -->
                <div class="form-group col-md-3">
                    <label for="from">Currency</label>
                    <select class="form-control select2" style="width: 100%;" id="from" name="currency_id">
                        <option selected="selected" disabled>Select Currency Type</option>
                        @foreach ($currencies as $currency)
                            <option value="{{$currency->id}}" data-rate="{{ $currency->currencyAmount?->last()->amount }}"
                                @if (isset($data) && $data->from == ($currency->currency .' : '. $currency->currencyAmount?->last()->amount))
                                selected="selected"
                                @elseif (old('from') == ($currency->currency .' : '. $currency->currencyAmount?->last()->amount))
                                selected="selected"
                            @endif
                                >
                                {{ $currency->currency . ':' . $currency->currencyAmount?->last()->amount }}
                            </option> 
                        @endforeach
                    </select>
                    @error('from')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                
                <!-- Client Dropdown with Bootstrap Select -->
                <div class="form-group col-md-3">
                    <label for="client_id">Client ID</label>
                    <select class="form-control select2" style="width: 100%;" id="client_id" name="client_id">
                        <option value="1" selected="selected" disabled>Unknown</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                @if (isset($data) && $data->clients->id == $client->id)
                                selected="selected"
                                @elseif (old('client_id') == $client->id)
                                    selected="selected"
                            @endif
                        >
                                {{ $client->name }} </option>
                        @endforeach
                    </select>
                    @error('client_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Dropdown with Bootstrap Select -->
                <div class="form-group col-md-3">
                    <label for="phone">Phone Number</label>
                    <select class="form-control select2" style="width: 100%;" id="phone" name="phone">
                        <option value="1" selected="selected" disabled>Unknown</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                @if (isset($data) && $data->clients->id == $client->id)
                                selected="selected"
                                @elseif (old('client_id') == $client->id)
                                    selected="selected"                                
                            @endif
                        >
                                {{ $client->phone }}</option>
                        @endforeach
                    </select>
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fees Field -->
                <div class="form-group col-md-3">
                    <div class="mb-4">
                        <label for="fees" class="form-label">Fees</label>
                        <input type="number" class="form-control" id="fees" name="fees" placeholder="Enter fees" value="{{ isset($data) ? $data->amounts?->fees : old('fees')}}">
                    </div>
                    @error('fees')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="constraint" class="form-label">Fees %</label>
                    <input type="text" class="form-control" id="constraint" name="constraint" placeholder="Enter constraint" value="{{ isset($data) ? $data->amounts?->constraint : old('constraint')}}">
                    @error('Constraint')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                

                <!-- Payment Method Dropdown -->
                <div class="col-md-6">
                    <label for="pay_method" class="form-label">Payment Method</label>
                    <select class="form-control select2" id="pay_method" name="pay_method">
                        <option selected>Choose...</option>
                        <option value="credit_card" {{ (( isset($data) && $data->amounts?->pay_method == "credit_card") || old('pay_method') == "credit_card") ? "selected" : ""}}>Credit Card</option>
                        <option value="paypal" {{ (( isset($data) && $data->amounts?->pay_method == "paypal" ) || old('pay_method') == "paypal") ? "selected" : ""}}>PayPal</option>
                        <option value="bank_transfer" {{ (( isset($data) && $data->amounts?->pay_method == "bank_transfer" ) || old('pay_method') == "bank_transfer") ? "selected" : ""}}}}>Bank Transfer</option>
                    </select>
                    @error('pay_method')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control select2" id="status" name="status">
                        <option selected>Choose...</option>
                        <option value="pending" {{ (( isset($data) && $data->amounts?->status == "pending") || old('status') == "pending") ? "selected" : ""}}>Pending</option>
                        <option value="completed" {{ (( isset($data) && $data->amounts?->status == "completed") || old('status') == "completed") ? "selected" : ""}} >Completed</option>
                        <option value="failed" {{ (( isset($data) && $data->amounts?->status == "failed") || old('status') == "failed") ? "selected" : ""}}>Failed</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Exchange Rate Field -->
                <div class="col-md-3">
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
