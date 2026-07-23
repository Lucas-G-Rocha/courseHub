<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class authController extends Controller
{

    public function loginPage()
    {

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['min:5', 'max:15', 'required']
        ], [
            'email.required' => 'Email não pode estar vazio',
            'email.email' => 'Formato do email deve ser válido',
            'password.required' => 'Senha não pode estar vazia',
            'password.min' => 'Senha deve ter mais que 5 caracteres',
            'password.max' => 'Senha deve ter menos que 15 caracteres'
        ]);
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->role->name) {
                case 'admin':
                    return redirect(route('adminInicio'))->with('success', 'Logado com sucesso');
                case 'professor':
                    return redirect(route('professorInicio'))->with('success', 'Logado com sucesso');
                case 'student':
                    return redirect(route('studentInicio'))->with('success', 'Logado com sucesso');
            }

        }else{
            return back()->with('false', 'Email ou Senha incorretos')->withInput();
        }
    }

    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('loginPage'))->with('success','Deslogado com Sucesso!');
    }

}


