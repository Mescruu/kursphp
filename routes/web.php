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

| Tutaj możesz zarejestrować trasy internetowe dla swojej aplikacji. Te
| trasy są ładowane przez RouteServiceProvider w grupie, która
| zawiera grupę oprogramowania pośredniego „web”. Teraz stwórz coś wspaniałego!

*/


//Route::get('/hello', function () {
//    return 'hellllloooooo';
//});
//
//Route::get('/users/{id}', function ($id) {
//    return 'this is user '.$id;
//});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::get('/profil', 'PagesController@profil');
Route::get('/profil/punkty', 'PagesController@punkty');



Route::get('/panel', 'AdminFeaturesController@panel');

Route::get('/panel/dodajgrupe', 'AdminFeaturesController@Groups');
Route::get('/panel/dodajstudenta', 'AdminFeaturesController@Student');
Route::get('/panel/dodajnauczyciela', 'AdminFeaturesController@Nauczyciel');


Route::resource('posts', 'PostsController');

//Kontroler do tematów
Route::resource('tematy', 'TematyController');


//automatycznie dodane po komendzie artisan make:auth
Auth::routes();

//automatycznie dodane po komendzie artisan make:auth (zmieniamy na DashBoardController z HomeController i usuwamy: "->name('dashboard')"
Route::get('/dashboard', 'DashBoardController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('reset_password_without_token', 'NewPasswordController@validatePasswordRequest');
Route::post('reset_password_with_token', 'NewPasswordController@resetPassword');

//wprowadzanie uzytkownika
Route::post('registerstudent', 'InsertUserController@storeStudent');
Route::post('registerteacher', 'InsertUserController@createTeacher');

Route::get('/panel/uzytkownik/{id}', 'AdminFeaturesController@EditUser');

//aktywowanie
Route::post('active', 'InsertUserController@activate');
Route::post('changepassword','ChangePasswordController@changePassword');