<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\AdministratorNotePermission;
use App\Models\User;

class NoteController extends Controller
{
    public function index(Request $request, $client_id)
    {
        $user = $request->user();
        if($user->role != "doctor") {
            if($user->role == "administrator") {
                // check for rows with permission
                $RowsWithPermission = AdministratorNotePermission::where('administrator_id', $user->id)->where("client_id", $client_id)->get();

                $notes = [];
                foreach($RowsWithPermission as $row) {
                    $row->note = Note::find($row->note_id);
                    $row->note->decryptAllAttributes();
                    array_push($notes, $row->note);
                }

                return response()->json($notes);

            }
            if($user->id != $client_id) {
                return response("Unauthorized", 401);
            }
        }

        $notes = Note::where('client_id', $client_id)->latest()->get();

        foreach ($notes as $note) {
            $note->decryptAllAttributes();
        }
        return response()->json($notes);
    }

    public function GrantNoteAdministratorPermission(Request $request) {

        $validated = $request->validate([
            'note_id' => 'required|integer',
            'administrator_id' => 'required|integer',
            "client_id" => "required|integer",
        ]);

        $note = Note::find($validated['note_id']);
        if(!$note) {
            return response("Note not found", 404);
        }
        $administrator = User::find($validated['administrator_id']);
        if(!$administrator || $administrator->role != "administrator") {
            return response("Administrator not found", 404);
        }
        $client = User::find($validated['client_id']);
        if(!$client || $client->role != "client") {
            return response("Client not found", 404);
        }

        $permission = AdministratorNotePermission::create([
            'note_id' => $validated['note_id'],
            'administrator_id' => $validated['administrator_id'],
            'client_id' => $validated['client_id'],
        ]);

        return response($permission, 201);
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

        $note->decryptAllAttributes();

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

    public function destroy(Request $request, $client_id, $note_id)
    {

        $note = Note::where('id', $note_id)->where('client_id', $client_id)->first();

        if (!$note) {
            return response("Note not found", 404);
        }

        $user = $request->user();
        if ($user->role != "doctor" && $user->id != $client_id) {
            return response("Unauthorized", 401);
        }

        $note->delete();

        return response()->json(null, 204);
    }

}
