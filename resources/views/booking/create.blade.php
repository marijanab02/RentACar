<!-- create.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Make a booking
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
      <form method="post" action="{{ route('booking.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Car id</label>
              <input type="text" class="form-control" name="car_id"/>
          </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Email:</label>
              <input type="text" class="form-control" name="email"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="cases">Booking Place :</label>
              <input type="text" class="form-control" name="book_place"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="cases">Booking date :</label>
              <input type="text" class="form-control" name="book_date"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="cases">Duration :</label>
              <input type="text" class="form-control" name="duration"/>
          </div>
        
          <div class="form-group">
          @csrf
              <label for="cases">Phone number :</label>
              <input type="text" class="form-control" name="phone_num"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="cases">Destination :</label>
              <input type="text" class="form-control" name="destination"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="cases">Return date :</label>
              <input type="text" class="form-control" name="return_date"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="cases">Price :</label>
              <input type="text" class="form-control" name="price"/>
          </div>
          
          <div class="form-group">
          @csrf
              <label for="cases">Booking status :</label>
              <input type="text" class="form-control" name="book_status"/>
          </div>


          <button type="submit" class="btn btn-primary">Add Booking</button>
      </form>
  </div>
</div>
@endsection
