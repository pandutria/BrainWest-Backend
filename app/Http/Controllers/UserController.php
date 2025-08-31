<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request) {
        try {
            $isAny = User::where('username', $request)->first();

            if ($isAny) {
                return response()->json([
                    'message' => 'Username already in use'
                ], 409);
            }

            $user = new User();
            $user->username = $request->username;
            $user->fullname = $request->fullname;
            $user->password = $request->password;
            $user->save();

            return response()->json([
                'message' => 'Register successfully!',
                'user' => $user
            ], 201);

        } catch(Exception $err) {
            return response()->json([
                'message' => $err->getMessage()
            ]);
        }
    }
}
