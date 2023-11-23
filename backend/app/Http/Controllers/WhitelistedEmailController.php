<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhitelistedEmail;

class WhitelistedEmailController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email|unique:whitelisted_emails',
            'role' => 'required|string',
            'granted_by' => 'required|integer',
        ]);

        $validated['one_time_password'] = bin2hex(random_bytes(4));

        //email verstuur functie
        $to = $validated['email'];
        $subject = "One time password";
        $txt = "Your one time password is: " . $validated['one_time_password'];
        $headers = "From:" . $validated['granted_by'];

        mail($to,$subject,$txt,$headers);

      
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
