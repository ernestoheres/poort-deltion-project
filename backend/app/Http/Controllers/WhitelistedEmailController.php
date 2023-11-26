<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhitelistedEmail;
use App\Mail\AccountCreatedMail;
use Illuminate\Support\Facades\Mail;

class WhitelistedEmailController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email|unique:whitelisted_emails',
            'role' => 'required|string',
        ]);

        $user = $request->user();
        $granted_by = $user->id;
        $validated['granted_by'] = $granted_by;

        $validated['one_time_password'] = bin2hex(random_bytes(4));

        //email verstuur functie
        try {
            Mail::to($validated['email'])->send(new AccountCreatedMail($validated['one_time_password']));
        } catch (\Throwable $th) {
            // allow for email to be created even if email fails to send
        }

      
        WhitelistedEmail::create($validated);

        return response("WhitelistedEmail created", 201);
    }

    public function getAllWhitelistedEmails(Request $request) {
        $whitelistedEmails = WhitelistedEmail::all();
        return response($whitelistedEmails, 200);
    }

    public function destroy(Request $request, $id) {
        $whitelistedEmail = WhitelistedEmail::find($id);
        $whitelistedEmail->delete();
        return response("WhitelistedEmail deleted", 200);
    }

  
}
