
@extends('layouts.master')

@section('title', 'Clients')



@section('content')





 

  
<div class="container">
    <div class="row">

        <div class="col col-4 ">  <div class="card rounded bg-dark text-dark p-2 shadow" style="opacity: 0.8" >
        <i class="m-4 p-2 fa fa-users fa-5x d-flex align-self-center text-maron "></i>
        <div class="h3 p-2 text-light   d-flex align-self-center"> الزبائن   </div>
        <div class="h1 text-light  d-flex align-self-center">{{$clients->count()}}</div>

        <a  href="/clients"  class=" text-dark m-4 p-2 btn btn-maron  btn d-flex align-self-center">تصفح الجميع</a>
         </div>
        </div>
      

        <div class="col col-4 ">  <div class="card rounded bg-dark  text-dark p-2 shadow" style="opacity: 0.8" >
            <i class="m-4 p-2 fa fa-calendar fa-5x d-flex align-self-center text-maron "></i>
            <div class="h3 p-2 text-light    d-flex align-self-center"> المواعيد   </div>
            <div class="h1 text-light  d-flex align-self-center">{{$appointments->count()}}</div>
    
            <a  href="/rdv"  class=" text-dark m-4 p-2 btn btn-maron  btn d-flex align-self-center">تصفح الجميع</a>
             </div>
            </div>


            
            <div class="col col-4 ">  <div class="card rounded bg-dark text-dark p-2 shadow" style="opacity: 0.8" >
                <i class="m-4 p-2 fa fa-list fa-5x d-flex align-self-center text-maron "></i>
            <div class="h3 p-2 text-light   d-flex align-self-center"> الخدمات     </div>
            <div class="h1 text-light  d-flex align-self-center">{{$types->count()}}</div>
    
            <a href="/types" class=" text-dark m-4 p-2 btn btn-maron  btn d-flex align-self-center">تصفح الجميع</a>
             </div>
            </div>
    </div>
</div>






@stop