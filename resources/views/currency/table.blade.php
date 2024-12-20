@extends('layouts.app')
@php
function percentageDifference($num1, $num2) {
    $data = [];
    
    if (empty($num1) || empty($num2) || $num1 == 0 || $num2 == 0) {
        $data = '<i class="fa fa-caret-left text-Violet-500"></i> 0 %'; 
    } elseif ($num1 == $num2) {
        $data = '<i class="fa fa-minus text-Violet-500"></i> 0 %';  
    } else {
        $difference = ($num1 - $num2);
        $difference2 = abs($difference);
        $average = ($num1 + $num2) / 2;
        $percentage = intval(($difference2 / $average) * 100);
        
        // Check if the difference is positive or negative
        if ($difference > 0) {
            $data = '<i class="fas fa-arrow-up text-emerald-500 mr-1"></i>'.$percentage .'%';
        } elseif ($difference < 0) {
            $data = '<i class="fas fa-arrow-down text-orange-500 mr-1"></i>'.$percentage .'%';
        }
    }

    return $data;
}
@endphp

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="py-4">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Currency Peer 100$</h3>
                <button id="openModal" class="btn btn-primary">Add Currency</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Currency</th>
                                <th>Last Price</th>
                                <th>Status</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($currency_value as $index => $currency)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $currency->currency }}</td>
                                <td>{{ $currency->currencyAmount->last()?->amount ?? 'Null' }}</td>
                                <td>
                                    @if($currency->currencyAmount->count() > 1)
                                        @php
                                            $result = percentageDifference($currency->currencyAmount->last()->amount, $currency->currencyAmount->reverse()->skip(1)->first()->amount);
                                        @endphp
                                        {!! $result !!}
                                    @else
                                        <i class="fa fa-minus"></i> 0%
                                    @endif
                                </td>
                                <td>{{ $currency->currencyAmount->last()?->created_at?->diffForHumans() ?? '-' }}</td>
                                <td>
                                    <a href="{{route('currency.show', $currency->id)}}" class="btn btn-info btn-sm ">Show</a>
                                    <button 
                                        class="btn btn-warning btn-sm edit-btn" 
                                        data-id="{{ $currency->id }}" 
                                        data-currency="{{ $currency->currency }}" 
                                        data-amount="{{ $currency->currencyAmount->last()?->amount }}">
                                        Edit
                                    </button>
                                    <button 
                                        class="btn btn-danger btn-sm delete-btn" 
                                        data-id="{{ $currency->id }}" 
                                        data-url="{{ route('currency.destroy', $currency->id) }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $currency_value->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Currency Modal -->
<div id="currencyModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Currency</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('currency.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <input type="text" name="currency" id="currency" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Currency</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Currency Modal -->
<div id="currencyModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Currency</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="currencyForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="currencyEdit" class="form-label">Currency</label>
                        <input type="text" name="currency" id="currencyEdit" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="amountEdit" class="form-label">Amount</label>
                        <input type="number" name="amount" id="amountEdit" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Add Currency Modal
    document.getElementById('openModal').addEventListener('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('currencyModalAdd'));
        myModal.show();
    });

    // Edit Currency Modal
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const currencyId = this.getAttribute('data-id');
            const currencyName = this.getAttribute('data-currency');
            const currencyAmount = this.getAttribute('data-amount');

            // Populate the form
            document.getElementById('currencyEdit').value = currencyName;
            document.getElementById('amountEdit').value = currencyAmount;

            // Update form action URL
            const formAction = "{{ route('currency.update', ':id') }}".replace(':id', currencyId);
            document.getElementById('currencyForm').action = formAction;

            // Show modal
            var myModal = new bootstrap.Modal(document.getElementById('currencyModalEdit'));
            myModal.show();
        });
    });

    // Delete Currency
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const currencyId = this.getAttribute('data-id');
            const deleteUrl = this.getAttribute('data-url');

            if (confirm('Are you sure you want to delete this currency?')) {
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Remove the table row
                        this.closest('tr').remove();
                        alert('Currency deleted successfully.');
                    } else {
                        alert('Failed to delete currency.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
</script>

@endsection
