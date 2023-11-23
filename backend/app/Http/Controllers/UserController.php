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
