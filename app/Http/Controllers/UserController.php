<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) 
    {
        try {
            $isAny = User::where('username', $request->username)->first();

            if ($isAny) {
                return response()->json([
                    'message' => 'Nama Pengguna Sudah Digunakan!'
                ], 403);
            }

            $user = new User();
            $user->username = $request->username;
            $user->fullname = $request->fullname;
            $user->password = $request->password;
            $user->role = "user";
            $user->save();

            return response()->json([
                'message' => 'Daftar Berhasil!',
                'data' => $user
            ], 201);

        } catch(Exception $err) {
            return response()->json([
                'message' => $err->getMessage()
            ], 422);
        }
    }

    public function login(Request $request) 
    {
        try {
            $user = User::where("username", $request->username)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    "message" => "Nama atau Kata Sandi Salah!"
                ], 401);
            }
            
            $token = $user->createToken("access_token")->plainTextToken;
            return response()->json([
                "message" => "Masuk Berhasil!",
                "token" => $token,
                "data" => $user
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }

    public function me() 
    {
        try {
            $user = Auth::user();
            return response()->json([
                "data" => $user,
            ]);
        } catch (Exception $err) {
            return response()->json([
                "message" => $err->getMessage()
            ], 422);
        }
    }
}
