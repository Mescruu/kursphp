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
//Route::get('/', function () {
//    return view('welcome');
//});

/* ---Niepotrzebne
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::resource('posts', 'PostsController');
//automatycznie dodane po komendzie artisan make:auth (zmieniamy na DashBoardController z HomeController i usuwamy: "->name('dashboard')"
Route::get('/dashboard', 'DashBoardController@index');
*/
//automatycznie dodane po komendzie artisan make:auth
Auth::routes();

//Strona główna
Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@home');

//Profil użytkownika
Route::get('/profil', 'PagesController@profil');
Route::get('/profil/punkty', 'PagesController@punkty');

//Panel administracyjny
Route::get('/panel', 'AdminFeaturesController@panel');

Route::post('/panel/dodajgrupe', 'AdminFeaturesController@Groups');
Route::post('/panel/edytujgrupe/{id}', 'AdminFeaturesController@EditGroups');
Route::post('/panel/usungrupe/{id}', 'AdminFeaturesController@removeGroups');

Route::get('/panel/dodajstudenta', 'AdminFeaturesController@Student');
Route::get('/panel/dodajstudentazpliku', 'AdminFeaturesController@StudentFile');
Route::post('/panel/dodajstudentazpliku/dodaj', 'AdminFeaturesController@addFromFile'); //wstawianie z pliku studentow

Route::get('/panel/dodajnauczyciela', 'AdminFeaturesController@Nauczyciel');

Route::get('/panel/edytujkryterium', 'AdminFeaturesController@EdytujKryterium');

Route::get('/panel/uzytkownik/{id}', 'AdminFeaturesController@EditUser');
Route::post('/panel/zmiengrupe/{id}', 'AdminFeaturesController@editUserGroup');

Route::get('/panel/uzytkownik/{id}/dodajpunkty', 'AdminFeaturesController@AddPoints');
Route::get('/panel/uzytkownik/{id}/dodajpunkty/{answerID}', 'AdminFeaturesController@rateAnAnswer');

//Dodanie punktów użytkownikowi

Route::post('/addpoints/{id}', 'AddPointsController@AddPoints');

Route::post('/rateAnAnswer/{id}/{answerID}', 'AddPointsController@rateAnAnswer');


//Wprowadzanie uzytkownika
Route::post('registerstudent', 'InsertUserController@storeStudent');
Route::post('registerteacher', 'InsertUserController@createTeacher');
Route::post('editcriterion', 'EditCriterionController@EditCriterion');

//Kontroler do tematów
//Route::resource('tematy', 'TematyController');

//Kwizy
Route::get('quizy', 'QuizController@index');
Route::get('quizy/{id}', 'QuizController@show');
Route::get('quizy/{id}/edycja', 'QuizController@edit');
Route::get('quizy/{id}/edycja/zatwierdz', 'QuizController@confirm');

Route::post('/quizy/sprawdz/{id}', 'QuizController@checkAnswers');
Route::post('/quizy/wyniki', 'QuizController@showAnswers');

Route::post('/zatwierdzquiz', 'QuizController@confirm');

Route::get('quizy/{id}/usun', 'QuizController@remove');


//Tematy
Route::get('tematy', 'TematyController@index');
Route::get('tematy/utworz', 'TematyController@create');
Route::get('tematy/{id}', 'TematyController@show');
Route::get('tematy/{id}/edycja', 'TematyController@edit');
Route::get('/tematy/{id}/grupy', 'TematyController@groups');
Route::post('/zapisztemat/{id}', 'TematyController@update');
Route::post('/przypiszgrupy/{id}', 'TematyController@updateGroups');
Route::get('/usuntemat/{id}', 'TematyController@delete');
Route::get('/przywroctemat/{id}', 'TematyController@restore');
Route::post('/uploadImage', 'TematyController@uploadImage')->name('uploadImage');
Route::get('/refreshImages', 'TematyController@refreshImages')->name('refreshImages');


Route::get('wyklady/{id}', 'WykladyController@show');
Route::post('wyklady/dodaj', 'WykladyController@create');
Route::get('wyklady/{id}/usun', 'WykladyController@remove');
Route::post('wyklady/{id}/edytuj', 'WykladyController@edit');

Route::get('zadania/{id}', 'ZadaniaController@show');
Route::post('zadania/dodaj', 'ZadaniaController@create');
Route::post('zadania/{id}/odpowiedz', 'ZadaniaController@answer');
Route::get('zadania/{id}/{user}/link', 'ZadaniaController@link');

Route::get('zadania/{id}/usun', 'ZadaniaController@remove');
Route::post('zadania/{id}/edytuj', 'ZadaniaController@edit');
Route::get('zadania/{id}/edycja', 'ZadaniaController@redirectToEdit');



//Resetowanie hasła
Route::post('reset_password_without_token', 'NewPasswordController@validatePasswordRequest');
Route::post('reset_password_with_token', 'NewPasswordController@resetPassword');

//Aktywowanie studenta
Route::post('active', 'InsertUserController@activate');
Route::post('changepassword','ChangePasswordController@changePassword');

//Usunięcie powiadomienia
Route::get('/powiadomienia/usun/', 'PowiadomieniaController@delete');