<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Appointment </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
    <script src="{{URL::asset('js/jquery.throttle.js')}}"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/css/jquery.classycountdown.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/js/jquery.classycountdown.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
   
   

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

 

  .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

#top-menu a{
background-color: green;
color: white;
font-weight:bold;
}

#top-menu input:hover{
    color: white;
    background-color:deepskyblue
}
#top-menu input:focus{
    color: white;
    background-color:deepskyblue
}



</style>

<!-- Optionally add this to use a skin : -->
    <!-- Styles -->
</head>
<body dir="ltr">


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





    



@php
  $OneApp=App\Appointment::where('facebook',$username)
    ->where('ActiveType','1')->count();
    
   @endphp 







@if ($OneApp>0) 
<div  class="h3 bg-danger text-white text text-center p-2 m-2  rounded" >???????? ?????????? ???? ?????????? ?????? ???????? ???? ????????  </div>


    
@else
    


    


            <div class="container">

                @php
                $date = date("Y-m-d");

                @endphp

@if (empty($items))

<div  class="h3 bg-danger text-white text text-center p-2 m-2  rounded" >???????? ?????????? ???? ???????????????? ????????????  </div>

    @php
        return;
    @endphp
@endif
                @switch($var)
                    @case(1)
                    
                    <div  class="h3 bg-premier text-color text text-center p-2 m-2  rounded" >???????????????? ?????????????? ??????????  </div>

                        @break
                    @case(2)
            <div  class="h3 bg-premier text-color text text-center p-2 m-2  rounded" > ???????????????? ?????????????? ??????   </div>

                        @break
                  
                        @case(3)
                        <div  class="h3 bg-premier text-color text text-center p-2 m-2  rounded" >???????????????? ?????????????? ?????? ????  </div>

                     
                @endswitch
                
                <div  class=" bg-dark   text-center  m-2  rounded" >
                @foreach ($items as $item)
            @php   
            date_default_timezone_set("Africa/Algiers");
            $item2=date("H:i", strtotime(date($item)));
            $time_now = date("Y-m-d H:i:s");
            @endphp
            @if ($var==1)
                
           
            @if ($item<$time_now)
            <a href="#" class ="m-1 text-center btn btn-warning disabled  bg-danger text-white border border-danger"  >
            {{$item2}}
            </a>
            @else
            <input class="btn btn-success m-1 " name="{{$item}}" onclick="getvalue()"  type="button" value="{{$item2}}">
            @endif
            @else
            <input class="btn btn-success m-1 " name="{{$item}}"  onclick="getvalue()" type="button" value="{{$item2}}">


             @endif
            @endforeach



            </div>
            <div class="row">
                <div class=" col col-12 ">
                        <input type="button" class="btn btn-success mt-1" id="clc"   style="display: none; width:100%" 
                        value="  ?????????????????? ?????????????????? ">
                </div>
                </div>
            </div>

    
       




   

        

   




    
@php
    $id="";
    $debut="";
@endphp


<form id="myForm"  action="/" method="get">
    @csrf




<input type="hidden" name="id" id="id" >
<input type="hidden" name="debut" id="debut">
<input type="hidden" name="type" id="type" value="{{$type->id}}">
<input type="hidden" name="jour" id="jour" value="{{$jour}}">
<input type="hidden" name="username" id="username" value="{{$username}}">
<input type="hidden" name="Cid" id="Cid" value="{{$Cid}}">
<input type="text" name="user" id="user" value="{{$user}}">
<input type="hidden" name="app_id" id="app_id" value="{{ env("FACEBOOK_APP_ID")}}">

             
  
  </form>

    <script type="text/javascript">



function getvalue() {
                var debut =document.getElementById("debut");
                


                debut.value =event.target.name;
                var x = document.getElementById("clc");
 
 x.style.display = "block";

}
       

     
    </script>

<script>
    $('#clc').click(function(){
        
        var debut = $('#debut').val();
        var username = $('#username').val();
        var Cid = $('#Cid').val();
        var type = $('#type').val();
        var jour = $('#jour').val();
        var id = $('#id').val();
        var user = $('#user').val();

        var link="/confirmationMessage/"+id+"/"+debut+"/"+type+"/"+jour+"/"+username+"/"+Cid+"/"+user;
       $('#myForm').attr('action', link);
       $('#myForm').submit();
        });
    
    </script>

    @endif
</body>
</html>