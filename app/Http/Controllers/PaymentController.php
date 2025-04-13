<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Payments = Payment::paginate(10); 
        
        return view('payment.index',compact('Payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookings = Booking::with('car')
              ->where('book_status', '!=', Booking::STATUS_PAID)
              ->whereDoesntHave('payment')
              ->get();
              
        return view('payment.create', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'BOOK_ID' => 'required|exists:bookings,BOOK_ID',
            'CARD_NO' => 'required|regex:/^\d{16}$/',
            'EXP_DATE' => ['required', 'regex:/^(0[1-9]|1[0-2])\/?([0-9]{2})$/'],
            'CVV' => 'required|digits_between:3,4',
            'PRICE' => 'required|numeric|min:0'
        ]);

        try {
            // Provjera da li booking već ima payment
            $existingPayment = Payment::where('BOOK_ID', $validated['BOOK_ID'])->first();
            
            if ($existingPayment) {
                return back()->withErrors(['BOOK_ID' => 'Payment for this booking already exists'])->withInput();
            }

            // Formatiranje EXP_DATE
            $validated['EXP_DATE'] = str_replace('/', '', $validated['EXP_DATE']);

            // Kreiranje paymenta
            $payment = Payment::create($validated);

            // Ažuriranje statusa rezervacije
            Booking::where('BOOK_ID', $validated['BOOK_ID'])
                  ->update(['book_status' => 'PAID']);

            return redirect()->route('payment.index')
                           ->with('success', 'Payment created successfully!');

        } catch (\Exception $e) {
            \Log::error('Payment creation error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error creating payment. Please try again.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Payments = Payment::all();
        
        return view('payment.index',compact('Payments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);

        return view('payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'CARD_NO' => 'nullable|regex:/^\d{16}$/',
            'EXP_DATE' => ['required', 'regex:/^(0[1-9]|1[0-2])\/?([0-9]{2})$/'],
            'CVV' => 'nullable|digits_between:3,4',
            'PRICE' => 'nullable|numeric|min:0'
        ]);
    
        $payment = Payment::findOrFail($id);
        
        // Ažurirajte samo promijenjena polja
        if ($request->filled('CARD_NO')) {
            $payment->CARD_NO = $validated['CARD_NO'];
        }
        
        if ($request->filled('EXP_DATE')) {
            $payment->EXP_DATE = str_replace('/', '', $validated['EXP_DATE']);
        }
        
        if ($request->filled('CVV')) {
            $payment->CVV = $validated['CVV'];
        }
        
        if ($request->filled('PRICE')) {
            $payment->PRICE = $validated['PRICE'];
        }
        
        $payment->save();
    
        return redirect()->route('payment.index')
                       ->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect('/payment')->with('success', 'Payment is successfully deleted');
    
    }
}
