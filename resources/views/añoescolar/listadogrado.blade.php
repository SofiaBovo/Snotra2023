@extends('layouts.main', ['activePage' => 'armadogrado', 'titlePage' => __('Año escolar')])
<?php
$detect = new Mobile_Detect;
?>

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        	<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title ">Armado de grados</h4>
              </div>
              @if($colegio->isEmpty())
                <br>
               <div class="col-md-12 text-center">

              <h4><span class="badge badge-warning">Para poder armar los diferentes grados, antes deberá cargar la información del colegio.</span></h4>
              </div>
              <br>
              @else
              @if($todoestado->isEmpty())
              <br>
               <div class="col-md-12 text-center">
                <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
              <h4><span class="badge badge-warning">Para poder armar los diferentes grados,<br> antes deberá crear el año escolar.</span></h4>
                <?php 
                  }
                  else{?>
                    <h4><span class="badge badge-warning">Para poder armar los diferentes grados, <br> antes deberá crear el año escolar.</span></h4>
              </div>
              <?php 
                  }
                  ?>
              <br>
              @else
              <div class="card-body">
                @if($estado->isEmpty())
                <div class="col">
                <h4> <span class="badge badge-info">No hay ningún año escolar activo.</span></h4>
                </div>
                @else
                <div class="col">
                <h4> <span class="badge badge-info">El año escolar que se encuentra activo es el {{$descripcionaño}}.</span></h4>
                </div>
                @endif
                <div class="row">
                  <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
                       <div class="col-12" style="text-align:right;">
                    <a href="{{route('armadogrado.create') }}" class="btn btn-sm btn-facebook">Crear grado</a>
                  </div>
                  <?php 
                  }
                  else{?>
                   <div class="col-12 text-right">
                    <a href="{{route('armadogrado.create') }}" class="btn btn-sm btn-facebook">Crear grado</a>
                  </div>  
                  <?php 
                  }
                  ?>
                  <div class="col form-group">
              <form id="form1" action="{{route('buscar')}}" method="post">
                @csrf
              <select name="buscaraño" id="buscaraño" class="form-control">
                <option>{{$descripcionselect}}</option>
                @foreach($todoestado as $todoest)
                <option value="{{$todoest->descripcion}}">{{$todoest->descripcion}}</option>
                @endforeach
              </select>
              @if ($errors->has('año'))
                <div id="año-error" class="error text-danger pl-3" for="año" style="display: block;">
                  <strong>{{ $errors->first('año') }}</strong>
                </div>
              @endif
              <input type="submit" class="btn btn-sm btn-facebook" value="Buscar">
            </form>
            <br>
          @if($grado->isEmpty())
          <div class="text-center"> No hay grados asociados a ese año escolar.</div>
          @else
          @if(session('success'))
                    <div class="alert alert-success" role="success">
                    {{session('success')}}
                    </div>
                    <script type="text/javascript">
                    window.setTimeout(function() {
                    $(".alert-success").fadeTo(400, 0).slideUp(400, function(){
                    $(this).remove(); 
                    });
                    }, 1500);
                    </script>
                    @endif
                  <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>Grado</th>
                      <th>Docente</th>
                      <th>Alumnos</th>
                      <th>Docentes <br> especiales</th>
                      <th>Acciones</th>
                    </thead>
                    @foreach($grado as $grados)
                    <tr>
                      <?php 
                      $nombredoc=App\Models\Docente::all()->where('id',$grados->id_docentes);
                      ?>
                      <td class="v-align-middle">{{$grados->descripcion}}</td>
                      @foreach($nombredoc as $nombres)
                      <td class="v-align-middle">{{$nombres->nombredocente}} {{$nombres->apellidodocente}}</td>
                      @endforeach
                      <td class="td-actions v-align-middle">
                        <button class="btn btn-info" data-target="#ModalAlumnos{{$grados->id}}"data-toggle="modal" title="Ver alumnos">
                        <i class="bi bi-person"></i>
                        </button>
                        <div class="modal fade bd-example-modal-lg" id="ModalAlumnos{{$grados->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><strong>Alumnos de {{$grados->descripcion}}</strong></h5>

                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                            <label><strong>Listado de Alumnos:</strong></label> 
                            <table class="table">
                              <tr>
                                <td class="v-align-middle">
                                <?php
                                $res = preg_replace('/[\[\]\.\;\" "]+/', '', $grados->id_alumnos);
                                $listadoalumnos=explode(',', $res);
                                ?>
                                <?php 
                                $cantidad=count($listadoalumnos)-1;
                                for($i=0; $i<=$cantidad; $i++){
                                  $nombrealumno=App\Models\Alumno::where('id',$listadoalumnos[$i])->pluck("nombrealumno");
                                  $nombrealumno = preg_replace('/[\[\]\.\;\" "]+/', '', $nombrealumno);
                                  $apellidoalumno=App\Models\Alumno::where('id',$listadoalumnos[$i])->pluck("apellidoalumno");
                                  $apellidoalumno = preg_replace('/[\[\]\.\;\" "]+/', '', $apellidoalumno);
                                  ?>
                                  <p>{{$nombrealumno}} {{$apellidoalumno}}
                                  <?php 
                                foreach($pasegrado as $pase){
                                  if($listadoalumnos[$i]==$pase->id_alumno and $pase->estado=='No pasa'){
                                  ?>
                                  &nbsp<span class="badge badge-danger">Repitente</span>
                                  </p>
                                <?php
                                  }
                                }

                              }
                              
                            
                                ?>
                                 
                                </td>
                              </tr>
                           </table>
                          
                                
                                
                  
                          </div>
                       </div>
                     </div>
                   </div>
                 </td>
                      <td class="td-actions v-align-middle">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#myModal{{$grados->id}}" title="Docentes especiales">
                        <i class="bi bi-plus-circle"></i>
                      </button>
                      <div class="modal fade bd-example-modal-lg" id="myModal{{$grados->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><strong></strong>Docentes especiales de {{$grados->descripcion}}</h5>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                            <label><strong>Seleccionar docentes especiales</strong></label>
                            @foreach($docentesespe as $espe)
                            <form action="{{route('armado.especiales',$grados->id)}}" method="POST" class="form-horizontal">
                            @csrf
                            <table class="table">
                              <tr>
                                <td class="v-align-middle">
                                  <input type="checkbox" id="check" name="id_docentesespe[]" value="{{$espe->id}}"
                                  <?php
                                     $docentesespecia=$grados->id_docentesespe;
                                     $docentesespecia = preg_replace('/[\[\]\.\;\" "]+/', '', $docentesespecia);
                                     $docentesespecia=explode(',',$docentesespecia);
                                     $longitud= count($docentesespecia)-1;
                                  for($i=0;$i<=$longitud;$i++){
                                    if($espe->id==$docentesespecia[$i]) echo 'checked="" ';
                                  }
                                  ?>
                                  >
                                  &nbsp
                                 <strong>Docente de {{$espe->especialidad}}:</strong> &nbsp{{$espe->nombredocente}} {{$espe->apellidodocente}}. 
                                 
                                </td>
                              </tr>
                           </table>
                           @endforeach
                            <div class="card-footer">
                            <div class="  col-xs-12 col-sm-12 col-md-12 text-right ">
                            <button type="submit" class="btn btn-sm btn-facebook">Guardar</button>
                            </div>
                            </div>
                            </form>
                          </div>
                       </div>
                     </div>
                   </div>
                  
                    </td>
                    <td class="td-actions v-align-middle">
                    <a href="{{route('editargrado',$grados->id) }}" class="btn btn-warning" title="Modificar grado">
                    <i class="bi bi-pencil"></i>
                    </td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                @endif
                </div> 
          </div>
          @endif
          @endif
              
              </div>

                </div> 
                </div> 
              </div>
        </div>
    </div>
</div>
@endsection
