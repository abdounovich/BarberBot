<html>
    <head>
        <title> @yield('title')</title>
        <meta charset="UTF-8">
        <meta  name="viewport" content="width= {screenWidth}">

       
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="refresh" content="250">

        <title>{{ config('app.name', 'BarberBot') }}</title>


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="{{ asset('js/app.js',true )}}" type="text/js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@include('layouts.style.custom-style')

    </head>
    <body dir="rtl">
      
        <div class="se-pre-con"></div>
        <div>   @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif</div>


     

       
          <div id="demo" class=" m-5 p-4">
          

<div class=" float-right text-center">
  <a href="/parametres" >
<p class="h3 text-color text-center">{{Auth::user()->name}}</p>

@if (Auth::user()->avatar=="")
      <i class="fa fa-5x  fa-user text-premier text-center"></i>
@else
      <img src="{{Auth::user()->avatar}}" alt="avatar" width="100px" height="100px">

@endif
</a>
</div>


       <div class="container  ">
            <div class="row ">
              <div class="col p-4 btn-group">
                <a class=" col col-2 text-deuxieme btn btn-premier m-2 p-2 " title="الرئيسية" style="font-size: 60px"   href="/"><i class=" p-2 fa fa-home"></i> </a>

<a href="/main" class=" col col-2 text-text-deuxieme btn btn-premier m-2 p-2 " title="المواعيد" style="font-size: 60px"><i class=" p-2 fa fa-calendar"></i></a> 

            <a href="/clients" class=" col col-2 text-text-deuxieme btn btn-premier m-2 p-2 " title="الزبائن" style="font-size: 60px"> <i class=" p-2 fa fa-users"></i></a>
            <a href="/types" class=" col col-2 text-text-deuxieme btn btn-premier m-2 p-2 " title="الخدمات" style="font-size: 60px"><i class=" p-2 fa fa-server"></i></a>
            <a class=" col col-2 text-text-deuxieme btn btn-premier m-2 p-2 " title="رسالة" style="font-size: 60px"   href="/sendMsg/0/"><i class=" p-2 fa fa-comments"></i> </a>

            <a href="/parametres" class=" col col-2 text-text-deuxieme btn btn-premier m-2 p-2 " title="الإعدادات" style="font-size: 60px"> <i class=" p-2 fa fa-wrench"></i></a> 




          </div>
            </div>
          </div> </div>





          <!-- Modal -->
        
            
   
            
        
        <div class="container">
            @yield('content')
        </div>





        
        
      <script src="{{ asset('js/app.js') }}" type="text/js"></script>
     
  </body>
</html>