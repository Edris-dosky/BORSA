@extends('layouts.app')

@section('content')
@php
function percentageDifference($num1, $num2) {
    $data = [];
    
    if (empty($num1) || empty($num2) || $num1 == 0 || $num2 == 0) {
        $data = '<i class="fa fa-caret-left text-Violet-500"></i> 0 %'; 
    } elseif ($num1 == $num2) {
        $data = '<i class="fa fa-minus text-Violet-500"></i> 0 %';  
    } else {
        $difference = ($num1 - $num2);
        $difference2 = abs($difference);
        $average = ($num1 + $num2) / 2;
        $percentage = intval(($difference2 / $average) * 100);
        
        // Check if the difference is positive or negative
        if ($difference > 0) {
            $data = '<i class="fas fa-arrow-up text-emerald-500 mr-1"></i>'.$percentage .'%';
        } elseif ($difference < 0) {
            $data = '<i class="fas fa-arrow-down text-orange-500 mr-1"></i>'.$percentage .'%';
        }
    }

    return $data;
}
@endphp

<style>
  .modal {
      display: flex;
      align-items: center;
      justify-content: center;
  }
  .modal-content {
      width: 400px;
      max-width: 90%;
      position: relative;
  }
  .hidden {
      display: none;
  }
  .close {
      font-size: 24px;
      position: absolute;
      top: 3px;
      right: 15px;
      cursor: pointer;
  }
</style>

<section class="py-1 bg-blueGray-50">
    <div class="w-9/12 xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-blueGray-700">Currency Peer 100$</h3>
                    </div>
                    <button id="openModal" class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-2 rounded">
                        Add Currency
                    </button>
                   <!-- Add Currency Modal -->
                        <div id="currencyModalAdd" class="modal hiddenZerxady-wl fixed z-50 inset-0 flex items-center justify-center">
                          <div class="modal-content bg-white rounded-lg p-6 shadow-lg">
                              <h2 class="text-xl font-semibold text-gray-700 mb-8">Add Currency</h2>
                              <span id="closeModal" class="close text-gray-600">&times;</span>     
                              <form action="{{ route('currency.store') }}" method="POST">
                                  @csrf
                                  <div class="relative mb-4">
                                      <input value="{{ old('currency') }}" type="text" name="currency" id="currency" placeholder="currency" 
                                      class="w-full rounded-md border-gray-200 p-1 shadow-sm sm:text-sm"/>
                                      @error('currency')
                                      <div class="text-red-500">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="relative mb-4">
                                      <input value="{{ old('amount') }}" type="number" name="amount" id="amount" placeholder="value" 
                                      class="w-full rounded-md border-gray-200 p-1 shadow-sm sm:text-sm pl-4"/>
                                      @error('amount')
                                      <div class="text-red-500">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <button class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">Add Currency</button>
                              </form>
                          </div>
                        </div>

                        <!-- Edit Currency Modal -->
                        <div id="currencyModalEdit" class="modal hidden fixed z-50 inset-0 flex items-center justify-center">
                          <div class="modal-content bg-white rounded-lg p-6 shadow-lg">
                              <h2 class="text-xl font-semibold text-gray-700 mb-8">Edit Currency</h2>
                              <span id="closeModalEdit" class="close text-gray-600">&times;</span>     
                              <form id="currencyForm" action="{{ route('currency.update', ':id') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="currencyId" name="currencyId">
                            
                                <div class="relative mb-4">
                                    <input type="text" name="currency" id="currencyEdit" placeholder="Currency" class="w-full rounded-md border-gray-200 p-1 shadow-sm sm:text-sm"/>
                                    @error('currency')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            

                                <div class="relative mb-4">
                                    <input type="number" name="amount" id="amountEdit" placeholder="Value" class="w-full rounded-md border-gray-200 p-1 shadow-sm sm:text-sm pl-4"/>
                                    @error('amount')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            

                                <button type="submit" class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Save Currency</button>
                            </form>
                            
                          </div>
                        </div>

                </div>
            </div>

            <div class="block w-full overflow-x-auto">
                <table class="items-center bg-transparent w-full border-collapse text-sm">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-center">#</th>
                            <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Currency</th>
                            <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Last Price</th>
                            <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Status</th>
                            <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Update At</th>
                            <th class="px-4 py-2 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 text-xs uppercase whitespace-nowrap font-semibold text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currency_value as $index => $currency)
                        <tr>
                            <td class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-s text-center whitespace-nowrap">
                                <span>{{ $index + 1 }}</span>
                            </td>
                            <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-s whitespace-nowrap">
                                <span style="cursor: pointer" title="Added by: {{$currency->users->name}}">{{$currency->currency}}</span>
                            </td>
                            <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                @if($currency->currencyAmount->isNotEmpty())
                                    <span>{{ $currency->currencyAmount->last()->amount }}</span>
                                @else
                                    Null
                                @endif
                            </td>

                            <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                @if($currency->currencyAmount->count() > 1)
                                    @php
                                        $result = percentageDifference($currency->currencyAmount->last()->amount,$currency->currencyAmount->reverse()->skip(1)->first()->amount);
                                    @endphp
                                    <span>{!!$result!!}</span>
                                @else
                                    <span><i class="fa fa-minus"></i> 0%</span>
                                @endif
                            </td>

                            <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                <span style="cursor: pointer" title="{{$currency->currencyAmount->last()?->created_at}}">
                                    {{$currency->currencyAmount->last()?->created_at?->diffForHumans()}}
                                </span>
                            </td>

                            <td class="border-t-0 px-4 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                <div class="flex space-x-3">
                                    <a href="{{ route('currency.show', $currency->id) }}" class="bg-indigo-500 text-white px-2 py-1 rounded">Show</a>
                                    <button class="bg-yellow-500 text-white px-2 mx-2 py-1 rounded edit-btn" data-id="{{ $currency->id }}" data-currency="{{ $currency->currency }}" data-amount="{{ $currency->currencyAmount->last()?->amount }}">Edit</button>
                                    <button class="bg-red-500 text-white px-2 py-1 rounded delete-btn" data-id="{{ $currency->id }}" data-url="{{ route('currency.destroy', $currency->id) }}">Delete</button>
                                </div>
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

