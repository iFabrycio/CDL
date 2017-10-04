<?php

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

Route::get('/home','MainController@index');



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/RedirectToHT','MainController@RedirectToHT');

Route::get('/cadastro','MainController@Submenu');
Route::get('/cadastro/Aluno','MainController@Aluno');
Route::post('/cadastro/Aluno/submit','MainController@AlunoSubmit');

Route::get('/cadastro/Livro','MainController@Livro');
Route::post('/cadastro/Livro/Submit','MainController@LivroSubmit');

/* Rotas de autor*/
Route::post('/autor/cadastrar', 'MainController@autorCadastrar')->name('autor.cadastrar');
//Rotas de editora
Route::post('/editora/cadastrar','MainController@editoraCadastrar')->name('editora.cadastrar');
//Rotas de genero
Route::post('/genero/cadastrar','MainController@generoCadastrar')->name('genero.cadastrar');