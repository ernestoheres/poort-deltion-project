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
    public function create(Request $request)
    {   $data = [
            "voornaam" => $request->$voornaam,
            "achternaam" => $request->$achternaam,
            "btijd" => $request->$btijd,
            "etijd" => $request->$etijd,
            "datum" => $request->$datum,
            "doctor" => $request->$doctor,
    ];
        Consult::create($data);
    


        return response("Consult created", 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'voornaam' => 'required',
        'achternaam' => 'required',
        'btijd' => 'required',
        'etijd' => 'required',
        'datum' => 'required',
        'doctor' => 'required',
        ]);
        
        $consult = Consult::create([
            'voornaam' => $request->input('voornaam'),
            'tussenvoegsels' => $request->input('tussenvoegsels'),
            'achternaam' => $request->input('achternaam'),
            'btijd' => $request->input('btijd'),
            'etijd' => $request->input('etijd'),
            'datum' => $request->input('datum'),
            'doctor' => $request->input('doctor'),
        ]);
         
        return response()->json($consult, 201);
    }

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
