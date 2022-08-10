<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        // echo 'plaese Login';die();
        // $password = 'Taher';
        // $password = Hash::make($password);
        return response()->json(['status' => 401, 'data' => array(), 'message' => 'UnAuthrize : Please Login']);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json(
                [
                    array(
                        'error' => 1,
                        'message' => 'Invalid login details'
                    )
                ],
                401
            );
        }

        $user = User::where('username', $request['username'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function me(Request $request)
    {
        return $request->user();
    }
    
    public function getMapBoxToken()
    {
        $map_token = User::select('map_token')->where('id',2)->get();
        return response()->json(['status' => 200, 'data' => $map_token, 'message' => '']);
    }
    
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
    // 9bffcd80b926ea204a0b4814b076356006773f4f49ecc3632b83cc0c842ccfd9
}
