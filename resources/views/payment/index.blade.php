@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
  
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Payments List</h2>
    <a href="{{ route('payment.create') }}" class="btn btn-success">Add New Payment</a>
  </div>

  <table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Booking ID</th>
          <th>Card Number</th>
          <th>Exp Date</th>
          <th>Amount (€)</th>
          <th>Payment Date</th>
          <th colspan="2" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($Payments as $Payment)
        <tr>
            <td>{{ $Payment->PAY_ID }}</td>
            <td>
              <a href="{{ route('booking.show', $Payment->BOOK_ID) }}">
                Booking #{{ $Payment->BOOK_ID }}
              </a>
            </td>
            <td class="card-number">
              **** **** **** {{ substr($Payment->CARD_NO, -4) }}
            </td>
            <td>
              @php
                $expDate = str_split($Payment->EXP_DATE, 2);
                echo implode('/', $expDate);
              @endphp
            </td>
            <td>{{ number_format($Payment->PRICE, 2) }}</td>
            <td>{{ $Payment->created_at->format('d.m.Y H:i') }}</td>
            <td class="text-right">
              <a href="{{ route('payment.edit', $Payment->PAY_ID) }}" class="btn btn-primary btn-sm">Edit</a>
            </td>
            <td class="text-left">
              <form action="{{ route('payment.destroy', $Payment->PAY_ID) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
              </form>
            </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center">No payments found</td>
        </tr>
        @endforelse
    </tbody>
  </table>
  
  <!-- Pagination -->
  @if($Payments->hasPages())
  <div class="d-flex justify-content-center mt-4">
    {{ $Payments->links() }}
  </div>
  @endif
</div>
@endsection