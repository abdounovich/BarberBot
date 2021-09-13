@extends('layouts.master')

@section('title', 'parametres')



@section('content')




@if (\Session::has('success'))
    <div class="alert  alert-info  text-right ">
        <ul>
            <li class="p-2">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@if (\Session::has('erreur'))
    <div class="alert  alert-danger  text-right ">
        <ul>
            <li class="p-2">{!! \Session::get('erreur') !!}</li>
        </ul>
    </div>
@endif


@include('parametres.PrivateAppointment')
@include('parametres.programme')
@include('parametres.GeneraleParametres')


@stop
