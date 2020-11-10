@extends('layout')
@section('titulo_pagina', 'Login')

@section('pagina_conteudo')

<div class="container">
    <div class="alert alert-danger text-center mb-4 mt-4 d-none message-error" role="alert">
    </div>
    <form name="formLogin">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Senha</label>
                <input type="password" name="password" class="form-control" id="inputPassword4">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Logar</button>
    </form>

</div>
<script src="{{asset('site/js/jquery.js')}}"></script>
<script>
    $(function() {
        $('form[name="formLogin"]').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{route('login.form.do')}}",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(retorno) {
                    if (retorno.status) {
                        window.location.href = "{{route('home')}}"
                    } else {
                        $(".message-error").removeClass('d-none').html(retorno.mensagem);
                    }
                }
            });
        });
    });
</script>
@stop