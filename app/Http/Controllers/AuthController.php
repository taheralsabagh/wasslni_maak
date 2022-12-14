<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as ValidationValidator;
use Validator;

class AuthController extends Controller
{
    public function index()
    {
        // echo 'plaese Login';die();
        // $password = 'Taher';
        // $password = Hash::make($password);
        return response()->json(['status' => 401, 'data' => array(), 'message' => 'UnAuthrize : Please Login']);
    }
    public function register(Request $request)
    {
        // $validatedData = $request->validate([
        //     'username' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8',
        //     'whatsapp_number' => 'required|string',
        //     'sms_number' => 'required|string',
        // ]);

        $user = User::create([
            'name' => 'Taher',
            'username' => 'taher',
            'email' => 'wasslnimaak@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 1,
            'whatsapp_number' => '+963947462296',
            'sms_number' => '+963947462296',
            'whatsapp_message' => '+963947462296',
            'sms_message' => '+963947462296',
            'instructions' => 'instructions',
        ]);
        // $user = User::create([
        //     'name' => 'Taher',
        //     'username' => $validatedData['username'],
        //     'email' => $validatedData['email'],
        //     'password' => Hash::make($validatedData['password']),
        //     'role_id' => 1,
        //     'whatsapp_number' => $validatedData['whatsapp_number'],
        //     'sms_number' => $validatedData['sms_number'],
        //     'whatsapp_message' => $request['whatsapp_message'],
        //     'sms_message' => $request['sms_message'],
        //     'instructions' => $request['instructions'],
        // ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
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
        $map_token = User::select('map_token')->where('id', 2)->get();
        return response()->json(['status' => 200, 'data' => $map_token, 'message' => '']);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
    // 9bffcd80b926ea204a0b4814b076356006773f4f49ecc3632b83cc0c842ccfd9
}
