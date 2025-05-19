<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $Feedbacks = Feedback::all();
      
        return view('feedback.index',compact('Feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        return view('feedback.create',compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           
            'comment' => 'required|max:255',
            'user_id' => 'required|exists:users,id'

        ]);
        $show = Feedback::create($validatedData);
   
        return redirect('/feedback')->with('success', 'Your Feedback has been successfully updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Feedbacks = User::all();
        
        return view('feedback.index',compact('Feedbacks'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Feedback = Feedback::findOrFail($id);
        $users = \App\Models\User::all(); 
        return view('feedback.edit',compact('Feedback','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
           
           
            'comment' =>'max:255',
            'user_id' => 'required|exists:users,id',

        ]);

        Feedback::whereId($id)->update($validatedData);

        return redirect('/feedback')->with('success', 'Your Feedback has been successfully updated');
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Feedback = Feedback::findOrFail($id);
        $Feedback->delete();

        return redirect('/feedback')->with('success', 'Feedback is successfully deleted');
    }
}
