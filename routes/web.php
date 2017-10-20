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
Route::get('/RedirectToHT','MainController@RedirectToHT');
Route::get('/lista/menu','MainController@ListaMenu');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Rotas do controller AlunoController
Route::get('/lista/Aluno','AlunoController@ListaAluno');
Route::get('/lista/Aluno/Remover/{IdAluno}','AlunoController@removeAluno');
Route::get('/lista/Aluno/Detalhes/{idAluno}','AlunoController@detailAluno');
Route::get('/cadastro','MainController@Submenu');
Route::get('/cadastro/Aluno','AlunoController@Aluno');
Route::post('/cadastro/Aluno/submit','AlunoController@AlunoSubmit');

//Rotas do controller LivroController
Route::get('/lista/Livro','LivroController@ListaLivro');
Route::get('/lista/Livro/Remover/{Idlivro}','LivroController@RemoveLivro');
Route::get('/lista/Livro/Detalhes/{IdLivro}','LivroController@DetailLivro');
Route::get('/cadastro/Livro','LivroController@Livro');
Route::post('/cadastro/Livro/Submit','LivroController@LivroSubmit');
Route::get('/livro/emprestar/{IdLivro}','LivroController@EmprestaLivro');
Route::post('/livro/emprestimo','LivroController@Emprestimo');



/* Rotas de autor*/
Route::post('/autor/cadastrar', 'LivroController@autorCadastrar')->name('autor.cadastrar');
//Rotas de editora
Route::post('/editora/cadastrar','LivroController@editoraCadastrar')->name('editora.cadastrar');
//Rotas de genero
Route::post('/genero/cadastrar','LivroController@generoCadastrar')->name('genero.cadastrar');