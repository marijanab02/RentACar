<!-- index.blade.php -->

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
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>First name</td>
          <td>Last name</td>
          <td>Email </td>
          <td>Licence number</td>
          <td>Phone number</td>
          <td>Gender </td>

          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($Users as $User)
        <tr>
            <td>{{$User->id}}</td>
            <td>{{$User->fname}}</td>
            <td>{{$User->lname}}</td>
            <td>{{$User->email}}</td>
            <td>{{$User->lic_num}}</td>
            <td>{{$User->phone_num}}</td>
            <td>{{$User->gender}}</td>

            <td><a href="{{ route('user.edit', $User->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('user.destroy', $User->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{route('user.create')}}" class="btn btn-success mb-3">Add new user</a>

<div>
@endsection
