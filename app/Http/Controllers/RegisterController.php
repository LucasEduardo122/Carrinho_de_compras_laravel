<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function formRegister() {
        if(Auth::check()){
            return redirect()->route('home');
        }

        return view('site.register.formRegister');
    }

    public function Register(Request $request) {

        $dados = ['email' => $request->email, 'password' => $request->password, 'name' => $request->name];

        $user = new User();

        $retorno = $user->validarDados($dados);

        if($retorno){
            $login['status'] = false;
            $login['mensagem'] = "Preencha todos os campos";
            echo json_encode($login);
            return;
        } else {
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
            $user->save();

            $login['status'] = true;
            $login['mensagem'] = "Usuario cadastrado";
            echo json_encode($login);
            return;
        }
    }
}
