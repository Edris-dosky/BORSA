@extends('layouts.app')
@php
    function percentageDifference($num1, $num2) {
        $data = [];
        
        if (empty($num1) || empty($num2) || $num1 == 0 || $num2 == 0) {
            $data = '- 03 %'; 
        } elseif ($num1 == $num2) {
            $data = '<i class="fa fa-minus" ></i> r0 %'; 
        } else {
            $difference = ($num1 - $num2);
            $difference2 = abs($difference);
            $average = ($num1 + $num2) / 2;
            $percentage = intval(($difference2 / $average) * 100);
            
            // Check if the difference is positive or negative
            if ($difference > 0) {
                $data = '<span class="fe fe-arrow-up fe-12 text-success"></span>'.$percentage .'%';
            } elseif ($difference < 0) {
                $data = '<span class="fe fe-arrow-down fe-12 text-danger"></span>'.$percentage .'%';
            }
        }

        return $data;
    }
@endphp

@section('content')
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="mb-2 page-title">Table Currency <i class="fe fe-dollar-sign"></i></h2>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-primary" id="openModal" data-toggle="modal" data-target=".add-currency">Add <i class="fe fe-plus"></i></button>
                        </div>
                    </div>
                    <div class="row my-4">
                        @foreach($currency_value as $index => $currency)
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted mb-1">100$ = </small>
                                            <h3 class="card-title mb-0">{{ $currency->currencyAmount->last()?->amount ?? 'Null' }}</h3>
                                               @if($currency->currencyAmount->count() > 1)
                                                @php
                                                    $result = percentageDifference($currency->currencyAmount->last()->amount, $currency->currencyAmount->reverse()->skip(1)->first()->amount);
                                                @endphp
                                                {!! $result !!}
                                            @else
                                                <i class="fa fa-minus"></i> 0%
                                            @endif
                                            <td>{{ $currency->currencyAmount->last()?->updated_at?->diffForHumans() ?? '-' }}</span></p>
                                        </div>
                                        <div class="col-4 text-right">
                                            <h3>{{$currency->currency}}</i></h3>
                                        </div>
                                    </div> <!-- /. row -->
                                </div> <!-- /. card-body -->
                            </div> <!-- /. card -->
                        </div> <!-- /. col -->
                    @endforeach
                    </div> <!-- end section -->
                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                               
                                                <th>Currency</th>
                                                <th>Last Price</th>
                                                <th>User added</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($currency_value as $index => $currency)
                                            <tr data-id="{{ $currency->id }}">
                                                <td class="currency-index">{{ $index+1 }}</td>
                                                <td class="currency-name">{{ $currency->currency }}</td>
                                                <td class="currency-amount">{{ $currency->currencyAmount->last()->amount }}</td>
                                                <td class="currency-user">{{ $currency->currencyAmount->last()->user->name }}</td>
                                                <td class="currency-created-at">{{ $currency->currencyAmount->last()->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <button 
                                                        class="btn btn-success view-btn" 
                                                        data-id="{{ $currency->id }}" 
                                                        data-toggle="modal" 
                                                        data-target="#viewPriceModal">
                                                        <i class="fe fe-eye"></i>
                                                    </button>
                                                    <button class="btn btn-warning edit-btn" 
                                                        data-id="{{ $currency->id }}" 
                                                        data-currency="{{ $currency->currency }}" 
                                                        data-amount="{{ $currency->currencyAmount->last()?->amount }}">
                                                        <i class="fe fe-edit"></i>
                                                    </button>                                                    
                                                    <button class="btn btn-danger"                                                        
                                                        data-id="{{ $currency->id }}" 
                                                        data-url="{{ route('currency.destroy', $currency->id) }}">
                                                        <i class="fe fe-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {!! $currency_value->links('pagination::bootstrap-4') !!}
                                </div>
                            </div>
                        </div> <!-- simple table -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->


   ⁡⁢⁣⁢<!-- Add Currency Modal -->⁡
<div id="currencyModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Currency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



⁡⁢⁣⁢<!-- Edit Currency Modal -->⁡
<div class="modal fade" id="currencyModalEdit" tabindex="-1" role="dialog" aria-labelledby="currencyModalEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="currencyModalEditLabel">Edit Currency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="currencyForm" action="{{ route('currency.update', ':id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="currencyId" name="currencyId">
                
                    <!-- Currency Input -->
                    <div class="form-group">
                        <label for="currencyEdit">Currency</label>
                        <input type="text" name="currency" id="currencyEdit" placeholder="Currency" class="form-control" />
                        @error('currency')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Amount Input -->
                    <div class="form-group">
                        <label for="amountEdit">Value</label>
                        <input type="number" name="amount" id="amountEdit" placeholder="Value" class="form-control" />
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
                <button type="submit" form="currencyForm" class="btn btn-warning">Update</button>
            </div>
            
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


  
⁡⁢⁣⁢<!-- View Price Modal -->⁡
<div class="modal fade" id="viewPriceModal" tabindex="-1" role="dialog" aria-labelledby="viewPriceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPriceModalLabel">User Information</h5>
                <button type="button" class="close close_close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Table inside the modal -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Before</th>
                            <th>Added By</th>
                        </tr>
                    </thead>
                    <tbody id="userDetailsTable">
                        <!-- Data will be populated here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_close" >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>


<!-- data table button -->
<script>
    // Add Currency Modal
    document.getElementById('openModal').addEventListener('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('currencyModalAdd'));
        myModal.show();
    });
    
  $('#dataTable-1').DataTable({
    "language": {
      "info": "", // Removes "Showing 1 to 3 of 3 entries" text
      "paging": false, // Disables pagination
      "lengthChange": false // Disables the page length change dropdown
    },
    "pagingType": "", // You can also use "simple" or "full" for different types, or remove it entirely
    "searching": true, // Optional: Removes the search box
    layout: {
      topStart: {
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
      }
    }
  });
</script>

{{-- view modal --}}
<script>
    // Variable to store the button that opened the modal
let triggeredButton = null;

// Listen for click on "View" button
document.querySelectorAll('.view-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Save the button that triggered the modal
        triggeredButton = this;

        const currencyId = this.getAttribute('data-id');

        // Generate the dynamic URL to fetch data
        const url = `{{ route('currency.show', ':id') }}`.replace(':id', currencyId);

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                console.log(response); // Log the response to check the structure

                if (response.error) {
                    alert(response.error);
                    return;
                }

                const currencyValue = response.currency_value;
                const currencyType = response.currency_type;
                const userDetailsTable = document.getElementById('userDetailsTable');
                const viewPriceModalLabel = document.getElementById('viewPriceModalLabel');
                
                // Clear the table body before adding new rows
                userDetailsTable.innerHTML = '';
                viewPriceModalLabel.innerHTML = `${currencyType.currency}`;
                // Check if currencyValue is an array and has data
                if (Array.isArray(currencyValue) && currencyValue.length > 0) {
                    currencyValue.forEach(item => {
                        const row = document.createElement('tr');
                        // Format created_at date
                        const createdAt = new Date(item.created_at).toLocaleString();

                        row.innerHTML = `
                            <td>${item.amount}</td>
                            <td>${createdAt}</td>
                            <td>${createdAt ? moment(item.created_at).fromNow() : '-'}</td>
                            <td>${item.user.name}</td>
                        `;
                        userDetailsTable.appendChild(row);
                    });
                } else {
                    userDetailsTable.innerHTML = '<tr><td colspan="4">No data available</td></tr>';
                }

                // Open the modal using Bootstrap's JavaScript API
                $('#viewPriceModal').modal('show');
            },
            error: function(error) {
                console.error('Error fetching data:', error);
                alert('Failed to fetch data. Please try again later.');
            }
        });
    });
});
</script>

