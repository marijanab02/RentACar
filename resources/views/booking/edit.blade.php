@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Booking Data
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
      <form method="post" action="{{ route('booking.update', $Booking->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Car id:</label>
              <input type="text" class="form-control" name="car_id" value="{{ $Booking->car_id }}"/>
          </div>

          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Email:</label>
              <input type="text" class="form-control" name="email" value="{{ $Booking->email }}"/>
          </div>


          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Booking place:</label>
              <input type="text" class="form-control" name="book_place" value="{{ $Booking->book_place }}"/>
          </div>


          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Booking date:</label>
              <input type="text" class="form-control" name="book_date" value="{{ $Booking->book_date }}"/>
          </div>


          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Duration:</label>
              <input type="text" class="form-control" name="duration" value="{{ $Booking->duration }}"/>
          </div>


          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Phone number:</label>
              <input type="text" class="form-control" name="phone_num" value="{{ $Booking->phone_num }}"/>
          </div>


          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Destination:</label>
              <input type="text" class="form-control" name="destination" value="{{ $Booking->destination }}"/>
          </div>


          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Return date:</label>
              <input type="text" class="form-control" name="return_date" value="{{ $Booking->return_date }}"/>
          </div>

          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Price:</label>
              <input type="text" class="form-control" name="price" value="{{ $Booking->price }}"/>
          </div>
          
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Booking status:</label>
              <input type="text" class="form-control" name="book_status" value="{{ $Booking->book_status }}"/>
          </div>

        
        

          <button type="submit" class="btn btn-primary">Update  user data</button>
      </form>
  </div>
</div>
@endsection
