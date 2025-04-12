<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Users = User::all();
        
        return view('user.index',compact('Users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|max:255',
		    'lname' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'lic_num' => 'required|max:255',
            'phone_num' => 'required|max:255',
            'gender' => 'required|max:255',

        ]);
        $show = User::create($validatedData);
   
        return redirect('/user')->with('success', 'New User is successfully created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Users = User::all();
        
        return view('user.index',compact('Users'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $User = User::findOrFail($id);

        return view('user.edit', compact('User'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'fname' => 'max:255',
            'lname' => 'max:255',
            'email' => 'max:255',
            'password' => 'max:255',
            'lic_num' => 'max:255',
            'phone_num' => 'max:255',
            'gender' => 'max:255',
        ]);
        User::whereId($id)->update($validatedData);

        return redirect('/user')->with('success', 'Useer Data is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $User = User::findOrFail($id);
        $User->delete();

        return redirect('/user')->with('success', 'User is successfully deleted');
    }
}
