@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="flex items-center mb-8">
            @if($client->picture)
                <img src="{{ Storage::url($client->picture) }}" alt="Client Picture" class="w-24 h-24 rounded-full object-cover border-2 border-indigo-500 mr-6">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-xl font-semibold text-gray-600 mr-6">
                    {{ strtoupper(substr($client->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <h2 class="text-3xl font-semibold text-gray-800">{{ $client->name }}</h2>
                <p class="text-sm text-gray-500">{{ $client->type }}</p>
            </div>
        </div>

        <!-- Client Details Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Side: Contact Info -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Contact Information</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-lg text-gray-700">{{ $client->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="text-lg text-gray-700">{{ $client->phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Address</p>
                        <p class="text-lg text-gray-700">{{ $client->address }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Type and Date -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Client Information</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Client Type</p>
                        <p class="text-lg text-gray-700">{{ $client->type }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Created At</p>
                        <p class="text-lg text-gray-700">{{ $client->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Updated At</p>
                        <p class="text-lg text-gray-700">{{ $client->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Button Section -->
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('client.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md text-sm hover:bg-gray-600 focus:outline-none transition">Back to Clients</a>
            <a href="{{ route('client.edit', $client->id) }}" class="bg-indigo-500 text-white px-6 py-2 rounded-md text-sm hover:bg-indigo-700 focus:outline-none transition">Edit Client</a>
        </div>
    </div>
@endsection
