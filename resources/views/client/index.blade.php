@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-start min-vh-100 bg-light">
    <!-- Set width to 90% of screen -->
    <div class="w-100 mx-auto bg-white shadow-lg rounded p-5" style="max-width: 1200px;">
        <!-- Add Client Button -->
        <div class="mb-4 d-flex justify-content-end">
            <a href="{{route('client.create')}}" class="btn btn-primary btn-lg">
                Add Client
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
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
                        <td class="align-middle">{{$index+1}}</td>
                        <td class="align-middle">{{$client->name}}</td>
                        <td class="align-middle">{{$client->email}}</td>
                        <td class="align-middle">{{$client->phone}}</td>
                        <td class="align-middle">{{$client->address}}</td>
                        <td class="align-middle">{{$client->type}}</td>
                        <td class="align-middle">{{$client->user?->name}}</td>
                        <td class="text-center align-middle">
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                                <a href="{{route('client.show',$client->id)}}" class="btn btn-info btn-sm">Show</a>
                            </div>
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
</div>
@endsection
