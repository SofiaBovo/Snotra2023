@extends('layouts.main' , ['activePage' => 'libretas', 'titlePage => Impresión de libretas'])

@section ('content')
 <div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title ">Informes de progreso escolar</h4>
              </div>
             @if(sizeof($infogrado)==0)
              <br>
          <div class="col-md-12 text-center">
            <div class="text-left">
                  <h5><span class="badge badge-success">El año escolar activo es el {{$descripcionaño}}.</span></h5>
                  </div>
          <h4><span class="badge badge-warning">Aún no hay informes creados para el grado y etapa seleccionada. </span></h4>
          <u><strong><a class="text-primary" href="{{route('libretas')}}">Volver al buscador.</a></strong></u>
          </div>

          <br>
          @else
              <div class="card-body">
                @foreach($infoaño as $año)
                  <div class="text-left">
                  <h5><span class="badge badge-success">El año escolar activo es el {{$año->descripcion}}.</span></h5>
                  </div>
                @endforeach
                <form action="{{route('listadoalumnos')}}" class="form-horizontal">
                <div class="row">
                <div class="col">
                <label>Grado</label>
                <select name="grado" id="grado" class="form-control" value="">
                <option value="{{$grado}}">{{$grado}}</option>
                <?php
                $cont=count($nombresgrado)-1;
                for($i=0;$i<=$cont;$i++){?>
                <option value="{{$nombresgrado[$i]}}">{{$nombresgrado[$i]}}</option>
                <?php
                }
                ?>
                </select>
                @if ($errors->has('grado'))
                <div id="grado-error" class="error text-danger pl-3" for="grado" style="display: block;">
                  <strong>{{ $errors->first('grado') }}</strong>
                </div>
                @endif
                </div>
                <div class="col">
                <label>Etapa</label>
                <select name="periodo" id="periodo" class="form-control" value="{{old('periodo') }}">
                <option value="{{$periodo}}">{{$periodo}}</option>
                @if($informacionperiodo=='Bimestre')
                <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                <option value="Tercera Etapa">Tercera Etapa</option>
                <option value="Cuarta Etapa">Cuarta Etapa</option>
                @endif
                @if($informacionperiodo=='Trimestre')
                 <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                <option value="Tercera Etapa">Tercera Etapa</option>
                @endif
                @if($informacionperiodo=='Cuatrimestre')
                 <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                @endif
                @if($informacionperiodo=='Semestre')
               <option value="Primera Etapa">Primera Etapa</option>
                <option value="Segunda Etapa">Segunda Etapa</option>
                @endif
                </select>
                @if ($errors->has('periodo'))
                <div id="periodo-error" class="error text-danger pl-3" for="periodo" style="display: block;">
                  <strong>{{ $errors->first('periodo') }}</strong>
                </div>
                @endif
                </div>
                </div>
                <br>
                <div class="text-right">
                  <button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                </div>
                </form>
                 @if(session('success'))
                    <div class="alert alert-success" role="success">
                    {{session('success')}}
                    </div>
                    <script type="text/javascript">
                    window.setTimeout(function() {
                    $(".alert-success").fadeTo(400, 0).slideUp(400, function(){
                    $(this).remove(); 
                    });
                    }, 2500);
                    </script>
                    @endif
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                    <th>Alumnos</th>
                    <th>Acciones</th>
                    </thead>                    
                    <tbody>
                    <?php 
                    $contador=count($nombrealumno)-1;
                    for ($i=0; $i<=$contador ; $i++) { ?>
                      <tr>
                      <td class="v-align-middle">{{$nombrealumno[$i]}} {{$apellidoalumno[$i]}}</td>
                    <?php 
                    $nombrecompleto=$nombrealumno[$i].' '.$apellidoalumno[$i];
                    $idcolegio=App\Models\Alumno::where('id',$idalumno[$i])->pluck("colegio_id");
                    $gradoalumno=App\Models\Alumno::where('id',$idalumno[$i])->pluck("grado");
                    $gradoalumno = preg_replace('/[\[\]\\;\""]+/', '', $gradoalumno);
                    $idcolegio = preg_replace('/[\[\]\\;\" "]+/', '', $idcolegio);
                    $nombrecolegio = App\Models\Colegio::where('id',$idcolegio)->pluck("nombre");
                    $nombrecolegio = preg_replace('/[\[\]\\;\""]+/', '', $nombrecolegio);
                    $direccioncolegio = App\Models\Colegio::where('id',$idcolegio)->pluck("direccion");
                    $direccioncolegio = preg_replace('/[\[\]\\;\""]+/', '', $direccioncolegio);
                    $localidadcolegio = App\Models\Colegio::where('id',$idcolegio)->pluck("localidad");
                    $localidadcolegio = preg_replace('/[\[\]\\;\""]+/', '', $localidadcolegio);
                    $provinciacolegio = App\Models\Colegio::where('id',$idcolegio)->pluck("provincia");
                    $provinciacolegio = preg_replace('/[\[\]\\;\""]+/', '', $provinciacolegio);
                    $telefonocolegio = App\Models\Colegio::where('id',$idcolegio)->pluck("telefono");
                    $telefonocolegio = preg_replace('/[\[\]\\;\""]+/', '', $telefonocolegio);
                    $emailcolegio = App\Models\Colegio::where('id',$idcolegio)->pluck("email");
                    $emailcolegio = preg_replace('/[\[\]\\;\""]+/', '', $emailcolegio);
                    $infoaño=App\Models\Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
                    foreach($infoaño as $activo){
                    $descripcionaño="$activo->descripcion";
                    }
                    ?>
                      <td class="td-actions v-align-middle">
                        <div>
                        <div style="display: inline-block;">
                        <form>
                        <button formaction= "{{route('generarlibreta',$nombrecompleto)}}" class="btn btn-success" title="Descargar informe">
                        <i class="bi bi-download"></i>
                        </button>
                          <div style="display: none;">
                          <input type="text" value="{{$periodo}}" name="periodo">
                          <input type="text" value="{{$idalumno[$i]}}" name="idalumno">
                          <input type="text" value="{{$nombrecompleto}}" name="nombrecompleto">
                          <input type="text" value="{{$gradoalumno}}" name="gradoalumno">
                          <input type="text" value="{{$nombrecolegio}}" name="nombrecolegio">
                          <input type="text" value="{{$direccioncolegio}}" name="direccioncolegio">
                          <input type="text" value="{{$localidadcolegio}}" name="localidadcolegio">
                          <input type="text" value="{{$provinciacolegio}}" name="provinciacolegio">
                          <input type="text" value="{{$telefonocolegio}}" name="telefonocolegio">
                          <input type="text" value="{{$emailcolegio}}" name="emailcolegio">
                          <input type="text" value="{{$descripcionaño}}" name="descripcionaño">
                          </div>
                          </form>
                        </div>
                        <div style="display: inline-block;">
                        <button class="btn btn-info" title="Compartir informe" data-toggle="modal" data-target="#Compartirinforme{{$nombrecompleto}}">
                        <i class="bi bi-share"></i>
                        </button>
                          <div class="modal fade" id="Compartirinforme{{$nombrecompleto}}" role="dialog">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="Compartirinforme"><strong>  Informe escolar del alumno {{$nombrecompleto}}</strong></h5>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                          <p class="text-center">¿Está seguro que desea compartir por email el informe del alumno <strong>{{$nombrecompleto}}</strong>?</p>
                          </div>
                          <div class="modal-footer justify-content-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          <form>
                          <div style="display: none;">
                          <input type="text" value="{{$periodo}}" name="periodo">
                          <input type="text" value="{{$idalumno[$i]}}" name="idalumno">
                          <input type="text" value="{{$nombrecompleto}}" name="nombrecompleto">
                          <input type="text" value="{{$gradoalumno}}" name="gradoalumno">
                          <input type="text" value="{{$nombrecolegio}}" name="nombrecolegio">
                          <input type="text" value="{{$direccioncolegio}}" name="direccioncolegio">
                          <input type="text" value="{{$localidadcolegio}}" name="localidadcolegio">
                          <input type="text" value="{{$provinciacolegio}}" name="provinciacolegio">
                          <input type="text" value="{{$telefonocolegio}}" name="telefonocolegio">
                          <input type="text" value="{{$emailcolegio}}" name="emailcolegio">
                          <input type="text" value="{{$descripcionaño}}" name="descripcionaño">
                          </div>
                          <button formaction="{{route('compartirinforme',$nombrecompleto)}}" class="btn btn-success" type="submit" rel="tooltip">Aceptar</button>
                          </form>
                          </div>
                          </div>
                          </div>
                          </div>
                          </div>     
                      </td>
                    </tr>
                    <?php 
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="text-center">
                <form action="{{route('generartodosinformes')}}">
                  <div style="display: none;">
                  <input type="text" value="{{$periodo}}" name="periodo">
                  <input type="text" value="{{$grado}}" name="grado">
                  </div>
                  <button class="btn btn-sm btn-facebook" title="Descargar todos los informes">Descargar todos los informes
                  </button>
                  </form>
               </div>
           
            </div>
            @endif
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
</div>
@endsection

