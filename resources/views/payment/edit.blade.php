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
      Edit Payment
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
      @if(session()->has('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div><br />
      @endif

      <form method="post" action="{{ route('payment.update', $payment->PAY_ID) }}">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
          <label for="booking_id">Booking ID:</label>
          <input type="text" class="form-control" value="{{ $payment->BOOK_ID }}" readonly>
          <small class="form-text text-muted">Booking ID cannot be changed</small>
        </div>

        <div class="form-group">
          <label for="card_no">Card Number:</label>
          <input type="text" class="form-control card-number" name="CARD_NO" 
                 value="{{ old('CARD_NO', $payment->CARD_NO) }}"
                 placeholder="1234 5678 9012 3456" required 
                 pattern="\d{16}" title="16-digit card number">
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exp_date">Expiration Date:</label>
              <input type="text" class="form-control" name="EXP_DATE" 
                     value="{{ old('EXP_DATE', implode('/', str_split($payment->EXP_DATE, 2))) }}"
                     placeholder="MM/YY" required 
                     pattern="(0[1-9]|1[0-2])\/[0-9]{2}" 
                     title="Format: MM/YY">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="cvv">CVV:</label>
              <input type="text" class="form-control" name="CVV" 
                     value="{{ old('CVV', $payment->CVV) }}"
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
                   value="{{ old('PRICE', $payment->PRICE) }}" 
                   min="0" step="0.01" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Payment</button>
        <a href="{{ route('payment.index') }}" class="btn btn-secondary ml-2">Cancel</a>
      </form>
    </div>
  </div>
</div>
@endsection