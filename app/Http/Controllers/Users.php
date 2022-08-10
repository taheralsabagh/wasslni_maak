<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserInfoRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    public function index()
    {
        die('<h2 style="color:blue;margin:5%">hello world</h2>');
    }
    public function editUserInfo(EditUserInfoRequest $request)
    {
        $userInfo = User::find(Auth::user()->id);
        if (!$userInfo)
            return response()->json(['status' => 404, 'data' => array(), 'message' => 'Not Found']);
        $userInfo->update([
            'whatsapp_number' => ($request->whatsapp_number) ?? $userInfo->whatsapp_number,
            'sms_number' => ($request->sms_number) ?? $userInfo->sms_number,
            'whatsapp_message' => ($request->whatsapp_message) ?? $userInfo->whatsapp_message,
            'sms_message' => ($request->sms_message) ?? $userInfo->sms_message,
            'instructions' => ($request->instructions) ?? $userInfo->instructions,
        ]);
        $userInfo = User::find(Auth::user()->id);
        return response()->json(['status' => 200, 'data' => $userInfo, 'message' => 'User information has been updated']);
    }
}
