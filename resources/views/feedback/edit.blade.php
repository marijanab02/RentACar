@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit your feedback
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
      <form method="post" action="{{ route('feedback.update', $Feedback->id ) }}">
       
        <div class="form-group">
            <label for="user_id">Korisnik (email):</label>
            <select class="form-control" name="user_id" required>
                <option value="">Odaberi korisnika</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                @endforeach
            </select>
        </div>

          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Comment:</label>
              <input type="text" class="form-control" name="comment" value="{{ $Feedback->comment }}"/>
            </div>
         


          <button type="submit" class="btn btn-primary">Update your feedback</button>
      </form>
  </div>
</div>
@endsection
