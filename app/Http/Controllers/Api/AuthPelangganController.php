<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthPelangganController extends Controller
{
    //
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'nama' =>'required|string|max:255',
            'nik' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:pelanggan',
            'password' => 'nullable|string|min:8',
            'no_hp' =>'required|string|max:255',
            'alamat_lengkap' =>'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $input = [
            "nama" => $request->nama,
            "nik" => $request->nik,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "no_hp" => $request->no_hp,
            "alamat_lengkap" => $request->alamat_lengkap
        ];

        $pelanggan = Pelanggan::create($input);

        return response()->json([
            "code" => 200,
            "status" => "success",
            "message" => "Register Success", 
        ]);
    }

    public function login(Request $request) {
        $input = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        
        $pelanggan = Pelanggan::where("email", $input["email"])->first();
        if ($pelanggan && Hash::check($input["password"], $pelanggan->password)) {
            $token = $pelanggan->createToken('token', ['pelanggan'])->plainTextToken;
            return response()->json([
                "code" => 200,
                "status" => "success",
                "message" => "Login Success",
                "token" => $token,
                "name" => $pelanggan->nama,
                "email" => $pelanggan->email,
                "role" => "pelanggan",
                "pelanggan_id" => $pelanggan->id,  // Menambahkan id pelanggan
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

        $status = Password::broker('pelanggan')->sendResetLink(
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

        $status = Password::broker('pelanggan')->reset(
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
