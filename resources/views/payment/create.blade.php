@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container uper">
  <div class="card">
    <div class="card-header">
      Create New Payment
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif

      <form method="post" action="{{ route('payment.store') }}">
        @csrf
        
        <div class="form-group">
          <label for="booking_id">Booking ID:</label>
          <select class="form-control" name="BOOK_ID" required>
            <option value="">Select Booking</option>
            @foreach($bookings as $booking)
                <option value="{{ $booking->BOOK_ID }}" data-price="{{ $booking->price }}">
                    Booking #{{ $booking->BOOK_ID }} - 
                    {{ $booking->car->CAR_NAME ?? 'No Car' }} - 
                    Total: €{{ number_format($booking->price, 2) }}
                </option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
          <label for="card_no">Card Number:</label>
          <input type="text" class="form-control" name="CARD_NO" 
                 placeholder="1234 5678 9012 3456" required 
                 pattern="\d{16}" title="16-digit card number">
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exp_date">Expiration Date:</label>
              <input type="text" class="form-control" name="EXP_DATE" 
                     placeholder="MM/YY" required 
                     pattern="(0[1-9]|1[0-2])\/[0-9]{2}" 
                     title="Format: MM/YY">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="cvv">CVV:</label>
              <input type="text" class="form-control" name="CVV" 
                     placeholder="123" required 
                     pattern="\d{3,4}" title="3 or 4-digit CVV">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="price">Amount:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">€</span>
            </div>
            <input type="number" class="form-control" name="PRICE" 
                   min="0" step="0.01" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Payment</button>
        <a href="{{ route('payment.index') }}" class="btn btn-secondary ml-2">Cancel</a>
      </form>
    </div>
  </div>
</div>
@endsection