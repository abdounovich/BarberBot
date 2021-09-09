


  <div class="row mt-5">
    @if ($Tomorow_appointments->count()=='0')
        <div  class="col col-12 bg-dark text-white mt-5  " style="opacity: 0.9"><h2 class="p-4 float-right">لا توجد مواعيد لنهار الغد</h2></div>
   @else
    <h3 class="p-2 text-white">مواعيد الغد </h3>
    <table class="table table-striped table-dark"style="opacity:0.9">
      <thead class=" bg-success text-right">
        <tr>
          <th scope="col">#</th>          

          <th scope="col">الفيسبوك</th>
          
          <th scope="col"> الحلاقة </th>

          <th scope="col">الموعد  </th>

        </tr>
      </thead>
      <tbody class=" text-right">
     
        @foreach ($Tomorow_appointments as $Tomorow_appointment)
     @php
      
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$Tomorow_appointment->client->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp  
        @if ($Tomorow_appointment->ActiveType==5)
        <tr class="bg-warning" ><td  class="bg-warning"></td>
          <td  class="bg-warning text-dark">@php $debut = date('H:i', strtotime($Tomorow_appointment->debut));
                echo "محجوز ";
            @endphp</td>
          <td  class="bg-warning"></td>
          <td  class="bg-warning"></td>
          

        </tr>
  
        
    @else
        <tr>
          <th scope="row">{{ $loop->index+1 }}
          </th>
        
          <td  class="align-middle clearfix" style="position: relative;"><img class=" border rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$Tomorow_appointment->facebook}}  <span dir="ltr"  style=" position: absolute;
            top:1px;
            font-size:13px;
            right:1px; width:30px;height:30px; 
    min-width: 14px;
    text-align: center;
    line-height: 24px;
    box-shadow: 1px 1px 1px black;
 " class="badge badge-success   text-center rounded-circle  ">{{$Tomorow_appointment->client->points}}</span> 
        {{--   <form action="{{route("client.editpoints",$Tomorow_appointment->client->id)}}" method="post">
            @csrf
          <input type="text" class=" form-control " name="points" value="{{$Tomorow_appointment->client->points}}" id="">            
          <button class="btn btn-primary" type="submit">تغيير</button>

        </form> --}}</td>
         
       
        <td class="align-middle">{{$Tomorow_appointment->type->type}}</td>
         <td class="align-middle">@php $demain = date('H:i', strtotime($Tomorow_appointment->debut));
          echo $demain;
          @endphp</td>
           

        </tr>
    @endIf
        @endforeach
      </tbody>
    </table> @endif
  </div>