{{-- edit modal --}}
<script>
   // Listen for click on "Edit" button
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        const currencyId = this.getAttribute('data-id');
        const currencyName = this.getAttribute('data-currency');
        const currencyAmount = this.getAttribute('data-amount');

        // Set the form action to update (PUT)
        const formActionUrl = "{{ route('currency.update', ':id') }}".replace(':id', currencyId);
        document.getElementById('currencyForm').action = formActionUrl;

        // Populate the modal with the current values
        document.getElementById('currencyEdit').value = currencyName;
        document.getElementById('amountEdit').value = currencyAmount;
        document.getElementById('currencyId').value = currencyId;

        // Show the modal
        $('#currencyModalEdit').modal('show');
    });
});

// Listen for form submission inside the Edit Modal
document.getElementById('currencyForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);

    // Send an AJAX request to update the currency
    const url = this.action; // URL from the form action
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Find the corresponding row in the table
            const row = document.querySelector(`tr[data-id="${response.currency_id}"]`);
            
            // Update the row with the new data
            row.querySelector('.currency-name').textContent = response.currency;
            row.querySelector('.currency-amount').textContent = response.amount;
            row.querySelector('.currency-user').textContent = response.user_name;
            row.querySelector('.currency-created-at').textContent = response.created_at ? moment(response.created_at).fromNow() : '-';

            // Close the modal
            $('#currencyModalEdit').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error('Update failed:', error);
        }
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Listen for click on the delete button
document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function() {
        const currencyId = this.getAttribute('data-id');
        const deleteUrl = this.getAttribute('data-url');

        // SweetAlert2 confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, send the delete request
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Success, remove the row or update the UI accordingly
                        Swal.fire(
                            'Deleted!',
                            'The currency has been deleted.',
                            'success'
                        ).then(() => {
                            // Optionally, you can remove the row from the table
                            // Find and remove the row containing the deleted currency
                            const row = button.closest('tr');
                            row.remove();
                        });
                    } else {
                        // Handle error
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the currency.',
                            'error'
                        );
                    }
                })
                .catch(err => {
                    // Handle error in case of a failed request
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the currency.',
                        'error'
                    );
                });
            }
        });
    });
});

</script>
@endsection