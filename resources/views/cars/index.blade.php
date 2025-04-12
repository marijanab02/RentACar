@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
  .car-img-thumbnail {
    max-width: 100px;
    max-height: 60px;
    border-radius: 4px;
  }
  .availability-badge {
    font-size: 0.8rem;
    padding: 0.35em 0.65em;
  }
  .pagination {
    font-size: 0.9rem;
}

.pagination .page-link {
    padding: 0.3rem 0.6rem;
}

.pagination .page-item:first-child .page-link,
.pagination .page-item:last-child .page-link {
    font-size: 0.8rem;
    padding: 0.25rem 0.5rem;
}
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Cars List</h2>
    <a href="{{ route('cars.create') }}" class="btn btn-success">Add New Car</a>
  </div>

  <table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Car Name</th>
          <th>Fuel Type</th>
          <th>Capacity</th>
          <th>Price (€/day)</th>
          <th>Status</th>
          <th colspan="2" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cars as $car)
        <tr>
            <td>{{ $car->CAR_ID }}</td>
            <td>
                <img src="{{ asset('storage/' . $car->CAR_IMG) }}" alt="{{ $car->CAR_NAME }}" class="car-img-thumbnail">
            </td>
            <td>{{ $car->CAR_NAME }}</td>
            <td>{{ ucfirst(strtolower($car->FUEL_TYPE)) }}</td>
            <td>{{ $car->CAPACITY }} seats</td>
            <td>{{ number_format($car->PRICE, 2) }}</td>
            <td>
              <span class="badge {{ $car->AVAILABLE == 'Y' ? 'badge-success' : 'badge-danger' }} availability-badge">
                {{ $car->AVAILABLE == 'Y' ? 'Available' : 'Not Available' }}
              </span>
            </td>
            <td class="text-right">
              <a href="{{ route('cars.edit', $car->CAR_ID) }}" class="btn btn-primary btn-sm">Edit</a>
            </td>
            <td class="text-left">
              <form action="{{ route('cars.destroy', $car->CAR_ID) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
              </form>
            </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center">No cars found</td>
        </tr>
        @endforelse
    </tbody>
  </table>
  
  <!-- Pagination (opcionalno) -->
  @if($cars->hasPages())
  <div class="d-flex justify-content-center">
    {{ $cars->links() }}
  </div>
  @endif
</div>
@endsection