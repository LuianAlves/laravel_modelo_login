<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $input = ['name' => 'user_id'];

        return view('app.users.user_index', compact('input'));
    }
}
