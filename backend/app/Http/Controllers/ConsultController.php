<?php

namespace App\Http\Controllers;

use App\Models\Consult;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consult = Consult::latest()->paginate(99);

        return response()->json($consult);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {   
    $validated = $request->validate([
        'client_id' => 'required|int',
        'btijd' => 'required|string',
        'etijd' => 'required|string',
        'datum' => 'required|string',
        'doctor_id' => 'required|int',
    ]);
        Consult::create($validated);
        return response("Consult created", 201);
    }
    /**
     * Store a newly created resource in storage.
     */
   
    /**
     * Display the specified resource.
     */
    public function showConsult(Consult $consult)
    {
        return view('Consult.show',compact('Consult'));
    }

    public function updateConsult(Request $request, Consult $consult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyConsult(Consult $consult)
    {
        $consult->delete();
    }
}
