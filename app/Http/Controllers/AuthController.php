<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('site.auth.formLogin');
    }

    public function login(Request $request)
    {
        $user = User::where(['email' => $request->email])->get();

        if (!empty($user)) {
            $credentials = ['email' => $request->email, 'password' => $request->password];

            if (Auth::attempt($credentials)) {
                $login['status'] = true;
                $login['mensagem'] = "Logado";
                echo json_encode($login);
                return;
            } else {
                $login['status'] = false;
                $login['mensagem'] = "Dados inválidos";
                echo json_encode($login);
                return;
            }
        } else {
            $login['status'] = false;
            $login['mensagem'] = "Dados inválidos";
            echo json_encode($login);
            return;
        }
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('home');
    }
}
