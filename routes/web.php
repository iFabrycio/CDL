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
Route::get('/Historico','MainController@Historico');
Route::get('/Reserva/{id}','MainController@Reserva');
Route::post('/Reservado','MainController@ReservarLivro');

Route::get('/Admin/painel','MainController@AdminView');

//Auth::routes();

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('/registrar', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('registrar', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/Admin/painel/dias','AdminController@SetupDias');
Route::post('/Admin/painel/register','AdminController@RegisterUser');

Route::get('/', 'MainController@index')->name('home');

//Rotas do controller AlunoController

Route::get('/lista/status/aluno','AlunoController@StatusAluno');
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

Route::get('/Devolucao','LivroController@Devolucao');
Route::get('/Devolucao/Confirmar','LivroController@DevolverLivro');


/* Rotas de autor*/
Route::post('/autor/cadastrar', 'LivroController@autorCadastrar')->name('autor.cadastrar');
//Rotas de editora
Route::post('/editora/cadastrar','LivroController@editoraCadastrar')->name('editora.cadastrar');
//Rotas de genero
Route::post('/genero/cadastrar','LivroController@generoCadastrar')->name('genero.cadastrar');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
