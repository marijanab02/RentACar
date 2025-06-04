<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // GET /api/bookings
    public function index()
    {
        return response()->json(Booking::all());
    }

    // POST /api/bookings
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

    // GET /api/bookings/{id}
    public function show(string $id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            return response()->json($booking);
        }

        return response()->json([
            'message' => 'Booking not found',
            'id_received' => $id
        ], 404);
    }

    // PUT/PATCH /api/bookings/{id}
    public function update(Request $request, string $id)
    {
        try {
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
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Booking not found',
                'id_received' => $id
            ], 404);
        }
    }

    // DELETE /api/bookings/{id}
    public function destroy(string $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();

            return response()->json([
                'message' => 'Booking deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Booking not found',
                'id_received' => $id
            ], 404);
        }
    }
}
