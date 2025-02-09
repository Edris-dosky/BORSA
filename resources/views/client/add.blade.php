@extends('layouts.app')

@section('content')
    <div class="container mt-5">
      <div class="card shadow-lg rounded-sm">
        <div class="card-header bg-info text-white">
          <h2 class="h4 mb-0 text-white" >Add New Client</h2>
        </div>
        <div class="card-body">
          <form id="addClientForm" action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

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

            <!-- Address Field -->
            <div class="mb-4">
              <label for="address" class="form-label">Address</label>
              <input type="text" id="address" name="address" class="form-control" placeholder="Enter address" required>
            </div>

           <!-- Client Type Dropdown with Bootstrap Select -->
          <div class="mb-4">
            <label for="type" class="form-label">Client Type</label>
            <select id="type" name="type" class="form-select selectpicker" required>
              <option value="Person">Person</option>
              <option value="Company">Company</option>
            </select>
          </div>


            <!-- Profile Picture Upload -->
            <div class="mb-4">
              <label for="picture" class="form-label">Client Picture</label>
              <input type="file" id="picture" name="picture" accept="image/*" class="form-control">
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-3">
              <a href="{{route('client.index')}}" type="button" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-success">Save Client</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
