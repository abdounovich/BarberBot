 <h3 class="text-center bg-premier p-4 rounded text-dark mt-4">حجز موعد خاص</h3>


<div class="text-right bg-dark p-2" style="opacity: 0.9" >




 <form  method="post" enctype="multipart/form-data" action="Add-private-appointment" >
    @csrf
    <div class="m-4">
        
   <label class="h4 text-white " for="debut">من :</label>

    <input class="form-control "  type="time" name="debut" id="debut">
</div>


<div class=" m-4">
        
     <label  class="h4 text-white" for="fin" >إلى  :</label>
    <input class="  form-control"type="time" name="fin" id="fin">

</div>
<div class="m-4">
        
    <label  class="h4 text-white" for="jour">يوم :</label>
  <input class="form-control"   type="date" name="jour" id="jour">

</div>

<div class=" m-4">
    
    <input class="  btn btn-success"   type="submit" value="إضافة">
</div>
</form>
           
</div>
 
  



    @php
        $appointments=App\Appointment::where("ActiveType",5)->get();
    @endphp
    
    
    
    
    
    <h3 class="text-center bg-premier p-4 rounded text-dark mt-4">المواعيد الخاصة  </h3>

    <table class="table bg-dark text-white">
        <thead>
        
        </thead>
        <tbody>
         
            @foreach ($appointments as $appointment)
            <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$appointment->jour}}</td>
                <td>{{$appointment->debut}}</td>
                <td> {{$appointment->fin}}</td>
                <td class="text-left">        <a  class="btn btn-danger "  value="" href="/annulerByAdmin/{{$appointment->id}}">حذف</a>
                    <a  class="btn btn-warning "  value="" href="#">تعديل</a>
                </td>
              </tr>
             
    
    
            
        
        @endforeach
         
           
         
        </tbody>
      </table>





