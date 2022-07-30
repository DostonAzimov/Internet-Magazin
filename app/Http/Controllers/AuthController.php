<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();


        $token = $user->createToken('API Token')->plainTextToken;
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully register',
            'data' => $token
        ], $code);
    }

    public function login(Request $request)
    {
       $attr= $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);
        if (!Auth::attempt($attr))
        {
            return $this->error('Credential not match',401);
        }
        $token = auth()->user()->createToken('API Token')->plainTextToken;
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully login',
            'data' => $token
        ], $code);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully logout',
        ], $code);
    }




}
