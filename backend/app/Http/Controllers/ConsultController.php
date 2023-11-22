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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Consult.add");
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
        
        consult::create($request->all());
         
        return redirect()->route('/agenda')
                        ->with('success','consult created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consult $consult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consult $consult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consult $consult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consult $consult)
    {
        //
    }
}
