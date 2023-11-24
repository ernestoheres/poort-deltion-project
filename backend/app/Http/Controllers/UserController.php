<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\WhitelistedEmail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request) {
        $user = User::where('name', $request->name)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'token' => $token,
                        'id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                        'role' => $user->role
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password incorrect'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email does not exist'
            ]);
        }
    }

    public function register(Request $request) {
       $validated = $request->validate([
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'one_time_password' => 'required|string',
        ]);

        $whitelistedEmail = WhitelistedEmail::where('email', $validated['email'])->first();
        if ($whitelistedEmail) {
            if ($whitelistedEmail->one_time_password == $validated['one_time_password']) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => $whitelistedEmail->role
                ]);
                $whitelistedEmail->delete();
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                        'role' => $user->role
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'One time password incorrect'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email not whitelisted'
            ]);
        }	
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Token deleted'
        ]);
    }

    public function forgotPassword(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $validated['email'])->first();
        if ($user) {
            $user->password = Hash::make(bin2hex(random_bytes(4)));
            $user->save();
            //email verstuur functie
            $to = $validated['email'];
            $subject = "New password";
            $txt = "Your new password is: " . $user->password;
            $headers = "From:" . $user->email;

            mail($to,$subject,$txt,$headers);

            return response()->json([
                'status' => 'success',
                'message' => 'New password sent'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email does not exist'
            ]);
        }

    }

    public function changeEmail(Request $request) {
        $validated = $request->validate([
            'password' => 'required|string',
            'new_email' => 'required|email',
        ]);

        $user = $request->user();
        if(Hash::check($validated['password'], $user->password)) {
            $user->email = $validated['new_email'];
            $user->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Email changed'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Password incorrect'
            ]);
        }
    }

    public function changePassword(Request $request) {
        $validated = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string',
        ]);

        $user = $request->user();
        if(Hash::check($validated['old_password'], $user->password)) {
            $user->password = Hash::make($validated['new_password']);
            $user->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Password changed'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Password incorrect'
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
