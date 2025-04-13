<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Bookings = Booking::all();
        
        return view('booking.index',compact('Bookings'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = \App\Models\Cars::where('AVAILABLE', 'Y')->get();
        return view('booking.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|integer',
		    'email' => 'required|max:255',
            'book_place' => 'required|max:255',
            'book_date' => 'required',
            'duration' => 'required|integer',
            'phone_num' => 'required|max:255',
            'destination' => 'required|max:255',
            'return_date' => 'required',
            'price' => 'required|integer',
            'book_status' => 'required|max:255',

        ]);
        $show = Booking::create($validatedData);
   
        return redirect('/booking')->with('success', 'Booking is successfully created');    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Bookings = Booking::all();
        
        return view('booking.index',compact('Bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Booking = Booking::where('BOOK_ID', $id)->firstOrFail();

        return view('booking.edit', compact('Booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|integer',
		    'email' => 'required|max:255',
            'book_place' => 'required|max:255',
            'book_date' => 'required|date',
            'duration' => 'required|integer',
            'phone_num' => 'required|max:255',
            'destination' => 'required|max:255',
            'return_date' => 'required|date',
            'price' => 'required|integer',
            'book_status' => 'required|max:255',
        ]);
        Booking::where('BOOK_ID', $id)->update($validatedData);

        return redirect('/booking')->with('success', 'Booking successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Booking = Booking::findOrFail($id);
        $Booking->delete();

        return redirect('/booking')->with('success', 'Booking destroyed');    }
}
