
@extends('layouts.master')

@section('title', 'Redirect ')
  <meta http-equiv="refresh" content="3;url=/client/{{$client}}" />



@section('content')


  <div style="color: white">{{$message}}</div>






   
   

@stop
