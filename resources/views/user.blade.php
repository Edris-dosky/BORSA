@extends('layouts.app')
@section('content')
<div class="row align-items-center my-2">
    <div class="col">
        <h2 class="page-title">User Table</h2>    
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventModal"><span class="fe fe-plus fe-16 mr-3"></span>Add</button>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <!-- table -->
        <table class="display nowrap" style="width:100%" id="dataTable1">
            <thead>
                <tr>
                <th>#</th>
                <th>Created At</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Pictures</th>
                <th>Role</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>{{$user->email}}</td>
                    <td><img  class="rounded" src="{{ asset('storage/' . $user->image) }}" alt="" width="60px" height="70px"></td>
                    <td>{{$user->role}}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editUser" data-id="{{ $user->id }}">
                            <span class="fe fe-edit"></span>
                        </a>
                        <button id='{{$user->id}}' class="btn btn-danger btndelete" ><span class="fe fe-trash" style="color:#ffffff" data-toggle="tooltip"  title="Delete"></span></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add User modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('register')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fullName" class="col-form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="">
                    </div>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="phoneNumber" class="col-form-label">phone Number</label>
                        <input type="phone" class="form-control" id="phone_number" name="phone_number" placeholder="0750-123-45-67">
                    </div>
                    @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="Password" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                    </div>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="Confirm Password" class="col-form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                    </div>
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="role" class="col-form-label">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    @error('role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="picture">Picture</label>
                        <input type="file" id="image" name="image" class="form-control-file">
                    </div>
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            <div class="modal-footer d-flex justify-content-between">
                <button id="addEmployer" type="submit" class="btn mb-2 btn-primary">Add</button>
            </div>
        </form>
        </div>
    </div>
</div> <!-- Add User modal -->

<!-- Edit User modal -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form method="post" id="dataForm" action="">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="fullName" class="col-form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="">
                    </div>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="phoneNumber" class="col-form-label">phone Number</label>
                        <input type="phone" class="form-control" id="phone_number" name="phone_number" placeholder="0750-123-45-67">
                    </div>
                    @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="picture">Picture</label>
                        <input type="file" id="image" name="image" class="form-control-file">
                    </div>
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror  
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button id="addEmployer" type="submit" class="btn mb-2 btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
</div> <!-- Add User modal -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function() {
            var userId = $(this).data('id'); // Get the user ID from the button's data-id attribute
            var user = {!! $users->toJson() !!}.find(user => user.id == userId); // Find the user in the users array

            // Populate the form fields in the edit modal
            $('#editUser #name').val(user.name);
            $('#editUser #email').val(user.email);
            $('#editUser #phone_number').val(user.phone_number);
            $('#editUser #role').val(user.role);

            // Update the form action URL to include the user ID
            $('#dataForm').attr('action', '/users/' + userId);
        });
    });
</script>
@include('button')
@endsection