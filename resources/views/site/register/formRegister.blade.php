@extends('layout')
@section('titulo_pagina', 'Register')

@section('pagina_conteudo')

<div class="container">
    <div class="alert alert-success text-center mb-4 mt-4 d-none message-success" role="alert">
    </div>
    <div class="alert alert-danger text-center mb-4 mt-4 d-none message-error" role="alert">
    </div>
    <form name="formRegister">
        <div class="form-row">
            @csrf
            <div class="form-group col-md-4">
                <label for="inputEmail4">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Senha</label>
                <input type="password" name="password" class="form-control" id="inputPassword4">
            </div>

            <div class="form-group col-md-4">
                <label for="inputName">Nome</label>
                <input type="text" name="name" class="form-control" id="inputName">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

</div>
<script src="{{asset('site/js/jquery.js')}}"></script>
<script>
    $(function() {
        $('form[name="formRegister"]').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{route('register.form.storage')}}",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(retorno) {
                    if (retorno.status) {
                        $(".message-success").removeClass('d-none').html(retorno.mensagem);
                    } else {
                        $(".message-error").removeClass('d-none').html(retorno.mensagem);
                    }
                }
            });
        });
    });
</script>
@stop