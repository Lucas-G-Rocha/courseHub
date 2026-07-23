<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class professorsController extends Controller
{
    public function getPublicProfessors()
    {

        $professors = Professor::all();
        return view('public.professores', compact('professors'));
    }

    public function getPublicProfessor($id)
    {
        $professor = Professor::findOrFail($id);

        if (!$professor) {
            return back()->withErrors(['404', 'professor não encontrado']);
        }
        return view('public.professor', compact('professor'));

    }
}
