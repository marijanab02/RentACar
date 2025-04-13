@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
  
</style>
<div class="card uper">
  <div class="card-header">
    Uredi Administratora
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
      <form method="post" action="{{ route('admin.update', $admin->id) }}">
          @csrf
          @method('PATCH')
          
          <div class="form-group">
              <label for="admin_id">Admin ID:</label>
              <input type="text" class="form-control" name="ADMIN_ID" value="{{ $admin->ADMIN_ID }}" required/>
              <small class="form-text text-muted">Unesite jedinstveni ID za administratora</small>
          </div>

          <div class="form-group">
              <label for="password">Nova lozinka:</label>
              <input type="password" class="form-control" name="ADMIN_PASSWORD"/>
              <small class="form-text text-muted">Ostavite prazno ako ne želite promijeniti lozinku</small>
          </div>

          <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">Ažuriraj Administratora</button>
              <a href="{{ route('admin.index') }}" class="btn btn-secondary">Odustani</a>
          </div>
      </form>
  </div>
</div>
@endsection