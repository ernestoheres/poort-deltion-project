<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function index(Request $request, $client_id)
    {
        $user = $request->user();
        if($user->role != "doctor") {
            if($user->id != $client_id) {
                return response("Unauthorized", 401);
            }
        }

        $notes = Note::where('client_id', $client_id)->latest()->get();
        return response()->json($notes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'client_id' => 'required|integer',
        ]);

        $note = Note::create([
            'content' => $request->input('content'),
            'client_id' => $request->input('client_id'),
        ]);

        return response()->json($note, 201);
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // Update note
        $note->update([
            'content' => $request->input('content'),
        ]);

        return response()->json($note);
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json(null, 204);
    }

}


