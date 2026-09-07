<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileWebController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('role:id_role,nom');

        return view('profile.index', compact('user'));
    }
}