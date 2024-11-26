<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
    //
    public function register(Request $request) {
        $input = [
            "name" => $request->name,
            "password" => Hash::make($request->password),
            "email" => $request->email,
        ];

        $admin = Admin::create($input);

        return response()->json([
            "status" => "success",
            "message" => "Register Success", 
        ]);
    }

    public function login(Request $request) {
        $input = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        
        $admin = Admin::where("email", $input["email"])->first();
        if ($admin && Hash::check($input["password"], $admin->password)) {
            $token = $admin->createToken("token")->plainTextToken;
            return response()->json([
                "code" => 200,
                "status" => "success",
                "message" => "Login Success",
                "token" => $token
            ]);
        } else {
            return response()->json([
                "code" => 401,
                "status" => "error",
                "message" => "Login Failed"
            ]);
        }
    }
}    
    
