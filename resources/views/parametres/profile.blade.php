 
 @php
     $user=Auth::user();
 @endphp
 <h3 class="text-center bg-premier p-4 rounded text-dark mt-4">البيانات الشـخـصـيـة</h3>


<div class="text-right bg-dark p-2" style="opacity: 0.9" >




 <form  method="post" enctype="multipart/form-data" action="edit-profile" >
    @csrf
    <div class="m-4">
        
   <label class="h4 text-white " for="debut">الإســـم</label>

    <input class="form-control "  type="text" value="{{$user->name}}" name="name" id="name">
</div>


<div class=" m-4">
        
     <label  class="h4 text-white" for="fin" >الــبـريـد الإلـكــتــرونـي </label>
    <input class="  form-control" type="email" value="{{$user->email}}" name="email" id="email">

</div>
<div class="m-4">
        
    <label  class="h4 text-white" for="jour">  كــلــمــة المــرور الجـديـدة</label>
  <input class="form-control" value=""   type="password" name="password" id="password">

</div>

<div class="m-4">
        
    <label  class="h4 text-white" for="jour"> تأكــــيد كــلــمــة المــرور </label>
  <input class="form-control" value=""   type="password2" name="password2" id="password2">

</div>


<div class="m-4">
        
    <label  class="h4 text-white" for="jour"> الصورة </label>
  <input class="form-control" value=""   type="text" name="avatar" id="avatar">

</div>

<div class=" m-4">
    
    <input class="  btn btn-success"   type="submit" value="حفظ التعديلات ">
</div>
</form>
           
</div>
 
  



    
 

  



