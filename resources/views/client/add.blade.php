@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl w-4/5 mx-auto mt-10">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New Client</h2>
      
      <form id="addClientForm" action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Name Field -->
        <div class="mb-6">
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
        </div>
        
        <!-- Email Fi-eld -->
        <div class="mb-6">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
          <input type="email" id="email" name="email" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
        </div>

        <!-- Phone Field -->
        <div class="mb-6">
          <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
          <input type="text" id="phone" name="phone" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
        </div>

        <!-- Address Field -->
        <div class="mb-6">
          <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
          <input type="text" id="address" name="address" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
        </div>

        <!-- Client Type Dropdown -->
        <div class="mb-6">
          <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Client Type</label>
          <select id="type" name="type" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            <option value="Person">Person</option>
            <option value="Company">Company</option>
          </select>
        </div>
        
        <!-- Profile Picture Upload -->
        <div class="mb-6">
          <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Client Picture</label>
          <input type="file" id="picture" name="picture" accept="image/*" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
          <a href="{{route('client.index')}}" type="button"  class="bg-gray-500 text-white px-6 py-2 rounded-md text-sm hover:bg-gray-600 focus:outline-none transition">Cancel</a>
          <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-md text-sm hover:bg-indigo-700 focus:outline-none transition">Save Client</button>
        </div>
      </form>
    </div>

@endsection
