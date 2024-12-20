@extends('layouts.app')

@section('content')


                <div class="row align-items-center my-2">
                    <div class="col">
                        <h2 class="page-title">Client Table</h2>    
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventModal"><span class="fe fe-plus fe-16 mr-3"></span>Add</button>
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
                        <td>{{$index+1}}</td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->phone}}</td>
                        <td>{{$client->address}}</td>
                        <td>{{$client->type}}</td>
                        <td>{{$client->user?->name}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUser"><span class="fe fe-edit"></span></button>
                            <button id='1' class="btn btn-danger btndelete" ><span class="fe fe-trash" style="color:#ffffff" data-toggle="tooltip"  title="Delete"></span></button>
                            <a href="{{route('client.show',$client->id)}}" class="btn btn-info btn-sm">Show</a>
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


    <!-- Add client modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">Add Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="addClientForm" action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf        
                    <div class="form-group">
                        <label for="clientType">Client Type</label>
                        <select class="form-control select2" id="clientType" name="type">
                            <option value="Person">Person</option>
                            <option value="Merchant">Merchant</option>
                        </select>
                    </div> <!-- form-group -->
                    <div class="form-group">
                        <label for="fullName" class="col-form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="name" placeholder="Add Reason">
                    </div>
                         <!-- Email Field -->
                    <div class="form-group">
                    <label for="email" class="col-form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber" class="col-form-label">phone Number</label>
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
                    <div class="modal-footer d-flex justify-content-between">
                        <button id="add" type="submit" class="btn mb-2 btn-primary">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div> <!-- Add client modal -->

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
                </div> <!-- form-group -->
                <div class="form-group">
                    <label for="fullName" class="col-form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="name" placeholder="Add Reason">
                </div>
                     <!-- Email Field -->
                <div class="form-group">
                <label for="email" class="col-form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
                </div>
                <div class="form-group">
                    <label for="phoneNumber" class="col-form-label">phone Number</label>
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
</div> <!-- Add client modal -->
@include('button')
<script src='js/select2.min.js'></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/inputMask.min.js"></script>
<script>
    $('.drgpicker').daterangepicker(
    {
    singleDatePicker: true,
    timePicker: false,
    showDropdowns: true,
    locale:
    {
        format: 'MM/DD/YYYY'
    }
    });

    $('.select2').select2(
    {
    theme: 'bootstrap4',
    });

    Inputmask("9999-999-99-99").mask("#phoneNumber");
    
</script>
    
@endsection
