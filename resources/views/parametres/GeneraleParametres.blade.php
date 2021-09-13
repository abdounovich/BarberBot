
<div class="container">
    
<h3 class="text-center bg-premier p-4 rounded text-dark mt-4">  إعدادات عامة</h3>


<div class="text-right bg-dark p-2" >




 <form  method="post" action="edit-generale-parametre" enctype="multipart/form-data">
    @csrf
<div class="m-4">        
    <label class="h4 text-white " for="premier">لون الزر الأساسي :</label>
    <input class="form-control "  value="{{Setting::get('theme.premier')}}" type="color" name="premier" id="premier">
</div>

<div class="m-4">        
    <label class="h4 text-white " for="deuxieme">لون الزر الثانوي  :</label>
    <input class="form-control " value="{{Setting::get('theme.deuxieme')}}"  type="color" name="deuxieme" id="deuxieme">
</div>

<div class="m-4">        
    <label class="h4 text-white " for="text-color">لون النص   :</label>
    <input class="form-control " value="{{Setting::get('theme.text-color')}}"  type="color" name="text-color" id="text-color">
</div>

<div class="m-4">
    <label for="photo" class="h4 text-white float-right">صورة الخلفية  :</label>
<div class="row">
<div class="col-2">
<input type="file" id="imgupload" onchange="loadFile(event)"   name="bg-image" hidden>
<a href="#" onclick="$('#imgupload').trigger('click'); return false;"> 
<img class="img " id="image" 
@if (Setting::get('theme.bg-image')=="")
src="https://res.cloudinary.com/ds9qfm1ok/image/upload/v1595881085/gallery-131964752828011266_ko0lhf.png"
    
@else
src="{{Setting::get('theme.bg-image')}}"
@endIf


alt="" width="200" height="200">
</a>
<input value="{{Setting::get('theme.bg-image')}}" class="form-control" type="hidden" name="image">

</div>

</div>
    
             
</div>
<script>
    var loadFile = function(event) {
        var image = document.getElementById('image');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    </script>   
    
    





    <button style="" type="submit" class="btn btn-success">  حفظ التعديلات </button>

</form>
           
</div>
 
</div>