<?php

namespace App\Http\Controllers;

use Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    



    
return view('parametres.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $setting)
    {
     
        $anglais = ['Saturday' ,'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];  
 
    for ($i = 0; $i < 7; $i++){
    $debut=$request->get($anglais[$i].'-debut');
       
    $fin=$request->get($anglais[$i]."-fin"); 
     

   $debut_repos=$request->get($anglais[$i]."-debut-repos"); 
      

     $fin_repos=$request->get($anglais[$i]."-fin-repos"); 
     

     $active=$request->get($anglais[$i]."-active"); 
       


 

    Setting::set($anglais[$i], [
        'debut'=>$debut,
        'fin'=> $fin,
        'active' => $active,
        'debut-repos' => $debut_repos,
        'fin-repos' =>$fin_repos
            ]);
        }
        return back()->with("success"," لقد تم حفظ البيانات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
