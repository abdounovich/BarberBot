        
    


@php
   
$user_id="0";
$premier=Setting::get('id_0/theme.premier');
$deuxieme=Setting::get('id_0/theme.deuxieme');
$text_color=Setting::get('id_0/theme.text-color');
$bg_image=Setting::get('id_0/theme.bg-image');
@endphp



@auth
       @php
           
        $user_id=Auth::user()->id;


        
        if (Setting::get('id_'.$user_id.'/theme')=="") {
          $user_id="0";
$premier=Setting::get('id_0/theme.premier');
$deuxieme=Setting::get('id_0/theme.deuxieme');
$text_color=Setting::get('id_0/theme.text-color');
$bg_image=Setting::get('id_0/theme.bg-image');

        }
        else {
        
        $premier=Setting::get('id_'.$user_id.'/theme.premier');
        $deuxieme=Setting::get('id_'.$user_id.'/theme.deuxieme');
        $text_color=Setting::get('id_'.$user_id.'/theme.text-color');
        $bg_image=Setting::get('id_'.$user_id.'/theme.bg-image');
      }
        @endphp
@endauth



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