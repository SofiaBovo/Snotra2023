@extends('layouts.main', ['activePage' => 'añoescolar', 'titlePage' => __('')])

<script type="text/javascript">
        // funcion que se ejecuta cada vez que se selecciona una empresa
        function funcionfechainicio()
        {
            document.getElementById('completarconfechainicio').value=document.getElementById('autocompletar').value;
        }
        function funcionfechafin()
        {
            document.getElementById('completarconfechafin').value=document.getElementById('autocompletar2').value;
        }
    </script>
  
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-md-12"> 
        <form action="{{ route('añoescolar.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card">
          <div class= "card-header card-header-info">
          <h4 class="card-title">Creación de año escolar</h4>
          </div>
        <div class="card-body">
           <br>
          <div class="col form-group">
            <label>Año escolar</label>
              <select name="descripcion" class="form-control" value="{{ old('descripcion') }}">
                <option value="{{ old('descripcion') }}">Seleccione el año</option>
                      <?php 
                      use Carbon\Carbon;
                      $añoactual=date("Y");
                      $hasta=$añoactual+2;
                      for($i=$añoactual;$i<=$hasta;$i++) { echo "<option value='".$i."'>".$i."</option>"; } ?>
                </select>
            @if ($errors->has('descripcion'))
                <div id="descripcion-error" class="error text-danger pl-3" for="descripcion" style="display: block;">
                  <strong>{{ $errors->first('descripcion') }}</strong>
                </div>
              @endif
          </div>
          <div class="col form-group">
          <label>Fecha inicio</label>
            <input type="date" name="fechainicio" id="autocompletar" onchange='funcionfechainicio();' class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('fechainicio') }}">
            @if ($errors->has('fechainicio'))
                <div id="fechainicio-error" class="error text-danger pl-3" for="fechainicio" style="display: block;">
                  <strong>{{ $errors->first('fechainicio') }}</strong>
                </div>
              @endif
          </div>
          <div class="col form-group">
          <label>Fecha fin</label>
            <input type="date" name="fechafin" class="form-control" id="autocompletar2" onchange='funcionfechafin();' min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 1 month"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('fechafin') }}">
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
            <input type="date" name="inicioperiodo1" id="completarconfechainicio" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo1') }}">
            @if ($errors->has('inicioperiodo1'))
                <div id="inicioperiodo1-error" class="error text-danger pl-3" for="inicioperiodo1" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo1') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo1') }}">
            @if ($errors->has('finperiodo1'))
                <div id="finperiodo1-error" class="error text-danger pl-3" for="finperiodo1" style="display: block;">
                  <strong>{{ $errors->first('finperiodo1') }}</strong>
                </div>
              @endif
          </div>
        </div>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo2') }}">
            @if ($errors->has('inicioperiodo2'))
                <div id="inicioperiodo2-error" class="error text-danger pl-3" for="inicioperiodo2" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo2') }}</strong>
                </div>
              @endif
            </div>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo2') }}">
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
            <input type="date" name="inicioperiodo3" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo3') }}">
            @if ($errors->has('inicioperiodo3'))
                <div id="inicioperiodo3-error" class="error text-danger pl-3" for="inicioperiodo3" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo3') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo3" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo3') }}">
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
            <input type="date" name="inicioperiodo4" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo1') }}">
            @if ($errors->has('inicioperiodo4'))
                <div id="inicioperiodo4-error" class="error text-danger pl-3" for="inicioperiodo4" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo4') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo4" id="completarconfechafin" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo4') }}">
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
            <input type="date" name="inicioperiodo1" id="completarconfechainicio" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo1') }}">
            @if ($errors->has('inicioperiodo1'))
                <div id="inicioperiodo1-error" class="error text-danger pl-3" for="inicioperiodo1" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo1') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo') }}">
            @if ($errors->has('finperiodo1'))
                <div id="finperiodo1-error" class="error text-danger pl-3" for="finperiodo1" style="display: block;">
                  <strong>{{ $errors->first('finperiodo1') }}</strong>
                </div>
              @endif
          </div>
        </div>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo2') }}">
            @if ($errors->has('inicioperiodo2'))
                <div id="inicioperiodo2-error" class="error text-danger pl-3" for="inicioperiodo2" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo2') }}</strong>
                </div>
              @endif
            </div>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo2') }}">
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
            <input type="date" name="inicioperiodo3" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo3') }}">
            @if ($errors->has('inicioperiodo3'))
                <div id="inicioperiodo3-error" class="error text-danger pl-3" for="inicioperiodo3" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo3') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo3" id="completarconfechafin" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo3') }}">
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
            <input type="date" name="inicioperiodo1" id="completarconfechainicio" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo1') }}">
            @if ($errors->has('inicioperiodo1'))
                <div id="inicioperiodo1-error" class="error text-danger pl-3" for="inicioperiodo1" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo1') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo1') }}">
            @if ($errors->has('finperiodo1'))
                <div id="finperiodo1-error" class="error text-danger pl-3" for="finperiodo1" style="display: block;">
                  <strong>{{ $errors->first('finperiodo1') }}</strong>
                </div>
              @endif
          </div>
        </div>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo2') }}">
            @if ($errors->has('inicioperiodo2'))
                <div id="inicioperiodo2-error" class="error text-danger pl-3" for="inicioperiodo2" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo2') }}</strong>
                </div>
              @endif
            </div>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo2" id="completarconfechafin" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo2') }}">
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
            <input type="date" name="inicioperiodo1" id="completarconfechainicio" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo1') }}">
            @if ($errors->has('inicioperiodo1'))
                <div id="inicioperiodo1-error" class="error text-danger pl-3" for="inicioperiodo1" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo1') }}</strong>
                </div>
              @endif
            </div>
            <br>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo1" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo1') }}">
            @if ($errors->has('finperiodo1'))
                <div id="finperiodo1-error" class="error text-danger pl-3" for="finperiodo1" style="display: block;">
                  <strong>{{ $errors->first('finperiodo1') }}</strong>
                </div>
              @endif
          </div>
        </div>
          <div class="row form-group">
            &nbsp &nbsp <div class="col">
            <label>Fecha inicio</label>
            <input type="date" name="inicioperiodo2" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('inicioperiodo2') }}">
            @if ($errors->has('inicioperiodo2'))
                <div id="inicioperiodo2-error" class="error text-danger pl-3" for="inicioperiodo2" style="display: block;">
                  <strong>{{ $errors->first('inicioperiodo2') }}</strong>
                </div>
              @endif
            </div>
            &nbsp <div class="col">
            <label>Fecha finalización</label>
            <input type="date" name="finperiodo2" id="completarconfechafin" class="form-control" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 0 days"));?>" max = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 3 years"));?>" value="{{ old('finperiodo2') }}">
            @if ($errors->has('finperiodo2'))
                <div id="finperiodo2-error" class="error text-danger pl-3" for="finperiodo2" style="display: block;">
                  <strong>{{ $errors->first('finperiodo2') }}</strong>
                </div>
              @endif
          </div>
        </div>
          @endif
        </div>
     
      <div class="card-footer">
          <div class="  col-xs-12 col-sm-12 col-md-12 text-center ">
                <button type="submit" class="btn btn-sm btn-facebook">Guardar</button>
                <button type="reset" class="btn btn-sm btn-facebook">Limpiar</button>
          </div>
        </div>
         </div>
    </form>
  </div>
</div>
</div>
          
          
          </div>
          
      </div>
      </div>
        
      </div>
    </div>
  </div>
@endsection