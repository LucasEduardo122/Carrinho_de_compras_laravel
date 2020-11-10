@extends('layout')
@section('titulo_pagina', 'Carrinho')

@section('pagina_conteudo')


@forelse($registro as $pedido)
<h5>Pedido: {{$pedido->id}}</h5>
<h5>Criado em: {{$pedido->created_at->format('d/m/Y H:i')}}</h5>

@foreach($registro[0]->produtos_pedidos as $produtos_pedido)
<p>Valor R$ {{$produtos_pedido->valores}}</p>


<form name="formDeletar">
    @csrf
    <input type="hidden" name="pedidoId" value="{{$pedido->id}}">
    <input type="hidden" name="produto_id" value="{{$produtos_pedido->produto_id}}">
    <input type="hidden" name="item" value="">

    <button type="submit">Remover produto</button>
</form>

@endforeach
@empty
<div class="container">
    <div class="alert alert-warning text-center" style="margin-top: 180px ;" role="alert">
        Não há nada no carrinho
    </div>
</div>
@endforelse



<script src="{{asset('site/js/jquery.js')}}"></script>
<script>
    $(function() {
        $('form[name="formDeletar"]').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{route('carrinho.remove')}}",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(message) {
                    if (message.status) {
                        alert(message.mensagem);
                        window.location.href = "{{route('carrinho')}}";
                    } else {
                        alert(message.mensagem);
                    }
                }
            });
        });
    });
</script>
@stop