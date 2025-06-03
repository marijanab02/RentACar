<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserApiController extends Controller
{
    /**
     * @group Korisnici
     *
     * Dohvati sve korisnike
     *
     * Vraća popis svih korisnika u sustavu.
     *
     * @response 200 [
     *   {
     *     "id": 1,
     *     "fname": "Ana",
     *     "lname": "Anić",
     *     "email": "ana@example.com"
     *   }
     * ]
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * @group Korisnici
     *
     * Dodaj novog korisnika
     *
     * Sprema novog korisnika u bazu.
     *
     * @bodyParam fname string required Ime korisnika. Example: Ana
     * @bodyParam lname string required Prezime korisnika. Example: Anić
     * @bodyParam email string required Email adresa korisnika. Example: ana@example.com
     * @bodyParam password string required Lozinka korisnika. Example: tajna123
     * @bodyParam lic_num string Broj vozačke dozvole (opcionalno). Example: HR123456
     * @bodyParam phone_num string Broj telefona (opcionalno). Example: 0912345678
     * @bodyParam gender string Spol korisnika (opcionalno). Example: Žensko
     *
     * @response 201 {
     *   "message": "User created successfully",
     *   "user": {
     *     "id": 2,
     *     "fname": "Ana",
     *     "lname": "Anić",
     *     "email": "ana@example.com"
     *   }
     * }
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'lic_num' => 'nullable|string|max:255',
            'phone_num' => 'nullable|string|max:20',
            'gender' => 'nullable|string',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    /**
     * @group Korisnici
     *
     * Prikaz pojedinog korisnika
     *
     * Dohvaća korisnika prema ID-u.
     *
     * @urlParam id integer required ID korisnika. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "fname": "Ana",
     *   "lname": "Anić",
     *   "email": "ana@example.com"
     * }
     *
     * @response 404 {
     *   "message": "User not found"
     * }
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * @group Korisnici
     *
     * Ažuriraj korisnika
     *
     * Ažurira korisnika prema ID-u.
     *
     * @urlParam id integer required ID korisnika. Example: 1
     * @bodyParam fname string required Ime korisnika. Example: Ana
     * @bodyParam lname string required Prezime korisnika. Example: Anić
     * @bodyParam email string required Email korisnika. Example: ana@example.com
     * @bodyParam password string Lozinka korisnika (opcionalno). Example: novaLozinka123
     * @bodyParam lic_num string Broj vozačke (opcionalno). Example: HR123456
     * @bodyParam phone_num string Broj telefona (opcionalno). Example: 0912345678
     * @bodyParam gender string Spol korisnika (opcionalno). Example: Žensko
     *
     * @response 200 {
     *   "message": "User updated successfully",
     *   "user": {
     *     "id": 1,
     *     "fname": "Ana",
     *     "lname": "Anić",
     *     "email": "ana@example.com"
     *   }
     * }
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'lic_num' => 'nullable|string|max:255',
            'phone_num' => 'nullable|string|max:20',
            'gender' => 'nullable|string',
        ]);

        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    /**
     * @group Korisnici
     *
     * Obriši korisnika
     *
     * Briše korisnika prema ID-u.
     *
     * @urlParam id integer required ID korisnika. Example: 2
     *
     * @response 200 {
     *   "message": "User deleted successfully"
     * }
     *
     * @response 404 {
     *   "message": "User not found",
     *   "id_received": 99
     * }
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found',
                'id_received' => $id
            ], 404);
        }
    }
    public function __construct()
    {
        $this->middleware('auth.basic')->except(['store']);
    }
    
}
