<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $input=$request->except('password');
        $input['password']=bcrypt($request->password);

        $user = User::create($input);

        return $user;
    }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:8'
        ]);

        if (!Auth::attempt($attr)) {
            return 'Authentikasi tidak berhasil';
        }

        $user=auth()->user();
        $user["token"]=auth()->user()->createToken('API Token')->plainTextToken;

        return $user;
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return "Logout berhasil";
    }

    public function getAuthenticatedUser()
    {
        // the token is valid and we have found the user via the sub claim
        return auth()->user();
    }
}
