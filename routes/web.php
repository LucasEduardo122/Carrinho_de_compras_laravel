<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['App\Http\Controllers\HomeController', 'index'])->name('home');
Route::get('/home', ['App\Http\Controllers\HomeController', 'index'])->name('home');

Route::get('/produto/{id}', ['App\Http\Controllers\HomeController', 'produto'])->name('produto.pesquisar');

Route::get('/carrinho', ['App\Http\Controllers\CarrinhoController', 'index'])->name('carrinho');

Route::get('/login', ['App\Http\Controllers\AuthController', 'formLogin'])->name('login.form');
Route::post('/login/do', ['App\Http\Controllers\AuthController', 'Login'])->name('login.form.do');


Route::get('/register', ['App\Http\Controllers\RegisterController', 'formRegister'])->name('register.form');
Route::post('/register/storage', ['App\Http\Controllers\RegisterController', 'Register'])->name('register.form.storage');

Route::get('/logout', ['App\Http\Controllers\AuthController', 'logout'])->name('logout');

Route::post('/carrinho/storage', ['App\Http\Controllers\CarrinhoController', 'addPedido'])->name('carrinho.storage');
Route::post('/carrinho/remove', ['App\Http\Controllers\CarrinhoController', 'deletar'])->name('carrinho.remove');

