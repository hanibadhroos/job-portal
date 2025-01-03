<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class accountController extends Controller
{
    public function loginForm()
    {
        return view('account.login');
    }

    
}
