<?php


Route::get('/', function () {
    return view('user.index');
})->name('user.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin'],function(){
	Route::get('admin/home','IndexController@home')->name('admin.index');
	Route::get('admin/home/estadsticas','IndexController@estadisticas')->name('admin.estadisticas');

	Route::resource('admin/admins','AdminController');
	Route::resource('admin/categories','CategoryController');
	Route::resource('admin/polls','PollsController');
	//grupos
	Route::get('admin/polls-group/edit/{poll_id}/{hay_registros}','PollsGroupController@edit')->name('polls-group.edit');

	// Route::post('admin/polls-group/StoreGroups/{poll_id}','PollsGroupController@StoreGroup')->name('polls-group.edit');
	Route::resource('admin/polls-group','PollsGroupController',['except' => ['edit']]);

	Route::get('admin/polls-group/add/{count}/{poll_id}','PollsGroupController@add')->name('polls-group.add');
	//
	Route::resource('admin/questions','QuestionController');
	Route::resource('admin/answers','AnswerController');
	Route::resource('admin/ranges','RangeController');
	Route::resource('admin/general_definitions','GeneralDefinitionsController');
	Route::get('admin/clients/users', 'ClientsController@users')->name('admins.users');

	// Admin Auth Routes
	Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Auth\LoginController@login')->name('admin.login.post');
	Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

	Route::get('admin/questions/buscar/{id}','QuestionController@buscar')->name('preguntas.buscar');
	Route::put('admin/questions/guardar/{id}','QuestionController@guardar')->name('preguntas.guardar');
	Route::put('admin/questions/actualizar/{id}','QuestionController@actualizar')->name('preguntas.actualizar');

	Route::get('admin/answers/buscar/{id}','AnswerController@buscar')->name('respuestas.buscar');
	Route::put('admin/answers/guardar/{id}','AnswerController@guardar')->name('respuestas.guardar');
	Route::put('admin/answers/actualizar/{id}','AnswerController@actualizar')->name('respuestas.actualizar');
	Route::get('admin/answers/eliminar/{id}','AnswerController@eliminar')->name('respuestas.eliminar');
	Route::put('admin/polls/eliminar/{id}', 'PollsController@eliminar')->name('polls.eliminar');

	Route::get('admin/pollsusers/index', 'PollsUsersController@index')->name('polls_users.index');
	Route::post('admin/pollsusers/save', 'PollsUsersController@save')->name('polls_users.save');
	Route::get('admin/pollsusers/search/{id}', 'PollsUsersController@search')->name('polls_users_search.index');
});

Route::group(['namespace' => 'User'],function(){
	Route::resource('user/encuestas','EncuestasController');
	Route::get('user/encuesta/reanudar/{id}','EncuestasController@reanudar')
		->name('encuestas.reanudar');
	Route::post('user/encuestas1','EncuestasController@individualStore')->name('encuestas.individual');
	//Route::resource('user/test','TestController');

	Route::resource('user/encuestas-grupos','EncuestaPorGrupoController');
	Route::get('user/encuestas-grupos/reanudar/{id}','EncuestaPorGrupoController@reanudar')
		->name('encuestas-grupos.reanudar');

	
});


Route::post('Auth/guardar',	'Auth\ResetPasswordController@guardar')->name('reset');
Route::get('validar_link', 'Auth\ResetPasswordController@validar_link')->name('validar_link');
Route::get('validar_link/{codigo}', 'Auth\ResetPasswordController@validar_link');
Route::get('validar_link_confimacion', 'Auth\RegisterController@validar_link_confimacion')->name('validar_link_confimacion');
Route::get('validar_link_confimacion/{codigo}', 'Auth\RegisterController@validar_link_confimacion');
Route::get('validar_link/{codigo}', 'Auth\ResetPasswordController@validar_link');
Route::post('guardarNuevaContrasena', 'Auth\ResetPasswordController@guardarNuevaContrasena')->name('cambiar');

Auth::routes();
// Socialite
Route::get( '/login/{social}', 'Auth\LoginController@getSocialRedirect' )
  ->middleware('guest');

Route::get( '/login/{social}/callback', 'Auth\LoginController@getSocialCallback' )
  ->middleware('guest');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/vistamensajeRegistrado', 'Auth\RegisterController@vistamensajeRegistrado');
Route::get('/usuario_confirmado', 'Auth\usuarioconfirmadoController@index');

Route::prefix('admin')->group(function() {
	Route::get('/login',
	'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
	//Route::get('/home', 'Admin\AdminController@index')->name('admin.dashboard');

}); 
