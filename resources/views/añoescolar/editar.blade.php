@extends('layouts.main', ['activePage' => 'editarañoescolar', 'titlePage' => __('')])
  
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{route('actualizaraño',$id->id)}}" method="POST" class="form-horizontal">
        @csrf
        @METHOD('PUT')
        <div class="card">
          <div class= "card-header card-header-info">
          <h4 class="card-title">Editar año escolar</h4>
          </div>
        <div class="card-body">
          <div class="col form-group">
            <label>Año escolar</label>
              <select name="descripcion" class="form-control" value="{{$id->descripcion}}">
                <option value="{{$id->descripcion}}" <?php echo 'selected="selected" ';?>>{{$id->descripcion}}</option>
                      <?php 
                      use Carbon\Carbon;
                      $añoactual=date("Y");
                      $hasta=$añoactual+2;
                      for($i=$añoactual;$i<=$hasta;$i++) { 
                        if($i!=$id->descripcion){echo "<option value='".$i."'>".$i."</option>"; }} ?>
                </select>
            @if ($errors->has('descripcion'))
                <div id="descripcion-error" class="error text-danger pl-3" for="descripcion" style="display: block;">
                  <strong>{{ $errors->first('descripcion') }}</strong>
                </div>
              @endif
          </div>
          <div class="col form-group">
          <label>Fecha inicio</label>
            <input type="date" name="fechainicio" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 1 month"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 1 years"));?>" value="{{$id->fechainicio}}">
            @if ($errors->has('fechainicio'))
                <div id="fechainicio-error" class="error text-danger pl-3" for="fechainicio" style="display: block;">
                  <strong>{{ $errors->first('fechainicio') }}</strong>
                </div>
              @endif
          </div>
          <div class="col form-group">
          <label>Fecha fin</label>
            <input type="date" name="fechafin" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 1 month"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->fechafin}}">
            @if ($errors->has('fechafin'))
                <div id="fechafin-error" class="error text-danger pl-3" for="fechafin" style="display: block;">
                  <strong>{{ $errors->first('fechafin') }}</strong>
                </div>
              @endif
          </div>
          @if($periodocolegio=='Bimestre')
          &nbsp &nbsp <label>Fechas {{$periodocolegio}}</label><br>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo1}}">
            @if ($errors->has('inicioperiodo1'))
                <div id="inicioperiodo1-error" class="error text-danger pl-3" for="inicioperiodo1" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo1') }}</strong>
                </div>
              @endif
            </div>
            <br>
            <div class="col">
            &nbsp <label>Fecha finalización</label>
            <input type="date" name="finperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo1}}">
            @if ($errors->has('finperiodo'))
                <div id="fechafin-error" class="error text-danger pl-3" for="fechafin" style="display: block;">
                  <strong>{{ $errors->first('fechafin') }}</strong>
                </div>
              @endif
          </div>
        </div>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo2}}">
            @if ($errors->has('inicioperiodo2'))
                <div id="inicioperiodo2-error" class="error text-danger pl-3" for="inicioperiodo2" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo2') }}</strong>
                </div>
              @endif
            </div>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo2}}">
            @if ($errors->has('finperiodo2'))
                <div id="finperiodo2-error" class="error text-danger pl-3" for="finperiodo2" style="display: block;">
                  <strong>{{ $errors->first('finperiodo2') }}</strong>
                </div>
              @endif
          </div>
        </div>
        <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo3" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo3}}">
            @if ($errors->has('inicioperiodo3'))
                <div id="inicioperiodo3-error" class="error text-danger pl-3" for="inicioperiodo3" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo3') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo3" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo3}}">
            @if ($errors->has('finperiodo3'))
                <div id="finperiodo3-error" class="error text-danger pl-3" for="finperiodo3" style="display: block;">
                  <strong>{{ $errors->first('finperiodo3') }}</strong>
                </div>
              @endif
          </div>
        </div>
        <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo4" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo4}}">
            @if ($errors->has('inicioperiodo4'))
                <div id="inicioperiodo4-error" class="error text-danger pl-3" for="inicioperiodo4" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo4') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo4" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo4}}">
            @if ($errors->has('finperiodo4'))
                <div id="finperiodo4-error" class="error text-danger pl-3" for="finperiodo4" style="display: block;">
                  <strong>{{ $errors->first('finperiodo4') }}</strong>
                </div>
              @endif
          </div>
        </div>
          @endif
          @if($periodocolegio=='Trimestre')
          &nbsp &nbsp <label>Fechas {{$periodocolegio}}</label><br>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo1}}">
            @if ($errors->has('inicioperiodo1'))
                <div id="inicioperiodo1-error" class="error text-danger pl-3" for="inicioperiodo1" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo1') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo1}}">
            @if ($errors->has('finperiodo'))
                <div id="fechafin-error" class="error text-danger pl-3" for="fechafin" style="display: block;">
                  <strong>{{ $errors->first('fechafin') }}</strong>
                </div>
              @endif
          </div>
        </div>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo2}}">
            @if ($errors->has('inicioperiodo2'))
                <div id="inicioperiodo2-error" class="error text-danger pl-3" for="inicioperiodo2" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo2') }}</strong>
                </div>
              @endif
            </div>
            &nbsp <div class="col">
              <label>Fecha finalización</label>
            <input type="date" name="finperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo2}}">
            @if ($errors->has('finperiodo2'))
                <div id="finperiodo2-error" class="error text-danger pl-3" for="finperiodo2" style="display: block;">
                  <strong>{{ $errors->first('finperiodo2') }}</strong>
                </div>
              @endif
          </div>
        </div>
        <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo3" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo3}}">
            @if ($errors->has('inicioperiodo3'))
                <div id="inicioperiodo3-error" class="error text-danger pl-3" for="inicioperiodo3" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo3') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo3" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo3}}">
            @if ($errors->has('finperiodo3'))
                <div id="finperiodo3-error" class="error text-danger pl-3" for="finperiodo3" style="display: block;">
                  <strong>{{ $errors->first('finperiodo3') }}</strong>
                </div>
              @endif
          </div>
        </div>
          @endif
          @if($periodocolegio=='Cuatrimestre')
          &nbsp &nbsp <label>Fechas {{$periodocolegio}}</label><br>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo1}}">
            @if ($errors->has('inicioperiodo1'))
                <div id="inicioperiodo1-error" class="error text-danger pl-3" for="inicioperiodo1" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo1') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo1}}">
            @if ($errors->has('finperiodo'))
                <div id="fechafin-error" class="error text-danger pl-3" for="fechafin" style="display: block;">
                  <strong>{{ $errors->first('fechafin') }}</strong>
                </div>
              @endif
          </div>
        </div>
          <div class="row form-group">
            &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo2}}">
            @if ($errors->has('inicioperiodo2'))
                <div id="inicioperiodo2-error" class="error text-danger pl-3" for="inicioperiodo2" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo2') }}</strong>
                </div>
              @endif
            </div>
            &nbsp <div class="col">
              <label>Fecha finalización</label>
            <input type="date" name="finperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo2}}">
            @if ($errors->has('finperiodo2'))
                <div id="finperiodo2-error" class="error text-danger pl-3" for="finperiodo2" style="display: block;">
                  <strong>{{ $errors->first('finperiodo2') }}</strong>
                </div>
              @endif
          </div>
        </div>
          @endif
          @if($periodocolegio=='Semestre')
          &nbsp &nbsp <label>Fechas {{$periodocolegio}}</label><br>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo1}}">
            @if ($errors->has('inicioperiodo1'))
                <div id="inicioperiodo1-error" class="error text-danger pl-3" for="inicioperiodo1" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo1') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo1}}">
            @if ($errors->has('finperiodo'))
                <div id="fechafin-error" class="error text-danger pl-3" for="fechafin" style="display: block;">
                  <strong>{{ $errors->first('fechafin') }}</strong>
                </div>
              @endif
          </div>
        </div>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->inicioperiodo2}}">
            @if ($errors->has('inicioperiodo2'))
                <div id="inicioperiodo2-error" class="error text-danger pl-3" for="inicioperiodo2" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo2') }}</strong>
                </div>
              @endif
            </div>
            &nbsp <div class="col">
              <label>Fecha finalización</label>
            <input type="date" name="finperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 2 years"));?>" value="{{$id->finperiodo2}}">
            @if ($errors->has('finperiodo2'))
                <div id="finperiodo2-error" class="error text-danger pl-3" for="finperiodo2" style="display: block;">
                  <strong>{{ $errors->first('finperiodo2') }}</strong>
                </div>
              @endif
          </div>
        </div>
          @endif          
          <div class="text-right">
            <h4><span class="badge badge-danger">*Recuerde que todos los campos son obligatorios.</span></h4>
          </div>
          </div>
          <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
                <button type="submit" class="btn btn-sm btn-facebook">Guardar cambios</button>
          </div>
        </div>
      </div>
      </form>
        </div>
        
      </div>
    </div>
  </div>
@endsection