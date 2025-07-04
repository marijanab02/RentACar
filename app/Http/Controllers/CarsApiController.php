<?php



namespace App\Http\Controllers;
use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class CarsApiController extends Controller
{
    
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
            'CAR_NAME'  => 'required|string|max:255',
            'FUEL_TYPE' => 'required|in:PETROL,DIESEL,GAS,ELECTRIC',
            'CAPACITY'  => 'required|integer|min:2|max:20',
            'PRICE'     => 'required|numeric|min:0',
            'AVAILABLE' => 'required|in:Y,N',
            'CAR_IMG'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // DEBUG: provjeravamo je li file prisutan
        \Log::info('hasFile CAR_IMG? ' . ($request->hasFile('CAR_IMG') ? 'YES' : 'NO'));
        \Log::info('File object: ', [
            'CAR_IMG' => $request->file('CAR_IMG')
        ]);

        // Ako ga stisneš dd, Laravel će samo ispisati taj objekt i prekinuti:
        // dd($request->file('CAR_IMG'));

        if ($request->hasFile('CAR_IMG')) {
            $file = $request->file('CAR_IMG');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Eksplicitno koristite 'public' disk
            $path = Storage::disk('public')->putFileAs('cars', $file, $filename);
            
            // Logging za debug
            $fullPath = Storage::disk('public')->path('cars/'.$filename);
            \Log::info('Postoji li fajl: ' . (file_exists($fullPath) ? 'DA' : 'NE'));
            
            $validatedData['CAR_IMG'] = 'cars/' . $filename;
        }


        $cars = Cars::create($validatedData);
        return response()->json([
            'message' => 'Car created successfully',
            'cars'    => $cars
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
        $car = Cars::findOrFail($id);

        $validatedData = $request->validate([
            'CAR_NAME'  => 'required|string|max:255',
            'FUEL_TYPE' => 'required|in:PETROL,DIESEL,GAS,ELECTRIC',
            'CAPACITY'  => 'required|integer|min:2|max:20',
            'PRICE'     => 'required|numeric|min:0',
            'AVAILABLE' => 'required|in:Y,N',
            'CAR_IMG'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('CAR_IMG')) {
            // 1) Obriši staru sliku (ako postoji)
            if ($car->CAR_IMG) {
                Storage::disk('public')->delete($car->CAR_IMG);
            }

            // 2) Pohrani novu sliku (konsistentno sa store metodom)
            $file = $request->file('CAR_IMG');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('cars', $file, $filename);

            // 3) U validirani array stavi relativnu putanju
            $validatedData['CAR_IMG'] = $path;
        } else {
            // Nema nove slike → zadrži staru putanju
            $validatedData['CAR_IMG'] = $car->CAR_IMG;
        }

        // Ažuriraj model
        $car->update($validatedData);

        return response()->json([
            'message' => 'Car updated successfully',
            'cars'    => $car
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
