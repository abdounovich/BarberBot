
@extends('layouts.master')

@section('title', 'Clients')

@section('content')





 

  




  <div class="row my-5 p-3">
  
 
    
  
    <h3 class="p-2 text-white">قائمة الزبائن :  </h3>
    <table class="table text-color table-striped bg-deuxieme"style="opacity:0.9">
      <thead class=" bg-premier  text-right">
        <tr class="text-dark">

          <th scope="col">الفيسبوك</th>
          <th scope="col"></th>
          <th scope="col">الرصيد </th>
          <th scope="col"> </th>
          <th scope="col">تاريخ التسجيل </th>

        </tr>
      </thead>
      <tbody class=" text-right">
     
        @foreach ($clients as $client)
        @php
      
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$client->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp
        <tr>
          <td class="align-middle"><img style="border-width: 5px;" class="  border border-white ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$client->facebook}}</td>
         
        <td class="align-middle">
        
   <form action="{{route("client.editpoints",$client->id)}}" method="post">
    @csrf
  <td><input type="text" class=" form-control " name="points" value="{{$client->points}}" id="">            
  </td><td><button class="btn btn-premier " type="submit">تغيير</button>
</td>
          </span> 
        </td>
    
            <td class="align-middle"> @php  carbon\Carbon::setLocale('ar');
              echo $client->created_at->diffForHumans(); @endphp    </td>

        </tr>
    
        @endforeach
      </tbody>
    </table>
  </div>
</div>


<div class=" container">
  <div class="row">
  <div class=" justify-content-center">{{$clients->links()}}
 </div>
</div> 



@stop