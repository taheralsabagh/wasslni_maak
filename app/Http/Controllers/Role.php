<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as ValidationValidator;
use Validator;

class AuthController extends Controller
{
    public function add()
    {
        Role::create([
            'name' => 'admin'
        ]);
    }
}