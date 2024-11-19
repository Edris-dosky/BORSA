@extends('layouts.app')
@section('content')


<section class="py-1 bg-blueGray-50">
    <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
              <h3 class="font-semibold text-lg text-blueGray-700 mb-4">{{$currency_type->currency}}</h3>
            </div>
  
        <div class="block w-full overflow-x-auto">
          <table class="items-center bg-transparent w-full border-collapse text-sm">
            <thead>
              <tr>
                <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Price</th>
                <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Create At</th>
                <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Befor</th>
                <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Added By</th>
              </tr>
            </thead>
            <tbody>
              @foreach($currency_value as $currency)
                <tr>
                  <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-s whitespace-nowrap">
                    {{$currency->amount}}
                  </td>
                  <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                    {{$currency->created_at}}
                  </td>
                  <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                    {{$currency->created_at?->diffForHumans()}}
                  </td>
                  <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                    {{ $currency->user->name}}
                  </td>
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