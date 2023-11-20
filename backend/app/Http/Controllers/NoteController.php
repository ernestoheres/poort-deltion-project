<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Intervention\Image\Facades\Image;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::latest()->get(); // Fetch notes in descending order based on creation time
        return response()->json($notes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $note = Note::create([
            'content' => $request->input('content'),
        ]);

        return response()->json($note, 201); // Return the created note
    }

    public function show(Note $note)
    {
        return response()->json($note);
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

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
