@extends('layouts.app')

@section('content')
    <div class="row align-items-center my-2">
        <div class="col">
            <h2 class="page-title">Client Table</h2>    
        </div>
        <div class="col-auto">
            <a href="{{ route('client.create') }}" class="btn btn-info btn-sm"><span class="fe fe-plus fe-16 mr-3"></span>Add</a>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <!-- table -->
            <table class="display nowrap" style="width:100%" id="dataTable1">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Type</th>
                        <th scope="col">User added</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $index => $client)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->type }}</td>
                            <td>{{ $client->user?->name }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUser"><span class="fe fe-edit"></span></button>
                                <button id='1' class="btn btn-danger btndelete"><span class="fe fe-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete"></span></button>
                                <button class="btn btn-info btn-sm show-client" 
                                        data-id="{{ $client->id }}" 
                                        data-name="{{ $client->name }}" 
                                        data-email="{{ $client->email }}" 
                                        data-phone="{{ $client->phone }}" 
                                        data-address="{{ $client->address }}" 
                                        data-type="{{ $client->type }}" 
                                        data-user="{{ $client->user?->name }}" 
                                        data-picture="{{ $client->picture }}">
                                    Show
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No clients found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Show client modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Added modal-lg class -->
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0 mr-2">
                            <img id="clientPicture" src=""
                                alt="Client Picture" class="img-fluid" style="width: 180px; border-radius: 10px;">
                        </div>
                        <div class="flex-grow-1 ms-3 ml-4 mt-2">
                            <h5 class="mb-1" id="clientName">Danny McLoan</h5>
                            <p class="mb-2 pb-1" id="clientType">Senior Journalist</p>
                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                <div>
                                    <p class="small text-muted mb-1">Email</p>
                                    <p class="mb-0" id="clientEmail">danny.mcloan@example.com</p>
                                </div>
                                <div class="px-3">
                                    <p class="small text-muted mb-1">Phone</p>
                                    <p class="mb-0" id="clientPhone">0750-123-45-67</p>
                                </div>
                                <div>
                                    <p class="small text-muted mb-1">Address</p>
                                    <p class="mb-0" id="clientAddress">123 Main St</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit client modal -->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">Edit Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="form-group">
                            <label for="clientType">Client Type</label>
                            <select class="form-control select2" id="clientType" name="type">
                                <option value="Person">Person</option>
                                <option value="Merchant">Merchant</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fullName" class="col-form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name" placeholder="Add Reason">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber" class="col-form-label">Phone Number</label>
                            <input type="phone" class="form-control" id="phoneNumber" name="phone" placeholder="0750-123-45-67">
                        </div>
                        <div class="form-group">
                            <label for="location" class="col-form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="address" placeholder="Add Reason">
                        </div>
                        <div class="form-group mb-3">
                            <label for="picture">Logo/Picture</label>
                            <input type="file" id="picture" name="picture" class="form-control-file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button id="addEmployer" type="button" class="btn mb-2 btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap JS (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('button')
    <script src='js/select2.min.js'></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/inputMask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

            $('.drgpicker').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                showDropdowns: true,
                locale: {
                    format: 'MM/DD/YYYY'
                }
            });

            $('.select2').select2({
                theme: 'bootstrap4',
            });

            Inputmask("9999-999-99-99").mask("#phoneNumber");
        });
    </script>
    <script>
        $(document).ready(function() {
            // Attach click event to "Show" buttons
            $('.show-client').on('click', function() {
                // Retrieve data attributes
                var clientId = $(this).data('id');
                var clientName = $(this).data('name');
                var clientEmail = $(this).data('email');
                var clientPhone = $(this).data('phone');
                var clientAddress = $(this).data('address');
                var clientType = $(this).data('type');
                var clientUser = $(this).data('user');
                var clientPicture = $(this).data('picture');
    
                // Populate modal fields
                $('#clientPicture').attr('src', clientPicture);
                $('#clientName').text(clientName);
                $('#clientType').text(clientType);
                $('#clientEmail').text(clientEmail);
                $('#clientPhone').text(clientPhone);
                $('#clientAddress').text(clientAddress);
    
                // Show the modal
                $('#profileModal').modal('show');
            });
        });
    </script>
@endsection