<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class generalController extends Controller
{
   public function index(){

    return view('welcome');
   }

   public function getCursos(){

   return view('public.cursos');
   }

   public function getProfessores(){

   return view('public.professores');
   }
}
