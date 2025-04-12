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
        return view('feedback.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|max:255',
            'comment' => 'required|max:255',
            

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
        return view('feedback.edit',compact('Feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
           
            'email' => 'max:255',
            'comment' =>'max:255',
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
