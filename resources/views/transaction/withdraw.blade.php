@extends('layouts.app')
@section('content')
<div class="row align-items-center my-2">
    <div class="col">
        <h2 class="page-title">Withdraw Table</h2>    
    </div>
    <div class="col-auto">
        <a href="{{ route('withdraw.create')}}" class="btn btn-info" type="button"><span class="fe fe-plus"></span>Add</a>
        
    </div>
</div>w
<div class="card shadow">
    <div class="card-body">
        <!-- table -->
        <table class="display nowrap" style="width:100%" id="dataTable1">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Currecny</th>
                    <th scope="col">Fees</th>
                    <th scope="col">tottal</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Status</th>
                    <th scope="col">User add</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $row)
                <tr>
                    <td>{{$index+1}}</td>
                    <td><a href="{{route('client.show',$row->clients->id)}}"> {{$row->clients->name}} </a></td>
                    <td>{{$row->amounts?->amount}}</td>
                    <td>{{$row->currencies?->currency}}</td>
                    <td>{{$row->amounts?->fees}}</td>
                    <td>{{$row->amounts?->tottal}}</td>
                    <td>{{$row->amounts?->pay_method}}</td>
                    <td>{{$row->amounts?->status}}</td>
                    <td>{{$row->users?->name}}</td>
                    <td>
                        <a href="{{route('withdraw.edit' , $row->id)}}" class="btn btn-warning"><span class="fe fe-edit"></span></a>
                        <button id='1' class="btn btn-danger btndelete"><span class="fe fe-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete"></span></button>
                        <button class="btn btn-success show-client">
                                <span class="fe fe-eye" style="color:#ffffff" data-toggle="tooltip" title="show"></span>
                        </button>
                    </td>
                </tr>
                @empty

                <i class="fe fe-help-circle fe-16 text-danger"></i>
                <span> you dont have any data yet </span>
                
                @endforelse 
          
            </tbody>
        </table>
    </div>
</div>
@endsection