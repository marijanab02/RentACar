<?php

namespace App\Http\Controllers;
use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CarsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars=Cars::all();
		return response()->json($cars);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'CAR_NAME' => 'required|string|max:255',
            'FUEL_TYPE' => 'required|in:PETROL,DIESEL,GAS,ELECTRIC',
            'CAPACITY' => 'required|integer|min:2|max:20',
            'PRICE' => 'required|numeric|min:0',
            'AVAILABLE' => 'required|in:Y,N',
            'CAR_IMG' => 'nullable|string'
        ]);

        $cars = Cars::create($validatedData);

        return response()->json([
            'message' => 'Car created successfully',
            'cars' => $cars
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Cars::where('CAR_ID', $id)->first();

    if ($car) {
        return response()->json($car);
    } else {
        return response()->json([
            "message" => "Car not found",
            "id_received" => $id
        ], 404);
    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
			'CAR_NAME' => 'required|string|max:255',
            'FUEL_TYPE' => 'required|in:PETROL,DIESEL,GAS,ELECTRIC',
            'CAPACITY' => 'required|integer|min:2|max:20',
            'PRICE' => 'required|numeric|min:0',
            'AVAILABLE' => 'required|in:Y,N'
		]);

		$cars = Cars::findOrFail($id);
		$cars->update($validatedData);

		return response()->json([
			'message' => 'Game updated successfully', 
			'cars' => $cars
			]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
			$cars = Cars::findOrFail($id);
			$cars->delete();
			return response()->json(['message' => 'Game deleted successfully']);
		}
		catch (ModelNotFoundException $e){

			return response([
				'status' => 'ERROR',
				'message' => '404 not found',
				'description' => $e->getMessage(),
				'code' => $e->getCode()
				], 404);
		}
    }
}
