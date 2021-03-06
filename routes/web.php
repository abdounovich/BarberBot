<?php

use App\Appointment; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


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






Route::get('/addPoints','AppointmentController@addPoints');


Route::get('/redirect',function(){
return view('redirect');

});

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
Route::get('/take_appointment/{type}/D1/{username}/{Cid}/{user}','AppointmentController@today')
;
Route::get('/take_appointment/{type}/D2/{username}/{Cid}/{user}','AppointmentController@tomorrow')
;
Route::get('/take_appointment/{type}/D3/{username}/{Cid}/{user}','AppointmentController@afterTomorrow')
;
Route::get('/parametres','SettingController@index')
->middleware('auth');




Route::get('/confirmationMessage/{id}/{debut}/{type}/{jour}/{username}/{Cid}/{user}','AppointmentController@confirmationMessage')
;


Route::get('/reminder','AppointmentController@reminder')
;

Route::get('/delete/{id}','TypeController@supprimer')
->middleware('auth');
Route::get('/edit/{id}','TypeController@edit')
->middleware('auth');
Route::post('/types_edit/{id}','TypeController@update')
->middleware('auth');
Route::get('/actif/{id}/{num}','AppointmentController@actif')
;
Route::get('/annuler/{id}/{facebook}','AppointmentController@Annuler')
;
Route::get('/annulerByAdmin/{id}','AppointmentController@AnnulerByAdmin')
;


Route::get('/','HomeController@index')
->middleware('auth');






Route::post('/parametres/update','SettingController@update')
->middleware('auth');


Route::post('/edit-generale-parametre','SettingController@update_generale_parametre')
->middleware('auth');

Route::post('/sendMsg/{id}','ClientController@sendMessageToClient')->middleware('auth');
;
Route::get('/sendMsg/{id}','ClientController@sendMessageToClientView')->middleware('auth');
;
Route::post('/parametres/{id}','SettingController@update')->middleware('auth');
;


Route::post('/edit-profile','AvatarController@update');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/install', function(){

return view('installation/installation');
});



Route::post('/install', function(Request $request ){

    $user_id=Auth::user()->id;

    Setting::set("id_".$user_id."/theme", [
        'premier'=>'NavajoWhite',
        'deuxieme'=> 'black',
        'text-color' => 'white',
        'bg-image' => 'https://res.cloudinary.com/ds9qfm1ok/image/upload/v1632348196/chq7eis8xd1qecjqinf9.png',
            ]);

            Setting::set("app_name", $request->get('application_name'));




            $anglais = ['Saturday' ,'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];  
     
        for ($i = 0; $i < 7; $i++){
        $debut="08:00";
           
        $fin="20:00";
         
    
       $debut_repos="12:00";
          
    
         $fin_repos="14:00";
         
    
         $active="1";
           
    
    
     
    
        Setting::set("id_".$user_id."/".$anglais[$i], [
            'debut'=>$debut,
            'fin'=> $fin,
            'active' => $active,
            'debut-repos' => $debut_repos,
            'fin-repos' =>$fin_repos
                ]);
            }



           return redirect("home");
});




