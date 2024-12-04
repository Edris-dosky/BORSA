@extends('layouts.app')

@section('content')

  <div class="container mt-5">
    <h2 class="mb-4 text-2xl font-semibold">Transaction Form</h2>
    <form>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
          <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="amount" placeholder="Enter amount">
        </div>
        <div>
          <label for="fees" class="block text-sm font-medium text-gray-700">Fees</label>
          <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="fees" placeholder="Enter fees">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label for="from" class="block text-sm font-medium text-gray-700">From</label>
          <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="from">
            <option selected>Choose...</option>
            <option value="pending">USQ</option>
            <option value="completed">IDK</option>
            <option value="failed">LIRA</option>
          </select>
        </div>
        <div>
          <label for="to" class="block text-sm font-medium text-gray-700">To</label>
          <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="to">
            <option selected>Choose...</option>
            <option value="pending">USQ</option>
            <option value="completed">IDK</option>
            <option value="failed">LIRA</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label for="constraint" class="block text-sm font-medium text-gray-700">Constraint</label>
          <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="constraint" placeholder="Enter constraint">
        </div>
        <div>
          <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
          <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="total" placeholder="Enter total">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label for="pay_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
          <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="pay_method">
            <option selected>Choose...</option>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bank_transfer">Bank Transfer</option>
          </select>
        </div>
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
          <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="status">
            <option selected>Choose...</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="failed">Failed</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label for="client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
          <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="client_id">
            <option selected>Choose...</option>
            <option value="pending">ahemd</option>
            <option value="completed">rebwar</option>
            <option value="failed">Failed</option>
          </select>
        </div>
      </div>

      <button type="submit" class="mt-4 px-6 py-2 bg-blue-500 text-white font-medium text-sm rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Submit</button>
    </form>
  </div>

@endsection
