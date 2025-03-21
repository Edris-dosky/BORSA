@extends('layouts.app')
@section('content')

<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h3 class="card-title col-6">Withdraw Form {{ isset($data) ? "edit" : "add" }}</h3>
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
                            <option value="{{ $client->id }} "
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
                            <option value="{{ $client->id }} "
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
                        <input type="text" class="form-control" id="fees" name="fees" placeholder="Enter fees" value="{{ isset($data) ? $data->amounts?->fees : old('fees')}}">
                    </div>
                    @error('fees')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Constraint Field -->
                <div class="form-group col-md-3">
                    <label for="constraint" class="form-label">Fees %</label>
                    <input type="number" class="form-control" id="constraint" name="constraint" placeholder="Enter constraint" min="0" max="100" value="{{ isset($data) ? $data->amounts?->constraint : old('constraint')}}">
                    @error('constraint')
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
                    <input type="number" name="price" class="form-control" id="Price" placeholder="Enter total" >
                </div>

                <!-- Total Field -->
                <div class="col-md-6">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control" id="total" name="total" placeholder="Enter total" >
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
document.addEventListener('DOMContentLoaded', function () {
    const clientSelect = document.getElementById('client_id');
    const phoneSelect = document.getElementById('phone');


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

 
});

</script>
@endsection
