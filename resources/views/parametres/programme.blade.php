
  



@php
    $appointments=App\Appointment::where("ActiveType",5)->get();
@endphp







<div class="mt-5">

    <h3 class="text-center bg-premier p-4 rounded text-dark mt-4">التحكم في البرنامج</h3>

 <form action="{{url('/parametres/update/')}}" method="post">

@csrf
    <table class="table ">
    <tr class="bg-dark text-white text-center">
        <td>اليوم </td>
        <td>البداية </td>
        <td>النهاية </td>
        <td>بداية الراحة </td>
        <td>نهاية الراحة </td>
        <td>الحالة </td>
    </tr>
    @php
    $arabic = ['السبت' ,'الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة' ]; 
    $anglais = ['Saturday' ,'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday' ];  
   
    @endphp
  
@csrf @for ($i = 0; $i < 7; $i++)
<tr class="bg-secondary text-white text-center">
        <td>{{$arabic[$i]}}</td>
        <td class="text-center"><input class="form-control  {{$anglais[$i]}} " @if (Setting::get($anglais[$i].'.active')=="0" ) readonly @endif type="time" name="{{$anglais[$i].'-debut'}}" value="{{Setting::get($anglais[$i].'.debut')}}"></td>
        <td><input class="form-control  {{$anglais[$i]}} "@if (Setting::get($anglais[$i].'.active')=="0" ) readonly @endif type="time" name="{{$anglais[$i].'-fin'}}" value="{{Setting::get($anglais[$i].'.fin')}}"></td>
        <td><input class="form-control  {{$anglais[$i]}}"@if (Setting::get($anglais[$i].'.active')=="0" ) readonly @endif type="time" name="{{$anglais[$i].'-debut-repos'}}" value="{{Setting::get($anglais[$i].'.debut-repos')}}"></td>
        <td><input class="form-control  {{$anglais[$i]}} " @if (Setting::get($anglais[$i].'.active')=="0" ) readonly @endif type="time" name="{{$anglais[$i].'-fin-repos'}}" value="{{Setting::get($anglais[$i].'.fin-repos')}}"></td>
        <td><input  class=" " type="checkbox"    
            @if (Setting::get($anglais[$i].'.active')=="1" ) checked  
            @endif 
            onchange="myFunction('{{$i}}')" id="cb{{$i}}" data-on="مفعل" 
            data-off="موقف" data-onstyle="outline-success" data-offstyle="outline-danger"  data-toggle="toggle"></td>
  <input type="hidden" id="{{$i}}" name="{{$anglais[$i].'-active'}}" value="{{Setting::get($anglais[$i].'.active')}}">
      </tr>
@endfor
   <tr class="bg-dark"><td colspan="6"><div class=" text-right p-3 ">
    <button style="" type="submit" class="btn btn-success">  حفظ التعديلات </button>
 </div></td></tr>
</table>

 </form>
</div>
<script>
    function myFunction($id) {
    var checkbox=document.getElementById("cb"+$id);
    var hidden_input=document.getElementById($id);
  
     
  /*     window.location = "/actif/"+$fid;
   */  
      
  
   if (checkbox.checked == true){
    hidden_input.value="1";
    } else {
        hidden_input.value="0";
   }
  
  }
  
  ;</script> 
</div>