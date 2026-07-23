<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class cursosController extends Controller
{
    public function getPublicCursos()
   {

      $cursos = Course::all();
      return view('public.cursos', compact('cursos'));
   }

   public function getPublicCurso($id){
    $curso = Course::findOrFail($id);

    if(!$curso){
        return back()->withErrors(['404', 'Curso não encontrado']);
    }
    return view('public.curso', compact('curso'));

   }
}
