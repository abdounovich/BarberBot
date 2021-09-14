<?php

namespace App\Http\Controllers;

use DateTime;
use App\Client;
use DateInterval;
use DateTimeZone;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;
use Config;
use Setting;
use App\Type;
class AppointmentController extends Controller
{






    public function AnnulerByAdmin( $id)
    {

$appointment=Appointment::find($id)->delete();
 return redirect()->back()->with('success', ' لقد تم إلغاء الموعد بنجاح ' );   



}




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function Annuler(Request $request)
    {

        $facebook=$request->get('facebook');
        $id=$request->get('id');
$appointment=Appointment::where("ActiveType","1")->where("facebook",$facebook)->first();
 $appointment->delete();
 $client=Client::where("fb_id",$id)->first();
$config=Config::get('app.url');


      $messageData = [
          "recipient" => [
              "id" => $client->fb_id,
          ],
          "message"=>[
            "attachment"=>[
        
              "type"=>"template",
              "payload"=>[
                "template_type"=>"button",
                "text"=>"لقد تم إلغاء موعدك بنجاح ",
                "buttons"=>[
                  [
                    "type"=>"postback",
                    "title"=>" 🛍 إحجز موعد جديد ",
                    "payload"=>"GotoDis",

                  ],
                  [
                    "type"=>"web_url",
                    "url"=>"$config/client/$client->slug",
                    "title"=>" 🎁 رصيدي    ",
                    "webview_height_ratio"=>"tall"

                  ],
                 
                  
                ]
              ]
            ]
          ],
      ];
      $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("FACEBOOK_TOKEN"));
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
      curl_exec($ch);
      curl_close($ch);




    }



    public function actif($id,$num)
    {
    $A=Appointment::find($id);
    $A->ActiveType=$num;
    $A->save();

    return redirect('/main')   ; }
    public function index()
    {

        date_default_timezone_set("Africa/Algiers");
$today=date("Y-m-d");
$Tommorow=date('Y-m-d', strtotime($today. ' + 1 day'));
$afterTommorow=date('Y-m-d', strtotime($today. ' + 2 day'));


       $Today_appointments=Appointment::where('ActiveType','>','0')->whereJour($today)->orderBy('debut', 'asc')->get();
       $Tomorow_appointments=Appointment::where('ActiveType','>','0')->whereJour($Tommorow)->orderBy('debut', 'asc')->get();
       $AfterTomoro_appointments=Appointment::where('ActiveType','>','0')->whereJour($afterTommorow)->orderBy('debut', 'asc')->get();



       $Inactif_appointments=Appointment::where('ActiveType','0')->latest()->paginate(1);
    $config=Config::get('botman.facebook.token');
 
 
       return view("appointments.main")
       ->with('Today_appointments',$Today_appointments)
       ->with('Tomorow_appointments',$Tomorow_appointments)
       ->with('AfterTomoro_appointments',$AfterTomoro_appointments)
       ->with('Inactif_appointments',$Inactif_appointments)
       ->with('config',$config);
    }

  











    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePrivateAppointment(Request $request)
    {

        date_default_timezone_set("Africa/Algiers");
        $jour=$request->get('jour');
        $debut=$request->get("debut");
        $fin=$request->get("fin");
      
        $fin = Carbon::createFromFormat('H:i', $fin); 
$fin=$fin->subMinute()->format('H:i');
$counter=0;
$appointments=Appointment::where("jour",$jour)->where("ActiveType",'!=',5)->get();

if ($appointments->count()>0) {

foreach ($appointments as $appointment ) {

  
 
 if ($appointment->debut>=$debut and $appointment->debut<$fin ){
     $counter=$counter+1;
    return back()->with("erreur"," لديك موعد في هاته الفترة من فظلك إختر توقيت آخر ");

}


elseif ($appointment->fin>$debut and $appointment->fin<$fin ){
    $counter=$counter+1;
    return back()->with("erreur"," لديك موعد في هاته الفترة من فظلك إختر توقيت آخر ");

}


      }  

      if ($counter==0) {
        $app=new Appointment();
        $app->ActiveType="5";
        $app->jour=$jour;
        $app->debut=$debut;
        $app->fin=$fin;
        $app->save(); 
    
           
        return back()->with("success","تم حفظ البيانات بنجاح ");
      }
}
else{
    $app=new Appointment();
    $app->ActiveType="5";
    $app->jour=$jour;
    $app->debut=$debut;
    $app->fin=$fin;
    $app->save(); 

       
    return back()->with("success","تم حفظ البيانات بنجاح ");


}



    }

  

   


    public function addPoints(){
        date_default_timezone_set("Africa/Algiers");

        $today=date("Y-m-d");

     $appointments=Appointment::where('ActiveType','2')->whereJour($today)->get();


     foreach ($appointments as $appointment) {
         $clients=Client::whereFacebook($appointment->facebook)->get();
     foreach ($clients as $client ) {
         $update = [
         'points'  => $client->points+$appointment->type->point
    ];           $client->update($update);

     }
       
}




$appoints=Appointment::where('ActiveType','1')->whereJour($today)->get();


foreach ($appoints as $appoint) {
    $clients=Client::whereFacebook($appoint->facebook)->get();
foreach ($clients as $client ) {
    $update = [
    'points'  => $client->points-50
];           $client->update($update);

}
  
}

$update = [
    'ActiveType'     => "0"
];
$appointments=Appointment::whereJour($today)->where('ActiveType','1')->orWhere('ActiveType','2')
->update($update);

 
 
 

}









     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmationMessage(Request $request)
    {
  
  
    
  
      $messageText=  $request->get('message');
      $Cid=$request->get('Cid');
      $id=$request->get('id');
      $debut=$request->get('debut'); 
      $type=$request->get('type');
      $type=Type::find($type);
      $username=$request->get('username');
      $type_time=$type->temps-1;
     $fin=date("Y-m-d H:i:s", (strtotime(date($debut)) +  $type_time*60));
     $fin=date("H:i", strtotime(date($fin)));
     $debut=date("H:i", strtotime(date($debut)));
  
  
  $jour=$request->get('jour');
  
  $a=Appointment::whereJour($jour)->whereDebut($debut)->get()->count();
  
  
  if ($a>0) {
    $botman = app('botman');
    $botman->say( "حدث خطأ نرجو إعادة المحاولة ",$id, FacebookDriver::class);
    return;
  } else {
  
  $addApp=new Appointment();
  $addApp->facebook=$username;
  $addApp->type_id= $type->id;
  $addApp->ActiveType="1";
  $addApp->fb_id=$id;
  $addApp->jour=$jour;
  $addApp->debut=$debut;
  $addApp->fin=$fin;
  $addApp->client_id=$Cid;
  
    
  
  $addApp->save();



  $client=Client::find($Cid);
  $config=Config::get('app.url');
  
  
  
        $messageData = [
            "recipient" => [
                "id" => $id,
            ],
            "message"=>[
              "attachment"=>[
          
                "type"=>"template",
                "payload"=>[
                  "template_type"=>"button",
                  "text"=>$messageText,
                  "buttons"=>[
                    [
                      "type"=>"web_url",
                      "url"=>"$config/client/$client->slug",
                      "title"=>" 📅 تصفح  مواعيدي",
                      "webview_height_ratio"=>"tall",
                      "messenger_extensions"=>"true"
  
  
                    ],
                    [
                      "type"=>"web_url",
                      "url"=>"$config/client/$client->slug",
                      "title"=>" 🎁 رصيدي    ",
                      "webview_height_ratio"=>"tall",
                      "messenger_extensions"=>"true"
                      
  
                    ],
                   
                    
                  ]
                ]
              ]
            ],
        ];
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("FACEBOOK_TOKEN"));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);
        curl_close($ch);
  
      }  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
     public function today($type,$username,$Cid)
     {
        $debut="";
  $fin="";
  $d_pause="";
  $f_pause="";
  
  
  
      date_default_timezone_set("Africa/Algiers");
      $date=date("l");
  

      
      
          if (Setting::get($date.'.active')==1) {
          $debut=Setting::get($date.'.debut');
          $fin=Setting::get($date.'.fin');
          $d_pause=Setting::get($date.'.debut-repos');
          $f_pause=Setting::get($date.'.fin-repos');
         
          }
          else {
            $debut="00:01";
            $fin="00:04";
            $d_pause="00:02";
            $f_pause="00:03";
          }
      
          
         $jour=date("Y-m-d");
  
      
          $debut=$jour." ".$debut.":00";
          $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
          $fin=$jour." ".$fin.":00";
          $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
          $types=Type::whereId($type)->first();
      
          $pas=$types->temps-1;
          $arr=array();
          $arr2=array();
          $items=array();
          $arr4=array();
          
          
          $d_pause=$jour." ".$d_pause.":00";
          $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
          $f_pause=$jour." ".$f_pause.":00";
          $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 
      
          $Today_appointments=Appointment::whereJour($jour)->get();
      
      
          while ($debut < $fin )
          {
            $arr[]=$debut;  
            $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 900));
      
                }
                
                if (count($Today_appointments)>0) {
                    foreach ($arr as $key) { 
                    $ai= new Carbon ($key); 
                    $ai->toDateTimeString();
                    $ai->addMinutes($pas);  
                 
        foreach ($Today_appointments as $appointment ) { 
                  $d=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->debut.":00"));
                  $f=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->fin.":00"));
      
      
                  
                  if ($key>=$d && $key<$f) {
                    $arr2[]=$key;}
                  elseif ($key<$d && $ai>=$f) {
                    $arr2[]=$key;}
                  elseif ($ai>=$d && $ai<=$f) {
                    $arr2[]=$key;
                  }
                  elseif ($ai>$fin) {
                    $arr2[]=$key;
                  }
                  elseif ($ai>=$d_pause and $ai<$f_pause) {
                    $arr2[]=$key;
                  }
                  elseif ($key<=$d_pause and $ai>$f_pause) {
                    $arr2[]=$key;
                  }
                  else{
                     $arr4[]= $key;
                    }}
                   }
                  } else {
  
                    foreach ($arr as $key) { 
                      $ai= new Carbon ($key); 
                      $ai->toDateTimeString();
                      $ai->addMinutes($pas); 
                    if ($ai>$fin) {
                      $arr2[]=$key;
                    }
                    elseif ($ai>=$d_pause and $ai<$f_pause) {
                      $arr2[]=$key;
                    }
                    elseif ($key<=$d_pause and $ai>$f_pause) {
                      $arr2[]=$key;
                    }
                    
                    else{
                       $arr4[]= $key;
                      }
                    }}
              foreach ($arr4 as $k ) {
              
              
                  if (!in_array($k, $items)&&!in_array($k, $arr2) ) {if ($d_pause<=$k && $k<$f_pause) {}else{$items[]=$k;}}}
        
         $var=1;
         $type=Type::find($type);
         return view("take_appointment")->with('items',$items)
         ->with('var',$var)
         ->with('type',$type)
         ->with('jour',$jour)
         ->with('username',$username)
         ->with('Cid',$Cid); 
  
  
  
  
  
  
  }
  
  
  
    
     public function tomorrow($type,$username,$Cid)
     {
  $debut="";
  $fin="";
  $d_pause="";
  $f_pause="";
  
      date_default_timezone_set("Africa/Algiers");
      $date=date("l");
      $date=date("l", strtotime($date. ' + 1 day'));
  
      
      
      
     
      if (Setting::get($date.'.active')==1) {
        $debut=Setting::get($date.'.debut');
        $fin=Setting::get($date.'.fin');
        $d_pause=Setting::get($date.'.debut-repos');
        $f_pause=Setting::get($date.'.fin-repos');
       
        }
        else {
          $debut="00:01";
          $fin="00:04";
          $d_pause="00:02";
          $f_pause="00:03";
        }
         $jour=date("Y-m-d");
  
         $tomorrow=date('Y-m-d', strtotime($jour. ' + 1 day'));
  
         $jour=$tomorrow; 
  
          $debut=$jour." ".$debut.":00";
          $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
          $fin=$jour." ".$fin.":00";
          $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
          $types=Type::whereId($type)->first();
      
          $pas=$types->temps-1;
          $arr=array();
          $arr2=array();
          $items=array();
          $arr4=array();
          
          
          $d_pause=$jour." ".$d_pause.":00";
          $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
          $f_pause=$jour." ".$f_pause.":00";
          $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 
      
          $Tomorrow_appointments=Appointment::whereJour($jour)->get();
      
      
          while ($debut < $fin )
          {
            $arr[]=$debut;  
            $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 900));
      
                }
                
                if (count($Tomorrow_appointments)>0) {
                    foreach ($arr as $key) { 
                    $ai= new Carbon ($key); 
                    $ai->toDateTimeString();
                    $ai->addMinutes($pas);  
                 
        foreach ($Tomorrow_appointments as $appointment ) { 
                  $d=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->debut.":00"));
                  $f=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->fin.":00")); if ($key>=$d && $key<$f) {
                    $arr2[]=$key;}
                  elseif ($key<$d && $ai>=$f) {
                    $arr2[]=$key;}
                  elseif ($ai>=$d && $ai<=$f) {
                    $arr2[]=$key;
                  }
                  elseif ($ai>$fin) {
                    $arr2[]=$key;
                  }
                  elseif ($ai>=$d_pause and $ai<$f_pause) {
                    $arr2[]=$key;
                  }
                  elseif ($key<=$d_pause and $ai>$f_pause) {
                    $arr2[]=$key;
                  }
                  else{
                     $arr4[]= $key;
                    }}
                   }
                  } else {
  
                    foreach ($arr as $key) { 
                      $ai= new Carbon ($key); 
                      $ai->toDateTimeString();
                      $ai->addMinutes($pas); 
                    if ($ai>$fin) {
                      $arr2[]=$key;
                    }
                    elseif ($ai>=$d_pause and $ai<$f_pause) {
                      $arr2[]=$key;
                    }
                    elseif ($key<=$d_pause and $ai>$f_pause) {
                      $arr2[]=$key;
                    }
                    
                    else{
                       $arr4[]= $key;
                      }
                    }}
              foreach ($arr4 as $k ) {
              
              
                  if (!in_array($k, $items)&&!in_array($k, $arr2) ) {if ($d_pause<=$k && $k<$f_pause) {}else{$items[]=$k;}}}
  
    
     $var=2;
     $type=Type::find($type);
     return view("take_appointment")->with('items',$items)
     ->with('var',$var)
     ->with('type',$type)
     ->with('jour',$jour)
     ->with('username',$username)
     ->with('Cid',$Cid);  }
  
  
  
  
  
  
  
    public function afterTomorrow($type,$username,$Cid)
     
    {
  
  $debut="";
  $fin="";
  $d_pause="";
  $f_pause="";
  
  
  
      date_default_timezone_set("Africa/Algiers");
      $date=date("l");
          $date=date("l", strtotime($date. ' + 2 day'));
      
      
          
       


          if (Setting::get($date.'.active')==1) {
            $debut=Setting::get($date.'.debut');
            $fin=Setting::get($date.'.fin');
            $d_pause=Setting::get($date.'.debut-repos');
            $f_pause=Setting::get($date.'.fin-repos');
           
            }
            else {
              $debut="00:01";
              $fin="00:04";
              $d_pause="00:02";
              $f_pause="00:03";
            }

      
       
      
         $jour=date("Y-m-d");
         $afterTommorow=date('Y-m-d', strtotime($jour. ' + 2 day'));
      
         $jour=$afterTommorow; 
      
          $debut=$jour." ".$debut.":00";
          $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
          $fin=$jour." ".$fin.":00";
          $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
          $types=Type::whereId($type)->first();
      
          $pas=$types->temps-1;
          $arr=array();
          $arr2=array();
          $items=array();
          $arr4=array();
          
          
          $d_pause=$jour." ".$d_pause.":00";
          $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
          $f_pause=$jour." ".$f_pause.":00";
          $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 
      
          $afterTommorow_appointments=Appointment::whereJour($jour)->get();
      
      
          while ($debut < $fin )
          {
            $arr[]=$debut;  
            $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 900));
      
                }
                
                if (count($afterTommorow_appointments)>0) {
               
               
                    foreach ($arr as $key) { 
                    $ai= new Carbon ($key); 
                    $ai->toDateTimeString();
                    $ai->addMinutes($pas);  
                 
        foreach ($afterTommorow_appointments as $appointment ) { 
                  $d=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->debut.":00"));
                  $f=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->fin.":00"));
      
                  if ($key>=$d && $key<$f) {
                    $arr2[]=$key;}
                  elseif ($key<$d && $ai>=$f) {
                    $arr2[]=$key;}
                  elseif ($ai>=$d && $ai<=$f) {
                    $arr2[]=$key;
                  }
                  elseif ($ai>$fin) {
                    $arr2[]=$key;
                  }
                  elseif ($ai>=$d_pause and $ai<$f_pause) {
                    $arr2[]=$key;
                  }
                  elseif ($key<=$d_pause and $ai>$f_pause) {
                    $arr2[]=$key;
                  }
                  else{
                     $arr4[]= $key;
                    }}
                   }
                  } else {
  
                    foreach ($arr as $key) { 
                      $ai= new Carbon ($key); 
                      $ai->toDateTimeString();
                      $ai->addMinutes($pas); 
                    if ($ai>$fin) {
                      $arr2[]=$key;
                    }
                    elseif ($ai>=$d_pause and $ai<$f_pause) {
                      $arr2[]=$key;
                    }
                    elseif ($key<=$d_pause and $ai>$f_pause) {
                      $arr2[]=$key;
                    }
                    
                    else{
                       $arr4[]= $key;
                      }
                    }}
              foreach ($arr4 as $k ) {
              
              
                  if (!in_array($k, $items)&&!in_array($k, $arr2) ) {if ($d_pause<=$k && $k<$f_pause) {}else{$items[]=$k;}}}
           $var=3;
         $type=Type::find($type);
         return view("take_appointment")->with('items',$items)
         ->with('var',$var)
         ->with('type',$type)
         ->with('jour',$jour)
         ->with('username',$username)
         ->with('Cid',$Cid);  
  
  
  }
    
  
  public function reminder(){
  
  
  
    $botman = app('botman');
    date_default_timezone_set("Africa/Algiers");
  
    $date=date("Y-m-d H:i");
    $appointments=Appointment::where('ActiveType','1')->get();
    if ($appointments->count()==0){
  
  
  
    }
    else{foreach ($appointments as $appointment ) {        
      $d=date("Y-m-d H:i", strtotime($appointment->jour." ".$appointment->debut.":00"));
      $date1=date('Y-m-d H:i', strtotime($date. '+'.'1 hours'));
      $ten=date('Y-m-d H:i', strtotime($date. '+'.'15 minutes'));
      $trnt=date('Y-m-d H:i', strtotime($date. '+'.'30 minutes'));
    
    
    
    
    
    
     
      if ($d==$date1) {
         
          
          $botman->say( "⏰ تذكير ⏰",$appointment->fb_id, FacebookDriver::class);
          $botman->say( "🙋‍♂️ مرحبا ".$appointment->facebook,$appointment->fb_id, FacebookDriver::class);
          $botman->say( " ⏳ تبقت ساعة واحدة على موعد حلاقتك ",$appointment->fb_id, FacebookDriver::class);
        
         
         
      }
    
    
      if ($d==$ten) {
         
    
            
          $botman->say( "⏰ تذكير ⏰",$appointment->fb_id, FacebookDriver::class);
          $botman->say( "🙋‍♂️ مرحبا ".$appointment->facebook,$appointment->fb_id, FacebookDriver::class);
          $botman->say( " ⏳ تبقت ربع ساعة على موعد حلاقتك ",$appointment->fb_id, FacebookDriver::class);
      }
      if ($d==$trnt) {
         
    
            
          $botman->say( "⏰ تذكير ⏰",$appointment->fb_id, FacebookDriver::class);
          $botman->say( "🙋‍♂️ مرحبا ".$appointment->facebook,$appointment->fb_id, FacebookDriver::class);
          $botman->say( " ⏳ تبقت نصف ساعة على موعد حلاقتك ",$appointment->fb_id, FacebookDriver::class);
      }
    
      }}
    }
  
  
  
  
  
  
  
  
  
  
  
  

}
