@extends('layouts.app')
@section('content')

<section class="py-1 bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header border-0">
                <h3 class="font-weight-bold text-primary mb-4">{{$currency_type->currency}}</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Before</th>
                            <th>Added By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currency_value as $currency)
                        <tr>
                            <td>{{$currency->amount}}</td>
                            <td>{{$currency->created_at}}</td>
                            <td>{{$currency->created_at?->diffForHumans()}}</td>
                            <td>{{ $currency->user->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $currency_value->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</section>

@endsection
