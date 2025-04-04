<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signup(Request $request){
        $request->validate([
             'name' => 'required|string',
             'email' => 'required|email|unique:users',
              'password' => 'required|min:6,',
              'role' => 'required|in:admin,manager,student'
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json(['token' => $user->createToken('API TOKEN')->plainTextToken]);
    }

    public function login(Request $request){
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages(['email' => ['Invalid credentials']]);
            }
    
            return response()->json(['token' => $user->createToken('API Token')->plainTextToken]);
        
    }

    public function logout(Request $request){
              $request->user()->tokens()->delete();
              return response()->json(['message' => 'Logged Out']);
    }
}
