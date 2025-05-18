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
          
          <td>Email </td>
          <td>Comment</td>
        
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($Feedbacks as $Feedback)
        <tr>
            <td>{{$Feedback->id}}</td>
            <td>{{$Feedback->user->email ?? 'N/A' }}</td>
            <td>{{$Feedback->comment}}</td>
       

            <td><a href="{{ route('feedback.edit', $Feedback->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('feedback.destroy', $Feedback->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{route('feedback.create')}}" class="btn btn-success mb-3">Add a feedback</a>

<div>
@endsection
