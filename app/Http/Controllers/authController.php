<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Auth;
use Illuminate\Http\Request;

class authController extends Controller
{

    public function loginPage()
    {

        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            switch ($user->role->name) {
                case 'admin':
                    return redirect(route('adminInicio'))->with('success', 'Logado com sucesso');
                case 'professor':
                    return redirect(route('professorInicio'))->with('success', 'Logado com sucesso');
                case 'student':
                    return redirect(route('studentInicio'))->with('success', 'Logado com sucesso');

                default:
                    Auth::logout();

                    return redirect()->route('login')
                        ->with('fail', 'Tipo de usuário inválido.');
            }

        } else {
            return back()->with('fail', 'Email ou Senha incorretos')->withInput($request->except('password'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('loginPage'))->with('success', 'Deslogado com Sucesso!');
    }

}


