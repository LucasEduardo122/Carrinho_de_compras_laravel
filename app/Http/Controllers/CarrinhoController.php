<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\produtos_pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $registro = Pedido::where([
            'user_id' => Auth::id(),
            'status' => 'RE'
        ])->get();

        //var_dump([$registro, $registro[0]->produtos_pedidos, $registro[0]->produtos_pedidos[0]->produtos]);
        return view('site.carrinho.index', compact('registro'));
    }

    public function addPedido(Request $request)
    {

        $pedido = new Pedido();
        $pedido_produto = new produtos_pedido();

        if (!empty(Auth::id())) {

            $validacao = Pedido::where([
                'user_id' => Auth::id(),
                'status' => 'RE'
            ])->get();

            if (!empty($validacao[0])) {
                $pedido_produto->pedido_id = $validacao[0]->id;
                $pedido_produto->produto_id = $request->produto_id;
                $pedido_produto->status = 'RE';
                $pedido_produto->valor = $request->valor;
                $pedido_produto->desconto = $request->desconto;
                $pedido_produto->cupom_desconto_id = $request->cupom_desconto;
                $pedido_produto->save();

                $carrinho['status'] = true;
                $carrinho['mensagem'] = "Produto adiconado ao carrinho";
                echo json_encode($carrinho);
                return;
            } else {
                $pedido->user_id = Auth::id();
                $pedido->status = 'RE';
                $pedido->save();

                $pedido_produto->pedido_id = $pedido->id;
                $pedido_produto->produto_id = $request->produto_id;
                $pedido_produto->status = 'RE';
                $pedido_produto->valor = $request->valor;
                $pedido_produto->desconto = $request->desconto;
                $pedido_produto->cupom_desconto_id = $request->cupom_desconto;
                $pedido_produto->save();

                $carrinho['status'] = true;
                $carrinho['mensagem'] = "Produto adiconado ao carrinho";
                echo json_encode($carrinho);
                return;
            }
        } else {
            $carrinho['status'] = false;
            $carrinho['mensagem'] = "Você precisa estar logado";
            echo json_encode($carrinho);
            return;
        }
    }

    public function deletar(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

        $pedidoId = $request->pedidoId;
        $produtoId = $request->produto_id;
        $usuarioId = Auth::id();
        $remove_apenas_item = (bool) $request->item;

        $pedido = Pedido::where([
            'id' => $pedidoId,
            'user_id' => $usuarioId,
            'status' => 'RE'
        ])->first();

        if (empty($pedido)) {
            $login['status'] = false;
            $login['mensagem'] = "Pedido não encontrado";
            echo json_encode($login);
            return;
        }

        $where_produto = [
            'pedido_id' => $pedidoId,
            'produto_id' => $produtoId
        ];

        $pedido_produto = produtos_pedido::where($where_produto)->orderBy('id', 'desc')->first();

        if (empty($pedido_produto->id)) {
            $login['status'] = false;
            $login['mensagem'] = "Produto não encontrado no carrinho!";
            echo json_encode($login);
            return;
        }

        if ($remove_apenas_item) {
            $where_produto['id'] = $pedido_produto->id;
        }

        produtos_pedido::where($where_produto)->delete();

        $check_pedido = produtos_pedido::where([
            'pedido_id' => $pedido_produto->pedido_id
        ])->exists();

        if (!$check_pedido) {
            Pedido::where(['id' => $pedidoId])->delete();
        }

        $login['status'] = true;
        $login['mensagem'] = "Produto removido";
        echo json_encode($login);
        return;
    }
}
