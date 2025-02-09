@extends('layouts.app')

@section('content')
    <div class="container mt-5 bg-white p-4 rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="d-flex align-items-center mb-5">
            @if($client->picture)
                <img src="{{ Storage::url($client->picture) }}" alt="Client Picture" class="rounded-circle w-25 h-25 border-2 border-primary me-4">
            @else
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-lg text-secondary w-25 h-25 me-4">
                    {{ strtoupper(substr($client->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <h2 class="h3 text-dark">{{ $client->name }}</h2>
                <p class="small text-muted">{{ $client->type }}</p>
            </div>
        </div>

        <!-- Client Details Section -->
        <div class="row g-4">
            <!-- Left Side: Contact Info -->
            <div class="col-md-6">
                <h3 class="h5 text-dark mb-3">Contact Information</h3>
                <div>
                    <p class="small text-muted">Email</p>
                    <p class="h6 text-dark">{{ $client->email }}</p>
                </div>
                <div>
                    <p class="small text-muted">Phone</p>
                    <p class="h6 text-dark">{{ $client->phone }}</p>
                </div>
                <div>
                    <p class="small text-muted">Address</p>
                    <p class="h6 text-dark">{{ $client->address }}</p>
                </div>
            </div>

            <!-- Right Side: Type and Date -->
            <div class="col-md-6">
                <h3 class="h5 text-dark mb-3">Client Information</h3>
                <div>
                    <p class="small text-muted">Client Type</p>
                    <p class="h6 text-dark">{{ $client->type }}</p>
                </div>
                <div>
                    <p class="small text-muted">Created At</p>
                    <p class="h6 text-dark">{{ $client->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="small text-muted">Updated At</p>
                    <p class="h6 text-dark">{{ $client->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Action Button Section -->
        <div class="mt-4 d-flex justify-content-end gap-3">
            <a href="{{ route('client.index') }}" class="btn btn-secondary btn-sm">Back to Clients</a>
            <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary btn-sm">Edit Client</a>
        </div>
    </div>
@endsection
