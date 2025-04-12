@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit User Data
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
      <form method="post" action="{{ route('user.update', $User->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">User first name:</label>
              <input type="text" class="form-control" name="fname" value="{{ $User->fname }}"/>
          </div>

          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">User last name:</label>
              <input type="text" class="form-control" name="lname" value="{{ $User->lname }}"/>
          </div>  

          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Email:</label>
              <input type="text" class="form-control" name="email" value="{{ $User->email }}"/>
          </div>


          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Password:</label>
              <input type="text" class="form-control" name="password" value="{{ $User->password }}"/>
              <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Licence number:</label>
              <input type="text" class="form-control" name="lic_num" value="{{ $User->lic_num }}"/>
          </div>
        
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Phone number:</label>
              <input type="text" class="form-control" name="phone_num" value="{{ $User->phone_num }}"/>
          </div>

          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Gender:</label>
              <input type="text" class="form-control" name="gender" value="{{ $User->gender }}"/>
          </div>

          <button type="submit" class="btn btn-primary">Update  user data</button>
      </form>
  </div>
</div>
@endsection
