
<div class="container">
    
<h3 class="text-center bg-maron p-4 rounded text-dark mt-4">  إعدادات عامة</h3>


<div class="text-right bg-dark p-2" >




 <form  method="post" action="edit-generale-parametre" enctype="multipart/form-data">
    @csrf
<div class="m-4">        
    <label class="h4 text-white " for="primary">لون الزر الأساسي :</label>
    <input class="form-control "  value="{{Setting::get('theme.primary')}}" type="color" name="primary" id="primary">
</div>

<div class="m-4">        
    <label class="h4 text-white " for="secondary">لون الزر الثانوي  :</label>
    <input class="form-control " value="{{Setting::get('theme.secondary')}}"  type="color" name="secondary" id="secondary">
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
