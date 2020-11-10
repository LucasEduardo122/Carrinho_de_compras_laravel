@extends('layout')
@section('titulo_pagina', 'Home')

@section('pagina_conteudo')

<div class="alert alert-success text-center mb-4 mt-4 d-none message-success" role="alert">
</div>
<div class="alert alert-danger text-center mb-4 mt-4 d-none message-error" role="alert">
</div>

<h4 class="text-center mt-4 mb4">Produtos</h4>

@foreach($produto as $produtos)
<div class="container">
    <div class="card mb-3 mt-4" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{$produtos->imagem}}" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$produtos->nome}}</h5>
                    <p class="card-text">{{$produtos->descricao}}</p>
                    <p class="card-text"><small class="text-muted">R${{$produtos->valor}}</small></p>

                    @if(Auth::check())
                    <form name="formPedido">
                        @csrf
                        <input type="hidden" name="produto_id" value="{{$produtos->id}}">
                        <input type="hidden" name="valor" value="{{$produtos->valor}}">
                        <input type="hidden" name="desconto" value="0">
                        <input type="hidden" name="cupom_desconto" value="">
                        <button class="btn btn-primary btn-block" type="submit">Adicionar ao carrinho</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

<script src="{{asset('site/js/jquery.js')}}"></script>
<script>
    $(function() {
        $('form[name="formPedido"]').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{route('carrinho.storage')}}",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(message) {
                    if (message.status) {
                        $(".message-success").removeClass('d-none').html(message.mensagem);
                    } else {
                        $(".message-error").removeClass('d-none').html(message.mensagem);
                    }
                }
            });
        });
    });
</script>

@stop