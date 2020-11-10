<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $registros = Produto::where([
            'ativo' => 'S'
        ])->get();

        return view('site.home.index', ['produto' => $registros]);
    }

    public function produto(int $id = null)
    {
        if (!empty($id)) {

            $registros = Produto::where([
                'id' => $id,
                'ativo' => 'S'
            ])->get();

            if (!empty($registros[0])) {
                return view('site.home.produto', ['produto' => $registros]);
            }
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }
}
