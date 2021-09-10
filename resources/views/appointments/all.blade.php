

  <div class="row mt-5 mb-5">
    @if ($Inactif_appointments->count()=='0')
    <div  class="col col-12 text-dark bg-dark mt-5" style="opacity: 0.9"><h2 class="p-4 float-right">   لا توجد مواعيد سابقة </h2></div>

   
@else
    <h3 class="p-2 text-color">المواعيد السابقة :</h3>
    <table class="table  bg-deuxieme " style="opacity:0.9 ">
      <thead class=" bg-premier text-deuxieme text-right">
        <tr>

          <th scope="col">الفيسبوك</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">الوقت </th>
        </tr>
      </thead>
      <tbody class=" text-right">
     
        @foreach ($Inactif_appointments as $Inactif_appointment)
          @php
      
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$Inactif_appointment->client->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp  
        <tr class="bg-deuxieme text-color" >
          <td  class="align-middle clearfix col col-5" style="position: relative;"><img class=" border rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$Inactif_appointment->facebook}}  <span dir="ltr"  style=" position: absolute;
            top:1px;
            font-size:13px;
            right:1px; width:30px;height:30px; 
    min-width: 14px;
    text-align: center;
    line-height: 24px;
    box-shadow: 1px 1px 1px black;
 " class="badge badge-success text-center  rounded-circle  ">{{$Inactif_appointment->client->points}}</span> 
   <form action="{{route("client.editpoints",$Inactif_appointment->client->id)}}" method="post">
    @csrf
  <td><input type="text" class=" form-control " name="points" value="{{$Inactif_appointment->client->points}}" id="">            
  </td><td><button class="btn btn-premier " type="submit">تغيير</button>
</td>
</form>
          </td>


         
       
         <td class="align-middle col col-3"> @php  carbon\Carbon::setLocale('ar');
          echo $Inactif_appointment->created_at->diffForHumans(); @endphp    </td>

        </tr>
    
        @endforeach
      </tbody>
    </table>
   @endif
  </div>
</div>




<div class=" container ">
     <div  class="row d-flex justify-content-center">
     <div class="text-dark"  >{{$Inactif_appointments->links('vendor.pagination.bootstrap-4')}}
    </div>
   </div> 
</div>
