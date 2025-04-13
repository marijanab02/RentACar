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
          <td>CAR ID</td>
          <td>Email</td>
          <td>Booking place </td>
          <td>Booking date</td>
          <td>Duration</td>
          <td>Phone number </td>
          <td>Destination </td>
          <td> Return date </td>
          <td> Price </td>
          <td> Booking status</td>





          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($Bookings as $Booking)
        <tr>
            <td>{{$Booking->BOOK_ID}}</td>
            <td>{{$Booking->car_id}}</td>
            <td>{{$Booking->email}}</td>
            <td>{{$Booking->book_place}}</td>
            <td>{{$Booking->book_date}}</td>
            <td>{{$Booking->duration}}</td>
            <td>{{$Booking->phone_num}}</td>
            <td>{{$Booking->destination}}</td>
            <td>{{$Booking->return_date}}</td>
            <td>{{$Booking->price}}</td>
            <td>{{$Booking->book_status}}</td>



            <td><a href="{{ route('booking.edit', $Booking->BOOK_ID)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('booking.destroy', $Booking->BOOK_ID)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{route('booking.create')}}" class="btn btn-success mb-3">Add new booking</a>

<div>
@endsection
