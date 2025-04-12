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
    Add User
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
      <form method="post" action="{{ route('user.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">User first name:</label>
              <input type="text" class="form-control" name="fname"/>
          </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Last name:</label>
              <input type="text" class="form-control" name="lname"/>
          </div>

          <div class="form-group">
              <label for="cases">Email :</label>
              <input type="text" class="form-control" name="email"/>
          </div>

          <div class="form-group">
              <label for="cases">Password :</label>
              <input type="text" class="form-control" name="password"/>
          </div>

          <div class="form-group">
              <label for="cases">Licence number :</label>
              <input type="text" class="form-control" name="lic_num"/>
          </div>
        
          <div class="form-group">
              <label for="cases">Phone number :</label>
              <input type="text" class="form-control" name="phone_num"/>
          </div>

          <div class="form-group">
              <label for="cases">Gender :</label>
              <input type="text" class="form-control" name="gender"/>
          </div>

          



          <button type="submit" class="btn btn-primary">Add User</button>
      </form>
  </div>
</div>
@endsection
