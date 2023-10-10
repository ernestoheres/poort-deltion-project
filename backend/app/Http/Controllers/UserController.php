<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
                        'email' => $user->email,
                        'name' => $user->name
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
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];
        $user = User::create($data);
        return response()->json([
            'status' => 'success registered successfully',
            'data' => [
                'token' => $user->createToken('auth_token')->plainTextToken,
                'email' => $user->email,
                'name' => $user->name
            ]
        ]);
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
