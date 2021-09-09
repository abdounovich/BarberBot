<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request; 
use App\Appointment; 


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






Route::get('/add','AppointmentController@AddPFunction');

Auth::routes();
Route::match(['get', 'post'], '/botman', 'BotManController@handle');

Route::get('/botman/tinker', 'BotManController@tinker');
Route::get('/main','AppointmentController@index')->middleware('auth');
Route::get('/client/{slug}','ClientController@index');
Route::get('/clients','ClientController@show')->middleware('auth');
Route::post('/client/edit/{id}','ClientController@update')->name("client.editpoints");

Route::get('/delete','AppointmentController@deleteFunction')->middleware('auth');
Route::post('/Add-private-appointment','AppointmentController@storePrivateAppointment');

Route::post('/types','TypeController@store')
->middleware('auth');
Route::get('/types','TypeController@index')
->middleware('auth');
Route::get('/test/{type}/D1/{username}/{Cid}','testController@today')
;
Route::get('/test/{type}/D2/{username}/{Cid}','testController@tomorrow')
;
Route::get('/test/{type}/D3/{username}/{Cid}','testController@afterTomorrow')
;
Route::get('/parametres','SettingController@index')
->middleware('auth');




Route::post('/test2','testController@sendTextMessage')
;

Route::get('/tester','testController@func')
;

Route::get('/delete/{id}','TypeController@supprimer')
->middleware('auth');
Route::get('/edit/{id}','TypeController@edit')
->middleware('auth');
Route::post('/types_edit/{id}','TypeController@update')
->middleware('auth');
Route::get('/actif/{id}/{num}','AppointmentController@actif')
;
Route::post('/annuler','AppointmentController@Annuler')
;
Route::get('/annulerByAdmin/{id}','AppointmentController@AnnulerByAdmin')
;


Route::get('/','HomeController@index')
->middleware('auth');

Route::get('/commande', function () {
    return view('commande') ;
});





Route::post('/parametres/update','SettingController@update')
->middleware('auth');


Route::post('/edit-generale-parametre','SettingController@update_generale_parametre')
->middleware('auth');

Route::get('/testC','HomeController@test');
Route::get('/abcd','TestController@try');
Route::post('/sendMsg/{id}','ClientController@sendMessageToClient');
Route::get('/sendMsg/{id}','ClientController@sendMessageToClientView');
Route::post('/parametres/{id}','SettingController@update');





Route::get('/home', 'HomeController@index')->name('home');


