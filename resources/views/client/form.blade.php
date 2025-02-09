@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Add New Client</h3>
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
        <form id="addClientForm" action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter full name" required>
                    </div>
        
                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
                    </div>
        
                    <!-- Phone Field -->
                    <div class="mb-4">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone number" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Address Field -->
                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Enter address" required>
                    </div>
        
                    <!-- Client Type Dropdown with Bootstrap Select -->
                    <div class="form-group" for="type">
                        <label for="type">Client Type</label>
                        <select class="form-control select2" style="width: 100%;" id="type" name="type">
                        <option selected="selected" disabled>Select Client Type</option>
                            <option value="Person">Person</option>
                            <option value="Company">Company</option>
                        </select>
                    </div>
        
                    <!-- Profile Picture Upload -->
                    <div class="mb-4">
                        <label for="picture" class="form-label">Client Picture</label>
                        <input type="file" id="picture" name="picture" accept="image/*" class="form-control">
                    </div>
                </div>
            </div>
            <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <!-- Action Buttons -->
        <div class="row">
            <div class="col-md-6 text-left">
                <a href="{{route('client.index')}}" type="button" class="btn btn-secondary">Cancel</a>
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-primary">Save Client</button>
            </div>
        </div>
    </div>
</div>
@endsection