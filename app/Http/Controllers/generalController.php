<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class generalController extends Controller
{
   public function index()
   {

      return view('welcome');
   }
}
