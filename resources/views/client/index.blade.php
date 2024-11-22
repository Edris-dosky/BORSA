@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-50">
    <!-- Set width to 90% of screen -->
    <div class="w-[90%] max-w-6xl bg-white shadow-md rounded-lg p-6">
      <!-- Add Client Button -->
      <div class="mb-4 flex justify-end">
        <a href="{{route('client.create')}}" class="bg-indigo-500 text-white px-4 py-2 rounded-md text-sm hover:bg-green-600 focus:outline-none">
          Add Client
        </a>
      </div>
  
      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="min-w-full w-full table-auto border-collapse">
          <thead>
            <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600">
              <th class="px-2 py-3 border-b">#</th>
              <th class="px-4 py-3 border-b">Name</th>
              <th class="px-4 py-3 border-b">Email</th>
              <th class="px-4 py-3 border-b">Phone</th>
              <th class="px-4 py-3 border-b">Address</th>
              <th class="px-4 py-3 border-b">Type</th>
              <th class="px-4 py-3 border-b">User added</th>
              <th class="px-4 py-3 border-b">Actions</th>
            </tr>
          </thead>
          <tbody class="text-sm text-gray-700">
            @forelse ($clients as $index => $client)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-2 py-3">{{$index+1}}</td>
                <td class="px-4 py-3">{{$client->name}}</td>
                <td class="px-4 py-3">{{$client->email}}</td>
                <td class="px-4 py-3">{{$client->phone}}</td>
                <td class="px-4 py-3">{{$client->address}}</td>
                <td class="px-4 py-3">{{$client->type}}</td>
                <td class="px-4 py-3">{{$client->user?->name}}</td>
                <td class="px-4 py-3 text-center flex gap-1">
                  <button class="bg-indigo-500 text-white px-4 py-2 rounded-md text-xs hover:bg-blue-600 focus:outline-none">Edit</button>
                  <button class="bg-red-500 text-white px-3 py-2 rounded-md text-xs hover:bg-red-600 focus:outline-none">Delete</button>
                  <a href="{{route('client.show',$client->id)}}" class="bg-red-500 text-white px-3 py-2 rounded-md text-xs hover:bg-red-600 focus:outline-none">Show</a>
                </td>
              </tr> 
            @empty
                <tr><td colspan="8" class="text-center py-3">No clients found</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
