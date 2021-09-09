

  <div class="row mt-5">
    @if ($Today_appointments->count()=='0')
        <div  class="col col-12 bg-dark text-white mt-5 " style="opacity: 0.9"><h2 class="p-4 float-right">لا توجد مواعيد لنهار اليوم</h2></div>
   @else
    <h3 class="p-2 text-white">مواعيد اليوم </h3>
    <table class="table table-striped table-dark responsive" style="opacity:0.9 ">
      <thead class=" bg-success text-right">
        <tr>
          <th scope="col">#</th>          

          <th scope="col">الفيسبوك</th>
          <th scope="col"> الحلاقة </th>
          <th scope="col">الموعد  </th>
          <th scope="col"></th>
          <th scope="col"></th>




        </tr>
      </thead>
      <tbody class=" text-right">
        @php
        date_default_timezone_set("Africa/Algiers");
           $actifTime=date('H:i');
        @endphp
        @foreach ($Today_appointments as $Today_appointment)
      
       
       
        @php


        ini_set("allow_url_fopen", 1);
        
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$Today_appointment->client->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        
        @endphp
       
     

        @if ($Today_appointment->ActiveType==5)
            <tr class="bg-warning" ><td  class="bg-warning"></td>
              <td  class="bg-warning text-dark">@php $debut = date('H:i', strtotime($Today_appointment->debut));
                echo "محجوز ";
                @endphp</td>
              <td  class="bg-warning"></td>
              <td  class="bg-warning"></td>
              <td  class="bg-warning"></td>
              <td  class="bg-warning"></td>
              

            </tr>
      
            
        @else
            
      
        <tr @if ($actifTime>=$Today_appointment->debut && $actifTime<$Today_appointment->fin)
             class="bg-info" 
        @endif>
    <input type="hidden" name="" value="   ">
          <th scope="row">{{ $loop->index +1}}
               
       </th>
          <td  class="align-middle clearfix" style="position: relative;"><img class=" border rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
            <span  dir="ltr" style=" 
            display:inline-flex;
            width: 100px;
            overflow: hidden;
            white-space: nowrap;
          text-overflow: ellipsis;"><a  class="text-white" href="sendMsg/{{$Today_appointment->fb_id}}">{{$Today_appointment->facebook}}</a></span>  <span dir="ltr" style=" position: absolute;
            top:1px;
            font-size:10px;
            right:1px; width:30px;height:30px; 
    min-width: 14px;
    text-align: center;
    line-height: 24px;
    box-shadow: 1px 1px 1px black;
 " class="badge badge-success rounded-circle "> {{$Today_appointment->client->points}}</span> 
           </td>
         
       
        <td class="align-middle">{{$Today_appointment->type->type}}</td>
         <td class="align-middle">@php $demain = date('H:i', strtotime($Today_appointment->debut));
          echo $demain;
          @endphp</td>
           
<td> 
  
  
  <input  class="m-2 p-2" type="checkbox" id="cb{{$Today_appointment->id}}" @if ($Today_appointment->ActiveType=="2" )
  checked 
  @endif onchange="myFunction('{{$Today_appointment->id}}','cb{{$Today_appointment->id}}')"
   data-on="حاضر" data-off="غائب" data-onstyle="outline-success"
   data-offstyle="outline-danger"  data-toggle="toggle">

  </td>
<td>  @php
      $theId=$Today_appointment->id;
  @endphp  <a  class="btn btn-danger " data-toggle="modal" data-target="#exampleModal{{$theId}}"><i class=" fa fa-trash fa-2x"></i>   </a>
  </td> 
        </tr>
        @endif      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" dir="rtl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> تأكيد إلغاء الموعد </h5>
         
        </div>
        <div class="modal-body  text-right"  >
هل تريد حقا إلغاء هذا الموعد ؟         </div>
        <div class="modal-footer row float-right text-right">
         <div class="col">
         <form action="/annulerByAdmin" id="myForm" method="post"> 
            @csrf           
            <input type="hidden" name="id" value="{{$Today_appointment->id}}">
            <a  href="/annulerByAdmin/" class="btn btn-danger  text-white col-4"> نعم </a>

            <a class="btn btn-secondary text-white col-4" data-dismiss="modal">  لا شكرا </a>
          </form> </div> 

        </div>
      </div>
    </div>
  </div>
        @endforeach
      </tbody>
    </table> @endif
  </div> 


<script> function sendMessage() {
  document.getElementById("myForm").submit();}</script>







