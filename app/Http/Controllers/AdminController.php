<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(10);
        
        return view('admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ADMIN_ID' => 'required|unique:admins',
            'ADMIN_PASSWORD' => 'required|min:6',

        ]);
        $show = Admin::create($validatedData);
   
        return redirect('/admin')->with('success', 'New Admin is successfully created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Admins = Admin::all();
        
        return view('admin.index',compact('Admins'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'ADMIN_ID' => 'required|unique:admins,ADMIN_ID,',
            'ADMIN_PASSWORD' => 'nullable|min:6',
        ]);
        Admin::whereId($id)->update($validatedData);

        return redirect('/admin')->with('success', 'Admin Data is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Admin = Admin::findOrFail($id);
        $Admin->delete();

        return redirect('/admin')->with('success', 'Admin is successfully deleted');
    
    }
}
