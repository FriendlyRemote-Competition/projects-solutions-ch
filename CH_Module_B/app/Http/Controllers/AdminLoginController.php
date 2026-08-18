<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminLoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $user = User::where("email", $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->update(["token" => Str::random(60)]);
            return response()->json([
                "data" => [
                    "token" => $user->token,
                    "user" => $user->setVisible(["email", "name", "role"])->toArray(),
                ],
            ]);
        }

        return response()->json(["message" => "Invalid credentials"], 401);
    }
}
