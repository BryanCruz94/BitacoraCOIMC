<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexA()
    {
        $numero = 5+5;
        return view('userIndex', compact('numero'));
    }
}
