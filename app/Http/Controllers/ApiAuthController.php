<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'profile_image'=>'nullable',
        ]);
        // return $request;
         $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'profile_image'=>$request->profile_image,
            'password' => bcrypt($request->password) ,
        ]);

         if(Auth::attempt($request->only(['email','password']))){
            $token = Auth::user()->createToken('phone')->plainTextToken;
            return response()->json($token);
        }
        return response()->json(['message' => 'user not found'],status:403);
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

        if(Auth::attempt($request->only(['email','password']))){
            $token = Auth::user()->createToken('phone')->plainTextToken;
            return response()->json([
                'user_id' => Auth::id(),
                'token' => $token,
                // 'auth' => new UserResource(Auth::user()),
            ]);
        }
         return response()->json(['message' => 'user not found'],status:403);
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
