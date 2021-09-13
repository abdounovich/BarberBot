

      @extends('layouts.master')

      @section('title', 'Services ')
      
      
      
      @section('content')
      
      
      
        <div class="container">
            <div class="card mt-5 mb-5" style="opacity: 0.9"  >
                <div class="card-header  bg-success text-white ">           <h4 class=" text-center p-2 "> تعديل  " {{$type->type}} "  </h4>
                </div>
                <div class="card-body bg-dark text-white"> <div>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                    <form method="post" action="/types_edit/{{$type->id}}" role="form" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">    
                              <label for="type" class=" float-right">  نوع الحلاقة :</label>
                          <input type="text" class="form-control" value="{{$type->type}}" name="type"/>
                          </div>
                
                          <div class="form-group">
                              <label for="prix" class=" float-right">السعر: </label>
                              <input type="text" class="form-control" value="{{$type->prix}}" name="prix"/>
                          </div>
                
                          <div class="form-group">
                              <label for="temps" class=" float-right">الوقت:</label>
                              <input type="text" class="form-control" value="{{$type->temps}}" name="temps"/>
                          </div>
                          <div class="form-group">
                              <label for="point" class=" float-right"> النقاط:</label>
                              <input type="text" class="form-control"  value="{{$type->point}}" name="point"/>
                          </div>

                          <div class="form-group">
                            <label for="photo" class=" float-right">الصورة :</label>
        <div class="row">
          <div class="col-2">
            <input type="file" id="imgupload" onchange="loadFile(event)"  name="photo" hidden>
        <a href="#" onclick="$('#imgupload').trigger('click'); return false;"> 
           <img class="img " id="image"  
           src="{{$type->photo}}"
            alt="" width="200" height="200">           
            <input value="{{$type->photo}}" class="form-control" type="hidden" name="image">

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
                            
                            
                    <div class="row">
                       
                        <div class="col col-12">
                           <button style="width: 100%" type="submit" class="btn btn-success">  حفظ التغييرات</button>
 
                        </div>
                      
                    </div>    
                      
                        </form>
                  </div></div> 
              </div>   
    
        <div class="row">
        <div class="col-sm-8 offset-sm-2">
        
       </div>
       </div>
    </div>



   

    

    @stop
