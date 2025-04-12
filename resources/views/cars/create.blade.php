@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add New Car
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
    
    <form method="post" action="{{ route('cars.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="car_name">Car Name:</label>
        <input type="text" class="form-control" name="CAR_NAME" value="{{ old('CAR_NAME') }}" required/>
      </div>
      
      <div class="form-group">
        <label for="fuel_type">Fuel Type:</label>
        <select class="form-control" name="FUEL_TYPE" required>
          <option value="">Select Fuel Type</option>
          <option value="PETROL" {{ old('FUEL_TYPE') == 'PETROL' ? 'selected' : '' }}>Petrol</option>
          <option value="DIESEL" {{ old('FUEL_TYPE') == 'DIESEL' ? 'selected' : '' }}>Diesel</option>
          <option value="GAS" {{ old('FUEL_TYPE') == 'GAS' ? 'selected' : '' }}>Gas</option>
          <option value="ELECTRIC" {{ old('FUEL_TYPE') == 'ELECTRIC' ? 'selected' : '' }}>Electric</option>
        </select>
      </div>
      
      <div class="form-group">
        <label for="capacity">Capacity (seats):</label>
        <input type="number" class="form-control" name="CAPACITY" value="{{ old('CAPACITY') }}" min="2" max="20" required/>
      </div>
      
      <div class="form-group">
        <label for="price">Price per day (€):</label>
        <input type="number" class="form-control" name="PRICE" value="{{ old('PRICE') }}" min="0" required/>
      </div>
      
      <div class="form-group">
        <label for="car_img">Car Image:</label>
        <input type="file" class="form-control" name="CAR_IMG" accept="image/*" required/>
        <small class="form-text text-muted">Please upload a clear image of the car</small>
      </div>
      
      <div class="form-group">
        <label for="available">Availability:</label>
        <select class="form-control" name="AVAILABLE" required>
          <option value="Y" {{ old('AVAILABLE', 'Y') == 'Y' ? 'selected' : '' }}>Available</option>
          <option value="N" {{ old('AVAILABLE') == 'N' ? 'selected' : '' }}>Not Available</option>
        </select>
      </div>
      
      <button type="submit" class="btn btn-primary">Add Car</button>
      <a href="{{ route('cars.index') }}" class="btn btn-secondary ml-2">Cancel</a>
    </form>
  </div>
</div>
@endsection