@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
  .current-image {
    max-width: 200px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Car Data
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
    
    <form method="post" action="{{ route('cars.update', $car->CAR_ID) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      
      <div class="form-group">
        <label for="car_name">Car Name:</label>
        <input type="text" class="form-control" name="CAR_NAME" value="{{ old('CAR_NAME', $car->CAR_NAME) }}" required/>
      </div>
      
      <div class="form-group">
        <label for="fuel_type">Fuel Type:</label>
        <select class="form-control" name="FUEL_TYPE" required>
          <option value="PETROL" {{ old('FUEL_TYPE', $car->FUEL_TYPE) == 'PETROL' ? 'selected' : '' }}>Petrol</option>
          <option value="DIESEL" {{ old('FUEL_TYPE', $car->FUEL_TYPE) == 'DIESEL' ? 'selected' : '' }}>Diesel</option>
          <option value="GAS" {{ old('FUEL_TYPE', $car->FUEL_TYPE) == 'GAS' ? 'selected' : '' }}>Gas</option>
          <option value="ELECTRIC" {{ old('FUEL_TYPE', $car->FUEL_TYPE) == 'ELECTRIC' ? 'selected' : '' }}>Electric</option>
        </select>
      </div>
      
      <div class="form-group">
        <label for="capacity">Capacity (seats):</label>
        <input type="number" class="form-control" name="CAPACITY" value="{{ old('CAPACITY', $car->CAPACITY) }}" min="2" max="20" required/>
      </div>
      
      <div class="form-group">
        <label for="price">Price per day (€):</label>
        <input type="number" class="form-control" name="PRICE" value="{{ old('PRICE', $car->PRICE) }}" min="0" step="0.01" required/>
      </div>
      
      <div class="form-group">
        <label>Current Image:</label><br>
        <img src="{{ asset('storage/' . $car->CAR_IMG) }}" alt="{{ $car->CAR_NAME }}" class="current-image">
        <label for="car_img">Change Image (optional):</label>
        <input type="file" class="form-control" name="CAR_IMG" accept="image/*"/>
        <small class="form-text text-muted">Leave empty to keep current image</small>
      </div>
      
      <div class="form-group">
        <label for="available">Availability:</label>
        <select class="form-control" name="AVAILABLE" required>
          <option value="Y" {{ old('AVAILABLE', $car->AVAILABLE) == 'Y' ? 'selected' : '' }}>Available</option>
          <option value="N" {{ old('AVAILABLE', $car->AVAILABLE) == 'N' ? 'selected' : '' }}>Not Available</option>
        </select>
      </div>
      
      <button type="submit" class="btn btn-primary">Update Car</button>
      <a href="{{ route('cars.index') }}" class="btn btn-secondary ml-2">Cancel</a>
    </form>
  </div>
</div>
@endsection