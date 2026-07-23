<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authController extends Controller
{

    public function loginPage()
    {

        return view('login');
    }
}
