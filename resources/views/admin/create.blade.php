@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
  
</style>
<div class="card uper">
  <div class="card-header">
    Dodaj novog administratora
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
      <form method="post" action="{{ route('admin.store') }}">
          @csrf
          <div class="form-group">
              <label for="admin_id">Admin ID:</label>
              <input type="text" class="form-control" name="ADMIN_ID" required/>
              <small class="form-text text-muted">Unesite jedinstveni ID za administratora</small>
          </div>

          <div class="form-group">
              <label for="password">Lozinka:</label>
              <input type="password" class="form-control" name="ADMIN_PASSWORD" required/>
              <small class="form-text text-muted">Lozinka mora imati najmanje 6 znakova</small>
          </div>

          <button type="submit" class="btn btn-primary">Dodaj administratora</button>
          <a href="{{ route('admin.index') }}" class="btn btn-secondary">Odustani</a>
      </form>
  </div>
</div>
@endsection