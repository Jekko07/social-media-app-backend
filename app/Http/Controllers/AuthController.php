<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            "email" => "email|required",
            "name" => "string|required|min:2",
            "password" => "string|required|min:8"
        ]);

        //create user
        $newUser = User::create($validated);

        //login newly created user
        auth()->guard('web')->login($newUser);

        return ["message" => "success. new user created.", 201];
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            "email" => "email|required",
            "password" => "string|required|min:8"
        ]);

        //attempt to login
        if (auth()->guard('web')->attempt($validated, true)) {
            $request->session()->regenerate();

            return ["message" => "successfully logged in."];
        }

        return ["error" => "incorrect credentials."];
    }

    public function logout(Request $request)
    {
        //logout
        auth()->guard('web')->logout();

        //invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return ["message" => "logged out succesfully."];
    }
}
