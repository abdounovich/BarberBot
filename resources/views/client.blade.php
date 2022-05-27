<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BarberBot') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{URL::asset('js/jquery.knob.js',true)}}"></script>
    <script src="{{URL::asset('js/jquery.throttle.js',true)}}"></script>
    <link href="{{URL::asset('css/jquery.classycountdown.css',true)}}" rel="stylesheet">
<script src="{{URL::asset('js/jquery.classycountdown.js',true)}}"></script>
     
@php
    




    if (Setting::get('id_'.$user.'/theme')=="") {
$premier=Setting::get('id_0/theme.premier');
$deuxieme=Setting::get('id_0/theme.deuxieme');
$text_color=Setting::get('id_0/theme.text-color');
$bg_image=Setting::get('id_0/theme.bg-image');

        }
        else {
        
        $premier=Setting::get('id_'.$user.'/theme.premier');
        $deuxieme=Setting::get('id_'.$user.'/theme.deuxieme');
        $text_color=Setting::get('id_'.$user.'/theme.text-color');
        $bg_image=Setting::get('id_'.$user.'/theme.bg-image');
      }
      
 @endphp



 <style>




body{


background:url({{$bg_image}});
font-family: 'Cairo', sans-serif;
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;

}
.bg-premier{
background-color:{{$premier}};

}



.btn-premier{
background-color:{{$premier}};
}



.bg-deuxieme{
background-color:{{$deuxieme}};

}



.btn-deuxieme{
background-color:{{$deuxieme}};

}

.text-color{
color:{{$text_color}};
}



.text-premier{
color:{{$premier}};
}




</style>

<!-- Optionally add this to use a skin : -->
    <!-- Styles -->
</head>


<script type="text/javascript">

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {
        return;
      }
      js = d.createElement(s);
      js.id = id;
      js.src = "https://connect.facebook.com/en_US/messenger.Extensions.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'Messenger'));
    window.extAsyncInit = function() {

        let app_id=document.getElementById('app_id').value;


        MessengerExtensions.getContext(app_id, 
        function success(user_ids) {
  // User ID was successfully obtained. 
  let psid = user_ids.psid;
document.getElementById('id').value=psid;

}, function error(err, errorMessage) {      
  // Error handling code
});



      
           



          
    
    };
     
    








  






    </script>
<body dir="rtl" >
   
    
<div class="m-4">
    <div  class=" card bg-premier text-color  justify-content-center align-self-center align-items-center" style="opacity: 0.9">
        @php


        ini_set("allow_url_fopen", 1);
        
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$client->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        
        @endphp
        <img src="{{$picture}}" alt="John"  width="100" height="100" class=" align-self-center m-4 border border-white ">
        <h3 class="mt-2 p-2  text-white bg-dark">{{$client->facebook}}</h3>
      
    <div>
        <div class="h4">رصيدي 🎁   :            
        <span class="badge badge-dark">{{$client->points}} نقطة  </span>
        </div>
    </div>
           

          
      </div>
</div>
 @if ($difmin-3600 >'0')
      <div  class="card  mt-4 bg-premier text-dark " style="opacity: 0.9">
  
      
    
           



                
                <div   dir="rtl" class="p-2 m-2 h4 text-dark"> موعدك يوم   {{$yawm}}  على   {{$appointment->debut}}   </div>
              
<div style="direction: ltr "  id="countdown-container"></div>
{{-- @if ($difmin>32400)  --}}
<div>
 <a style="width: 60%" class="btn btn-danger m-2  text-white " data-toggle="modal" data-target="#exampleModal">  إلغاء موعدي   </a>
</div>



{{-- @endif --}}

<p></p>
<p></p> 

          
      </div>

          
      @else
      <div class="col col-12 bg-dark text-white m-2  " style="opacity: 0.9"><h4 class="p-4 text-right">لا توجد مواعيد لنهار اليوم</h4></div>
     
  @endif
    





           <input type="hidden" id="hidden" name="hidden" value="{{$difmin}}">

       


<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" dir="rtl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> تأكيد إلغاء الموعد </h5>
         
        </div>
        <div class="modal-body  text-right"  >
هل تريد حقا إلغاء موعدك ؟         </div>
        <div class="modal-footer row float-right text-right">
         <div class="col">
           <form action="/annuler" id="myForm" method="get"> 
            @csrf           
            <input type="hidden" name="id" id="id" >
            <input type="hidden" name="app_id" id="app_id" value="{{ env("FACEBOOK_APP_ID")}}">
            <input type="hidden" name="facebook" id="facebook" value="{{$client->facebook}}">


                        <a id="clc" class="btn btn-danger  text-white col-4"> نعم </a>

            <a class="btn btn-secondary text-white col-4" data-dismiss="modal">  لا شكرا </a>
          </form> </div> 

        </div>
      </div>
    </div>
  </div>

    <script> 
    str=parseInt(document.getElementById('hidden').value);

    
    $('#countdown-container').ClassyCountdown({

// flat-colors, flat-colors-wide, flat-colors-very-wide, 
// flat-colors-black, black, black-wide, black-very-wide, 
// black-black, white, white-wide, 
// white-very-wide or white-black
    theme: "black-black",

// end time
    end: $.now() + str-3600,
    now: $.now(),

// whether to display the days/hours/minutes/seconds labels.
    labels: true,

// object that specifies different language phrases for says/hours/minutes/seconds as well as specific CSS styles.
    labelsOptions: {
        lang: {
            days: 'يوم ',
            hours: 'ساعة ',
            minutes: 'دقيقة',
            seconds: 'ثانية'
        },
        style: 'font-size: 0.7em;'
    },

// custom style for the countdown
    style: {
        element: '',
        labels: false,
        textCSS: '',
        days: {
            gauge: {
                thickness: 0.1,
                bgColor: 'rgba(0, 0, 0, 0)',
                fgColor: 'rgba(0, 0, 0, 1)',
                lineCap: 'butt'
            },
            textCSS: ''
        },
        hours: {
            gauge: {
                thickness: 0.1,
                bgColor: 'rgba(0, 0, 0, 0)',
                fgColor: 'rgba(0, 0, 0, 1)',
                lineCap: 'butt'
            },
            textCSS: ''
        },
        minutes: {
            gauge: {
                thickness: 0.1,
                bgColor: 'rgba(0, 0, 0, 0)',
                fgColor: 'rgba(0, 0, 0, 1)',
                lineCap: 'butt'
            },
            textCSS: ''
        },
        seconds: {
            gauge: {
                thickness: 0.1,
                bgColor: 'rgba(0, 0, 0, 0)',
                fgColor: 'rgba(0, 0, 0, 1)',
                lineCap: 'butt'
            },
            textCSS: ''
        }
    },

// callback that is fired when the countdown reaches 0.
    onEndCallback: function () {
    }

});</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script type="text/javascript">



    function getvalue() {
                    var debut =document.getElementById("debut");
    
    
                    debut.value =event.target.name;
                   
    
    }
            
        </script>




<script>
    $('#clc').click(function(){
        
        var facebook = $('#facebook').val();

        var id = $('#id').val();
    
        var link="/annuler/"+id+"/"+facebook;
       $('#myForm').attr('action', link);
       $('#myForm').submit();
        });
    
    </script>
</body>
</html>






