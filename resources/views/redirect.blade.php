<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="3;url=/client/{{$client}}" />

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
$image=Setting::get('theme.bg-image');
@endphp
<style>

body{
    
  
    background:url("{{$image}}") ;
    background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
font-family: 'Cairo', sans-serif;
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

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}



    .bg-premier{
background-color:{{Setting::get('theme.premier')}};

    }


   
    .btn-premier{
      background-color:{{Setting::get('theme.premier')}};
    }
 


    .bg-deuxieme{
background-color:{{Setting::get('theme.deuxieme')}};

    }


  
    .btn-deuxieme{
      background-color:{{Setting::get('theme.deuxieme')}};
    
    }
 
    .text-color{
      color:{{Setting::get('theme.text-color')}};
    }
 
 

    .text-premier{
      color:{{Setting::get('theme.premier')}};
    }
 
 

</style>

<!-- Optionally add this to use a skin : -->
    <!-- Styles -->
</head>
<body class="bg-dark text-dark">
<div class=" p-2 m-2 h1 bg-dark text-white text-center"> {{$message}}
</div>
</body>
</html>




















   
   

