<?php

namespace App\Http\Controllers;
use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Cars::paginate(10); // Umjesto Cars::all()
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CAR_NAME' => 'required|string|max:255',
            'FUEL_TYPE' => 'required|in:PETROL,DIESEL,GAS,ELECTRIC',
            'CAPACITY' => 'required|integer|min:2|max:20',
            'PRICE' => 'required|numeric|min:0',
            'CAR_IMG' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'AVAILABLE' => 'required|in:Y,N'
        ]);

        if ($request->hasFile('CAR_IMG')) {
            $file = $request->file('CAR_IMG');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Eksplicitno koristite 'public' disk
            $path = Storage::disk('public')->putFileAs('cars', $file, $filename);
            
            // Logging za debug
            $fullPath = Storage::disk('public')->path('cars/'.$filename);
            \Log::info('Postoji li fajl: ' . (file_exists($fullPath) ? 'DA' : 'NE'));
            
            $validated['CAR_IMG'] = 'cars/' . $filename;
        }

        Cars::create($validated);

        return redirect()->route('cars.index')
                         ->with('success', 'Car added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cars $car)
    {
        $car = Cars::all();
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cars $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cars $car)
    {
        $validated = $request->validate([
            'CAR_NAME' => 'required|string|max:255',
            'FUEL_TYPE' => 'required|in:PETROL,DIESEL,GAS,ELECTRIC',
            'CAPACITY' => 'required|integer|min:2|max:20',
            'PRICE' => 'required|numeric|min:0',
            'CAR_IMG' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'AVAILABLE' => 'required|in:Y,N'
        ]);

        // Ažuriranje slike ako je uploadana nova
        if ($request->hasFile('CAR_IMG')) {
            // Obriši staru sliku
            Storage::delete('public/' . $car->CAR_IMG);
            
            $path = $request->file('CAR_IMG')->store('public/cars');
            $validated['CAR_IMG'] = str_replace('public/', '', $path);
        } else {
            $validated['CAR_IMG'] = $car->CAR_IMG;
        }

        $car->update($validated);

        return redirect()->route('cars.index')
                         ->with('success', 'Car updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cars $car)
    {
        // Obriši sliku prije brisanja automobila
        Storage::delete('public/' . $car->CAR_IMG);
        
        $car->delete();

        return redirect()->route('cars.index')
                         ->with('success', 'Car deleted successfully!');
    }
}