@extends('layouts.main', ['activePage' => 'docente', 'titlePage' => __('')])
<?php
$detect = new Mobile_Detect;
?>
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{ route('docentes.update',$id->id) }}" method="POST" class="form-horizontal">
        @csrf
        @METHOD('PUT')
        <div class="card">
        <div class= "card-header card-header-info">
        <h4 class="card-title">Editar Docente</h4>
        </div>
        <div class="card-body">
         <br>
         <?php 
          if ($detect->isMobile() or $detect->isTablet()) {?>
          <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <label>DNI</label>
            <input type="text" name="dnidocente" class="form-control" value="{{$id->dnidocente}}">
            @if ($errors->has('dnidocente'))
            <div id="dnidocente-error" class="error text-danger pl-3" for="dnidocente" style="display: block;">
            <strong>{{ $errors->first('dnidocente') }}</strong>
            </div>
            @endif
          </div>
            
          <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <label>Nombre</label>
            <input type="text" name="nombredocente" class="form-control" value="{{$id->nombredocente}}">
            @if ($errors->has('nombredocente'))
            <div id="nombredocente-error" class="error text-danger pl-3" for="nombredocente" style="display: block;">
            <strong>{{ $errors->first('nombredocente') }}</strong>
            </div>
            @endif
          </div>
         
          <div class="row" style="margin-right: 3px; margin-left: 3px;">
            <label>Apellido</label>
            <input class="form-control" name="apellidodocente" value="{{$id->apellidodocente}}">
            @if ($errors->has('apellidodocente'))
            <div id="apellidodocente-error" class="error text-danger pl-3" for="apellidodocente" style="display: block;">
            <strong>{{ $errors->first('apellidodocente') }}</strong>
            </div>
            @endif
          </div>
     
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Fecha de nacimiento</label>
          <input type="date" name="fechanacimientodoc" class="form-control" min="1951-01-01" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 18 years"));?>" value="{{$id->fechanacimientodoc}}">
          @if ($errors->has('fechanacimientodoc'))
          <div id="fechanacimientodoc-error" class="error text-danger pl-3" for="fechanacimientodoc" style="display: block;">
          <strong>{{ $errors->first('fechanacimientodoc') }}</strong>
          </div>
          @endif
        </div>

        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Género</label>
          <select name="generodocente" id="opciongenero" class="form-control" value="{{$id->generodocente}}">
          <option></option>
          <option value="Femenino" <?php if($id->generodocente=='Femenino') echo 'selected="selected" ';?>>Femenino
          <option value="Masculino" <?php if($id->generodocente=='Masculino') echo 'selected="selected" ';?>>Masculino
          </select>
          @if ($errors->has('generodocente'))
          <div id="generodocente-error" class="error text-danger pl-3" for="generodocente" style="display: block;">
          <strong>{{ $errors->first('generodocente') }}</strong>
          </div>
          @endif
        </div>
        
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Estado civil</label>
          <select name="estadocivildoc" id="opcionestadocivil" class="form-control" value="{{$id->estadocivildoc}}">
          <option></option>
          <option value="Soltera/o" <?php if($id->estadocivildoc=='Soltera/o') echo 'selected="selected" ';?>>Soltera/o
          <option value="Casada/o" <?php if($id->estadocivildoc=='Casada/o') echo 'selected="selected" ';?>>Casada/o
          <option value="Divorciada/o" <?php if($id->estadocivildoc=='Divorciada/o') echo 'selected="selected" ';?>>Divorciada/o
          <option value="Viuda/o" <?php if($id->estadocivildoc=='Viuda/o') echo 'selected="selected" ';?>>Viuda/o
          <option value="En concubitato" <?php if($id->estadocivildoc=='En concubitato') echo 'selected="selected" ';?>>En concubitato
          </select>
          @if ($errors->has('estadocivildoc'))
          <div id="estadocivildoc-error" class="error text-danger pl-3" for="estadocivildoc" style="display: block;">
          <strong>{{ $errors->first('estadocivildoc') }}</strong>
          </div>
          @endif
        </div>
    
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Domicilio</label>
          <input type="text" name="domiciliodocente" class="form-control" value="{{$id->domiciliodocente}}">
          @if ($errors->has('domiciliodocente'))
          <div id="domiciliodocente-error" class="error text-danger pl-3" for="domiciliodocente" style="display: block;">
          <strong>{{ $errors->first('domiciliodocente') }}</strong>
          </div>
          @endif
        </div>

        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label >Localidad</label>
          <input type="text" name="localidaddocente" class="form-control" value="{{$id->localidaddocente}}">
          @if ($errors->has('localidaddocente'))
          <div id="localidaddocente-error" class="error text-danger pl-3" for="localidaddocente" style="display: block;">
          <strong>{{ $errors->first('localidaddocente') }}</strong>
          </div>
          @endif
        </div>
         
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Provincia</label>
          <input type="text" name="provinciadocente" class="form-control" value="{{$id->provinciadocente}}">
          @if ($errors->has('provinciadocente'))
          <div id="provinciadocente-error" class="error text-danger pl-3" for="provinciadocente" style="display: block;">
          <strong>{{ $errors->first('provinciadocente') }}</strong>
          </div>
          @endif
        </div>

        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Teléfono celular</label>
          <input type="text" name="telefonodocente" class="form-control" value="{{$id->telefonodocente}}">
          <small id="eventoHelp" class="form-text text-muted" >Debe ingresar el número de teléfono sin el 0, sin el 15 y sin espacios.</small>
          @if ($errors->has('telefonodocente'))
          <div id="telefonodocente-error" class="error text-danger pl-3" for="telefonodocente" style="display: block;">
          <strong>El campo debe ser del tipo numérico y contener 10 caracteres.</strong>
          </div>
          @endif
        </div>

        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Correo electrónico</label>
          <input type="text" name="emaildocente" class="form-control" value="{{$id->emaildocente}}">
          @if ($errors->has('emaildocente'))
          <div id="emaildocente-error" class="error text-danger pl-3" for="emaildocente" style="display: block;">
          <strong>{{ $errors->first('emaildocente') }}</strong>
          </div>
          @endif
        </div>

        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label >Legajo</label>
          <input type="text" name="legajo" class="form-control" value="{{$id->legajo}}">
          @if ($errors->has('legajo'))
          <div id="legajo-error" class="error text-danger pl-3" for="legajo" style="display: block;">
          <strong>{{ $errors->first('legajo') }}</strong>
          </div>
          @endif
        </div>
    <br>
        <div class="row" style="margin-right: 3px; margin-left: 3px;">
          <label>Docente de grado</label>&nbsp&nbsp&nbsp&nbsp
          <br>
          <div>
            Si <input type="checkbox" id="grado" name="grado" value="Grado" onclick="especial.disabled =this.checked" <?php if($id->especialidad=='Grado') echo 'checked="checked" ';?>> &nbsp&nbsp&nbsp&nbsp
            No <input type="checkbox" id="especial" name="especial" value="Especial" onclick="activarCasilla(this),grado.disabled =this.checked"<?php if($id->especialidad!='Grado') echo 'checked="checked" ';?>>
            </div>
            <script type="text/javascript">
            function activarCasilla(check){
            if(especial.checked==true){
            document.getElementById("especialidad").style.display = "block";
            }else{
            document.getElementById("especialidad").style.display = "none";
            }
            }
          </script>
          <select name="especialidad" id="especialidad" class="form-control" value="{{ old('especialidad') }}" style="display:none";>
              <?php
          $espacioscurriculares=explode(',', $nombreespa);
          $contador=count($espacioscurriculares)-2;
          ?>
          <option>Seleccione la especialidad</option>
          <?php
          for ($i=0; $i <=$contador ; $i++) { 
          ?>
          <option value="{{$espacioscurriculares[$i]}}"><?php echo $espacioscurriculares[$i];?> </option>
          <?php } ?>
          @if ($errors->has('especialidad'))
          <div id="especialidad-error" class="error text-danger pl-3" for="especialidad" style="display: block;">
          <strong>{{ $errors->first('especialidad') }}</strong>
          </div>
          @endif
          </select>
          </div> 

          <?php 
          }
          else{?>
        <div class="row">
          <div class="col">
            <label>DNI</label>
            <input type="text" name="dnidocente" class="form-control" value="{{$id->dnidocente}}">
            @if ($errors->has('dnidocente'))
            <div id="dnidocente-error" class="error text-danger pl-3" for="dnidocente" style="display: block;">
            <strong>{{ $errors->first('dnidocente') }}</strong>
            </div>
            @endif
          </div>
            
          <div class="col">
            <label>Nombre</label>
            <input type="text" name="nombredocente" class="form-control" value="{{$id->nombredocente}}">
            @if ($errors->has('nombredocente'))
            <div id="nombredocente-error" class="error text-danger pl-3" for="nombredocente" style="display: block;">
            <strong>{{ $errors->first('nombredocente') }}</strong>
            </div>
            @endif
          </div>
         
          <div class="col">
            <label>Apellido</label>
            <input class="form-control" name="apellidodocente" value="{{$id->apellidodocente}}">
            @if ($errors->has('apellidodocente'))
            <div id="apellidodocente-error" class="error text-danger pl-3" for="apellidodocente" style="display: block;">
            <strong>{{ $errors->first('apellidodocente') }}</strong>
            </div>
            @endif
          </div>
        </div>
        <br>
          
      <div class="row">
        <div class="col">
          <label>Fecha de nacimiento</label>
          <input type="date" name="fechanacimientodoc" class="form-control" min="1951-01-01" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 18 years"));?>" value="{{$id->fechanacimientodoc}}">
          @if ($errors->has('fechanacimientodoc'))
          <div id="fechanacimientodoc-error" class="error text-danger pl-3" for="fechanacimientodoc" style="display: block;">
          <strong>{{ $errors->first('fechanacimientodoc') }}</strong>
          </div>
          @endif
        </div>

        <div class="col">
          <label>Género</label>
          <select name="generodocente" id="opciongenero" class="form-control" value="{{$id->generodocente}}">
          <option></option>
          <option value="Femenino" <?php if($id->generodocente=='Femenino') echo 'selected="selected" ';?>>Femenino
          <option value="Masculino" <?php if($id->generodocente=='Masculino') echo 'selected="selected" ';?>>Masculino
          </select>
          @if ($errors->has('generodocente'))
          <div id="generodocente-error" class="error text-danger pl-3" for="generodocente" style="display: block;">
          <strong>{{ $errors->first('generodocente') }}</strong>
          </div>
          @endif
        </div>
        
        <div class="col">
          <label>Estado civil</label>
          <select name="estadocivildoc" id="opcionestadocivil" class="form-control" value="{{$id->estadocivildoc}}">
          <option></option>
          <option value="Soltera/o" <?php if($id->estadocivildoc=='Soltera/o') echo 'selected="selected" ';?>>Soltera/o
          <option value="Casada/o" <?php if($id->estadocivildoc=='Casada/o') echo 'selected="selected" ';?>>Casada/o
          <option value="Divorciada/o" <?php if($id->estadocivildoc=='Divorciada/o') echo 'selected="selected" ';?>>Divorciada/o
          <option value="Viuda/o" <?php if($id->estadocivildoc=='Viuda/o') echo 'selected="selected" ';?>>Viuda/o
          <option value="En concubitato" <?php if($id->estadocivildoc=='En concubitato') echo 'selected="selected" ';?>>En concubitato
          </select>
          @if ($errors->has('estadocivildoc'))
          <div id="estadocivildoc-error" class="error text-danger pl-3" for="estadocivildoc" style="display: block;">
          <strong>{{ $errors->first('estadocivildoc') }}</strong>
          </div>
          @endif
        </div>
    
      </div>
      <br>

      <div class="row">
        
        <div class="col">
          <label>Domicilio</label>
          <input type="text" name="domiciliodocente" class="form-control" value="{{$id->domiciliodocente}}">
          @if ($errors->has('domiciliodocente'))
          <div id="domiciliodocente-error" class="error text-danger pl-3" for="domiciliodocente" style="display: block;">
          <strong>{{ $errors->first('domiciliodocente') }}</strong>
          </div>
          @endif
        </div>

        <div class="col">
          <label >Localidad</label>
          <input type="text" name="localidaddocente" class="form-control" value="{{$id->localidaddocente}}">
          @if ($errors->has('localidaddocente'))
          <div id="localidaddocente-error" class="error text-danger pl-3" for="localidaddocente" style="display: block;">
          <strong>{{ $errors->first('localidaddocente') }}</strong>
          </div>
          @endif
        </div>
         
        <div class="col">
          <label>Provincia</label>
          <input type="text" name="provinciadocente" class="form-control" value="{{$id->provinciadocente}}">
          @if ($errors->has('provinciadocente'))
          <div id="provinciadocente-error" class="error text-danger pl-3" for="provinciadocente" style="display: block;">
          <strong>{{ $errors->first('provinciadocente') }}</strong>
          </div>
          @endif
        </div>

      </div> 
      <br>

      <div class="row">
        <div class="col"> 
          <label>Teléfono celular</label>
          <input type="text" name="telefonodocente" class="form-control" value="{{$id->telefonodocente}}">
          <small id="eventoHelp" class="form-text text-muted" >Debe ingresar el número de teléfono sin el 0, sin el 15 y sin espacios.</small>
          @if ($errors->has('telefonodocente'))
          <div id="telefonodocente-error" class="error text-danger pl-3" for="telefonodocente" style="display: block;">
          <strong>El campo debe ser del tipo numérico y contener 10 caracteres.</strong>
          </div>
          @endif
        </div>

        <div class="col">
          <label>Correo electrónico</label>
          <input type="text" name="emaildocente" class="form-control" value="{{$id->emaildocente}}">
          @if ($errors->has('emaildocente'))
          <div id="emaildocente-error" class="error text-danger pl-3" for="emaildocente" style="display: block;">
          <strong>{{ $errors->first('emaildocente') }}</strong>
          </div>
          @endif
        </div>

        <div class="col">
          <label >Legajo</label>
          <input type="text" name="legajo" class="form-control" value="{{$id->legajo}}">
          @if ($errors->has('legajo'))
          <div id="legajo-error" class="error text-danger pl-3" for="legajo" style="display: block;">
          <strong>{{ $errors->first('legajo') }}</strong>
          </div>
          @endif
       
          </div>
      </div>
      <br>
    
      <div class="row">
        <div class="col">
          <label>Docente de grado</label>
            Si <input type="checkbox" id="grado" name="grado" value="Grado" onclick="especial.disabled =this.checked" <?php if($id->especialidad=='Grado') echo 'checked="checked" ';?>> 
            No <input type="checkbox" id="especial" name="especial" value="Especial" onclick="activarCasilla(this),grado.disabled =this.checked"<?php if($id->especialidad!='Grado') echo 'checked="checked" ';?>>
            <script type="text/javascript">
            function activarCasilla(check){
            if(especial.checked==true){
            document.getElementById("especialidad").style.display = "block";
            }else{
            document.getElementById("especialidad").style.display = "none";
            }
            }
          </script>
          <select name="especialidad" id="especialidad" class="form-control" value="{{ old('especialidad') }}" style="display:none";>
              <?php
          $espacioscurriculares=explode(',', $nombreespa);
          $contador=count($espacioscurriculares)-2;
          ?>
          <option>Seleccione la especialidad</option>
          <?php
          for ($i=0; $i <=$contador ; $i++) { 
          ?>
          <option value="{{$espacioscurriculares[$i]}}"><?php echo $espacioscurriculares[$i];?> </option>
          <?php } ?>
          @if ($errors->has('especialidad'))
          <div id="especialidad-error" class="error text-danger pl-3" for="especialidad" style="display: block;">
          <strong>{{ $errors->first('especialidad') }}</strong>
          </div>
          @endif
          </select>
          </div>
      </div>
        
      </div>
      <?php 
      }
      ?>
      <br>

      <div class="text-right">
        <h4><span class="badge badge-danger">*Recuerde que todos los campos son obligatorios.</span></h4>
      </div>

      <div class="card-footer">
        <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
        <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
        </div>
      </div>
      
        </form>
      </div>
    </div>
  </div>
</div>
@endsection