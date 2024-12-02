<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

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
            $token = $admin->createToken('token', ['admin'])->plainTextToken;
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

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('admin')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 500);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);

        $status = Password::broker('admin')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($pelanggan, $password) {
                $pelanggan->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 500);
    }

    public function showResetForm(Request $request, $token)
    {
        // Return a JSON response or a view for the reset password form
        return response()->json([
            'token' => $token,
            'email' => $request->email,
        ]);
    }
}    
    