<script>
const modalAdd = document.getElementById('currencyModalAdd');
const modalEdit = document.getElementById('currencyModalEdit');
const openModal = document.getElementById('openModal');
const closeModalAdd = document.getElementById('closeModal');
const closeModalEdit = document.getElementById('closeModalEdit');
const editButtons = document.querySelectorAll('.edit-btn');
const currencyForm = document.getElementById('currencyForm');

// Open Add Modal
openModal.onclick = function() {
    modalAdd.classList.remove('hidden');
    document.getElementById('currency').value = '';
    document.getElementById('amount').value = '';
    document.getElementById('currencyId').value = '';
}

// Close Add Modal
closeModalAdd.onclick = function() {
    modalAdd.classList.add('hidden');
}

// Open Edit Modal
editButtons.forEach(button => {
    button.addEventListener('click', function () {
        const currencyId = this.getAttribute('data-id');
        const currencyName = this.getAttribute('data-currency');
        const currencyAmount = this.getAttribute('data-amount');

        // Set the form action to update (PUT)
        const formActionUrl = "{{ route('currency.update', ':id') }}".replace(':id', currencyId);
        currencyForm.action = formActionUrl;

        // Populate the modal with the current values
        document.getElementById('currencyEdit').value = currencyName;
        document.getElementById('amountEdit').value = currencyAmount;
        document.getElementById('currencyId').value = currencyId;

        modalEdit.classList.remove('hidden');
    });
});

// Close Edit Modal
closeModalEdit.onclick = function() {
    modalEdit.classList.add('hidden');
}

// Close modals on outside click
window.onclick = function(event) {
    if (event.target === modalAdd) {
        modalAdd.classList.add('hidden');
    } else if (event.target === modalEdit) {
        modalEdit.classList.add('hidden');
    }
}
</script>

@endsection
