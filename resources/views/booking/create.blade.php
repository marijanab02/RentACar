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
              <label for="car_id">Select Car:</label>
              <select class="form-control" name="car_id" required>
                  <option value="">-- Select a Car --</option>
                  @foreach($cars as $car)
                      <option value="{{ $car->CAR_ID }}">
                          {{ $car->CAR_NAME }} ({{ $car->FUEL_TYPE }}, {{ $car->CAPACITY }} seats) - €{{ number_format($car->PRICE, 2) }}/day
                      </option>
                  @endforeach
              </select>
          </div>
          
         <div class="form-group">
            <label for="user_id">Select User (Email):</label>
              <select class="form-control" name="user_id" required>
              <option value="">-- Select a User --</option>
              @foreach($users as $user)
               <option value="{{ $user->id }}">{{ $user->email }}</option>
               @endforeach
              </select>
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
