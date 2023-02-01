@extends('layouts.main', ['activePage' => 'formulario', 'titlePage' => __('')])
@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
          <form action="{{route('update',$id->id)}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="card">
            <div class= "card-header card-header-info">
            <h4 class="card-title">Editar información de colegio</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <label class="col-sm-2 col-form-label">CUE (clave única de establecimiento)</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="cue" id="cue" autocomplete="off" value="{{$id->cue}}">
                @error('cue')
                <div id="cue-error" class="error text-danger pl-3" for="cue" style="display: block;">
                <strong>El campo debe ser del tipo numérico y contener 9 caracteres.</strong>
                </div>
              @enderror 
              </div>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Nombre del Colegio</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="nombre" value="{{$id->nombre}}" id="nombre">
                @error('nombre')
                <small class="text-danger">{{$message}}</small>
              @enderror 
              </div>
            </div>
                <div class="row">
                <label class="col-sm-2 col-form-label">Gestión</label>
                &nbsp &nbsp &nbsp
                  <div class="form-check form-check-radio">
                  <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="gestion" id="exampleRadios1" value="Privada">Privada
                    <span class="circle">
                    <span class="check"></span>
                    </span>
                    </label <?php if($id->gestion=='Privada') echo 'selected="selected" ';?>>
                    &nbsp &nbsp
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gestion" id="exampleRadios2" value="Pública" checked>Pública
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label<?php if($id->gestion=='Publica') echo 'selected="selected" ';?>>
                    </div>
                  

                @error('gestion')
                <small class="text-danger">{{$message}}</small>
              @enderror 
              </div>
          
             <div class="row">
                <label class="col-sm-2 col-form-label">Teléfono</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="telefono" value="{{$id->telefono}}" id="telefono">
                @error('telefono')
                <small class="text-danger">{{$message}}</small>
              @enderror 
              </div>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Dirección</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="direccion" value="{{$id->direccion}}" id="direccion">
                @error('direccion')
                <small class="text-danger">{{$message}}</small>
              @enderror 
              </div>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Localidad</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="localidad" value="{{$id->localidad}}" id="localidad">
                @error('localidad')
                <small class="text-danger">{{$message}}</small>
              @enderror 
              </div>
            </div>
             <div class="row">
                <label class="col-sm-2 col-form-label">Provincia</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="provincia" value="{{$id->provincia}}" id="provincia">
                @error('provincia')
                <small class="text-danger">{{$message}}</small>
              @enderror 
              </div>
            </div>
             <div class="row">
                <label class="col-sm-2 col-form-label">Correo electrónico</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="email" id="email" value="{{$id->email}}">
                @error('email')
                <small class="text-danger">{{$message}}</small>
              @enderror 
              </div>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label">Logo institucional</label>
                <div class="col-sm-7">
        
                  <?php
                  $Host ="localhost";
                  $uname = "root";
                  $pwd = '';
                  $db_name = "centro";

                  $result = mysqli_connect($Host,$uname,$pwd) or die("Could not connect to database." .mysqli_error());
                  mysqli_select_db($result,$db_name) or die("Could not select the databse." .mysqli_error());
                  $image_query = mysqli_query($result,"select file from files where id=$id->files_id");
                  while($rows = mysqli_fetch_array($image_query))
                    {
                      $img_src = $rows['file'];
                    }
                  $rutaimagen='http://127.0.0.1:8000/file/'.$img_src.'';
                  ?>
                  <div style=" display: inline-block;">
                    <?php
                  echo'<img src="'.$rutaimagen.'" width="80px" height="80px"/>';?>
                </div>
                <div style=" display: inline-block;">
                <input type="file" class="form-control" name="file" id="file" accept="image/*">
                @error('file')
                <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
               <div id="imagePreview">
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
              <script type="text/javascript">
                (function(){
                  function filePreview(input){
                    if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload= function(e){
                    $('#imagePreview').html("<img src='"+e.target.result+"'  width='120px' height='120px'/>");
                    }
                    reader.readAsDataURL(input.files[0]);
                    }
                    }
                    $('#file').change(function(){
                    filePreview(this);
                    });
                    })();
              </script>
             </div> 
              </div>
            </div>
              
              
            
             
            <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
                <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
              </div>
              </div>
            </div>
     </div>
          </form>
        </div>
      </div>
      </div>
      </div>
    

@endsection