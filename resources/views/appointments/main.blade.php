
@extends('layouts.master')

@section('title', 'Home')



@section('content')



@if (\Session::has('success'))
    <div class="alert  alert-info  text-right ">
        <ul>
            <li class="p-2">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif


@include('appointments.today')
@include('appointments.tomorrow')
@include('appointments.afterTomorow')
@include('appointments.all')


  <script>
  function myFunction($fid,$cbid) {
    var checkBox=document.getElementById($cbid);

   
/*     window.location = "/actif/"+$fid;
 */  
    

 if (checkBox.checked == true){
  window.location = "/actif/"+$fid+"/2";
  } else {
    window.location = "/actif/"+$fid+"/1";

 }

}

;</script>
@stop