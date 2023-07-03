<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        //
        $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:11',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'confirm_password' => 'same:password',
        'profile_image' => 'nullable',
    ]);

    $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'profile_image' => $request->profile_image,
        'password' => bcrypt($request->password),
    ]);

    $token = $user->createToken('phone')->plainTextToken;

    $data = [
        'name' => $user->name,
        'email' => $user->email,
        'password' => bcrypt($request->password),
        'phone' => $user->phone,
        'profile_image' => $user->profile_image,
        'token' => $token,
    ];

    return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {

        $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'User not found'], 403);
    }

    $token = $user->createToken('phone')->plainTextToken;

    $data = [
        'email' => $user->email,
        'token' => $token,
         'password' => bcrypt($request->password),
        'success' => true,
        'message' => 'Successfully logged in',
    ];

    return response()->json($data);
}


    /**
     * Display the specified resource.
     */
    public function logout()
    {
          Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'deleted'],status:204);
    }

    /**
     * Update the specified resource in storage.
     */
    public function logoutAll() {
            Auth::user()->currentAccessToken()->delete();
            return response()->json(['message' => 'deleted'],status:204);
        }

    /**
     * Remove the specified resource from storage.
     */
  public function tokens() {
        return Auth::user()->tokens;
    }
}
