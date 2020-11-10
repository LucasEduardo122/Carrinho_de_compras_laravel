@extends('layout')
@section('titulo_pagina', 'Produto')

@section('pagina_conteudo')


@foreach($produto as $dados)
<img src="{{$dados->imagem}}" alt="">

<h5>{{$dados->nome}}</h5>
<p>{{$dados->descricao}}</p>
<p>R${{$dados->valor}}</p>
@endforeach

@stop