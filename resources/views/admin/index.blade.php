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
    <h2>Administrators List</h2>
    <a href="{{ route('admin.create') }}" class="btn btn-success">Add New Admin</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Admin ID</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          @forelse($admins as $admin)
          <tr>
              <td>{{ $admin->id }}</td>
              <td>{{ $admin->ADMIN_ID }}</td>
              <td>{{ $admin->created_at->format('d.m.Y. H:i') }}</td>
              <td>{{ $admin->updated_at->format('d.m.Y. H:i') }}</td>
              <td class="text-right">
                <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-primary btn-sm">Edit</a>
              </td>
              <td class="text-left">
                <form action="{{ route('admin.destroy', $admin->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
                </form>
              </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">No administrators found</td>
          </tr>
          @endforelse
      </tbody>
    </table>
  </div>
  
  <!-- Pagination -->
  @if($admins->hasPages())
  <div class="d-flex justify-content-center">
    {{ $admins->links() }}
  </div>
  @endif
</div>
@endsection