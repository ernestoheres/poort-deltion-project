<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Intervention\Image\Facades\Image;

class NoteController extends Controller
{
    public function index($client_id)
    {
        // Fetch notes filtered by client_id
        $notes = Note::where('client_id', $client_id)->latest()->get();
        return response()->json($notes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'client_id' => 'required|integer',
        ]);

        // Create note with client_id
        $note = Note::create([
            'content' => $request->input('content'),
            'client_id' => $request->input('client_id'),
        ]);

        return response()->json($note, 201);
    }

    public function update(Request $request, $client_id, Note $note)
    {
        // Validate request
        $request->validate([
            'content' => 'required|string',
            // Add any other necessary validations
        ]);

        // Update note
        $note->update([
            'content' => $request->input('content'),
            // Handle any other fields if necessary
        ]);

        return response()->json($note);
    }

    public function destroy($client_id, Note $note)
    {
        // Perform any necessary checks based on client_id
        // Delete note
        $note->delete();

        return response()->json(null, 204);
    }

}


