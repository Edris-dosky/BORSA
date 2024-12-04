@extends('layouts.app')
@section('content')


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<body>
  <div class="container mt-5">
    <h2 class="mb-4">Transaction Form</h2>
    <form>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="amount" class="form-label">Amount</label>
          <input type="number" class="form-control" id="amount" placeholder="Enter amount">
        </div>
        <div class="col-md-6">
          <label for="fees" class="form-label">Fees</label>
          <input type="number" class="form-control" id="fees" placeholder="Enter fees">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="constraint" class="form-label">Constraint</label>
          <input type="text" class="form-control" id="constraint" placeholder="Enter constraint">
        </div>
        <div class="col-md-6">
          <label for="total" class="form-label">Total</label>
          <input type="number" class="form-control" id="total" placeholder="Enter total">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="pay_method" class="form-label">Payment Method</label>
          <select class="form-select" id="pay_method">
            <option selected>Choose...</option>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bank_transfer">Bank Transfer</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status">
            <option selected>Choose...</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="failed">Failed</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="client_id" class="form-label">Client ID</label>
          <input type="text" class="form-control" id="client_id" placeholder="Enter client ID">
        </div>
        <div class="col-md-6">
          <label for="from" class="form-label">From</label>
          <select class="form-select" id="from">
            <option selected>Choose...</option>
            <option value="pending">USQ</option>
            <option value="completed">IDK</option>
            <option value="failed">LIRA</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="to" class="form-label">To</label>
          <select class="form-select" id="to">
            <option selected>Choose...</option>
            <option value="pending">USQ</option>
            <option value="completed">IDK</option>
            <option value="failed">LIRA</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

@endsection