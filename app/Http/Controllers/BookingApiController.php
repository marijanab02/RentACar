<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return response()->json($bookings);
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return response()->json($booking);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|integer',
            'book_place' => 'required|string|max:255',
            'book_date' => 'required|date',
            'duration' => 'required|integer',
            'phone_num' => 'nullable|string|max:20',
            'destination' => 'nullable|string|max:255',
            'return_date' => 'nullable|date',
            'price' => 'required|numeric',
            'book_status' => 'required|string|in:PENDING,PAID,CANCELLED',
            'user_id' => 'required|integer',
        ]);

        $booking = Booking::create($validatedData);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $validatedData = $request->validate([
            'car_id' => 'sometimes|required|integer',
            'book_place' => 'sometimes|required|string|max:255',
            'book_date' => 'sometimes|required|date',
            'duration' => 'sometimes|required|integer',
            'phone_num' => 'nullable|string|max:20',
            'destination' => 'nullable|string|max:255',
            'return_date' => 'nullable|date',
            'price' => 'sometimes|required|numeric',
            'book_status' => 'sometimes|required|string|in:PENDING,PAID,CANCELLED',
            'user_id' => 'sometimes|required|integer',
        ]);

        $booking->update($validatedData);

        return response()->json([
            'message' => 'Booking updated successfully',
            'booking' => $booking
        ]);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json([
            'message' => 'Booking deleted successfully'
        ]);
    }
}