@extends('layouts.main' , ['activePage' => 'pasedegrado', 'titlePage => Pase de grado'])
@section ('content')
 <div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title ">Listado de alumnos</h4>  
              </div>
              <div class="card-body">
                <div class="text-left">
                <h5><span class="badge badge-success">El año escolar activo es el {{$años}}.</span></h5>
                </div>
                <form action="{{route('listadopase') }}" class="form-horizontal">
                <div class="row">
                <div class="col">
                <label>Grado</label>
                <select name="grado" id="grado" class="form-control" value="{{$infgrado}}">
                <option value="{{$infgrado}}">{{$infgrado}}</option>
                <?php
                $cont=count($informaciongrado)-1;
                for($i=0;$i<=$cont;$i++){?>
                <option value="{{$informaciongrado[$i]}}">{{$informaciongrado[$i]}}</option>
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
                    }, 1000);
                    </script>
                    @endif
                    @if($notasfinales->isEmpty())
                  <div class="col-md-12 text-center">
                  <h4><span class="badge badge-warning">No hay alumnos para el grado seleccionado. </span></h4>
                  </div>    
                  @else
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>Estado</th>
                      <th>Alumnos</th>
                      <th>Acciones</th>
                    </thead>    
                    @foreach($notasunica as $alumno)  
                    <tbody>
                    <tr>
                    <td class="v-align-middle">
                    @foreach($pasegrado as $pase)
                    @if($alumno->id_alumno==$pase->id_alumno)
                    @if($pase->estado=='No pasa')
                    <h4><span class="badge badge-danger"><i class="bi bi-x-square"></i></span></h4>
                    @endif
                     @if($pase->estado=='Pendiente')
                     <h4><span class="badge badge-info"><i class="bi bi-exclamation-square"></i></span></h4>
                    @endif
                     @if($pase->estado=='Pasa')
                     <h4><span class="badge badge-success"><i class="bi bi-check-square"></i></span></h4>
                    @endif
                    @endif
                    @endforeach  
                    </td>
                    <?php 
                    $nombrealumno=App\Models\Alumno::where('id',$alumno->id_alumno)->pluck("nombrecompleto");
                    $nombrealumno = preg_replace('/[\[\]\.\;\""]+/', '', $nombrealumno);
                    ?>
                    <td class="v-align-middle">{{$nombrealumno}}</td>
                    <td class="td-actions v-align-middle">
                      <button class="btn btn-info" data-toggle="modal" data-target="#ModalCriterioEvaluacion{{$alumno->id_alumno}}"  title="Ver Información Criterio de Evaluación"><i class="bi bi-info-circle"></i></button> 
                         <div class="modal fade bd-example-modal-lg" id="ModalCriterioEvaluacion{{$alumno->id_alumno}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><strong>Información del alumno {{$nombrealumno}}</strong></h5>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                            <table class="table">
                              @foreach($notasfinales as $nota)
                              @if($alumno->id_alumno==$nota->id_alumno)
                               <tr>
                                <td class="v-align-middle" >
                                <label><strong><u>Espacio curricular:</u></strong></label>
                                {{$nota->espacio}}
                                <br> 
                                <label>Nota Final:</label>
                                {{$nota->nota}}
                                <br>
                                <label>Observación:</label>
                                {{$nota->observacion}}
                                </td>
                               </tr>
                               @endif
                               @endforeach
                           </table>
                         </div>
                       </div>
                     </div>
                   </div>
                    @foreach($pasegrado as $pase)
                    @if($alumno->id_alumno==$pase->id_alumno and $pase->estado =='Pendiente')
                   <button class="btn btn-success" data-toggle="modal" data-target="#myModal2{{$alumno->id}}" title="Pase de grado">
                            Pase de grado
                    </button>
                    <div class="modal fade" id="myModal2{{$alumno->id}}" role="dialog">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                          <span class="text-center">Pase de grado del alumno {{$nombrealumno}}</span>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-footer justify-content-center">
                          <form action="{{route('nopasegrado',$alumno->id_alumno)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('PUT')
                          <button class="btn btn-lg btn-danger" type="submit" rel="tooltip">No pasa</button>
                          </form>
                          <form action="{{route('accionpasegrado',$alumno->id_alumno)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('PUT')
                          <button class="btn btn-lg btn-success" type="submit" rel="tooltip">Si pasa</button>
                          </form>
                          </div>
      </div>
      
    </div>
  </div> 
                    @endif
                    @if($alumno->id_alumno==$pase->id_alumno and $pase->estado !='Pendiente')
                   <button class="btn btn-danger" data-toggle="modal" data-target="#myModal2{{$alumno->id}}" title="Pase de grado">
                    Modificar pase de grado
                    </button>
                    <div class="modal fade" id="myModal2{{$alumno->id}}" role="dialog">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                          <span class="text-center">Pase de grado del alumno {{$nombrealumno}}</span>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                           <div class="modal-footer justify-content-center">
                          <form action="{{route('nopasegrado',$alumno->id_alumno)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('PUT')
                          <button class="btn btn-lg btn-danger" type="submit" rel="tooltip">No pasa</button>
                          </form>
                          <form action="{{route('accionpasegrado',$alumno->id_alumno)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('PUT')
                          <button class="btn btn-lg btn-success" type="submit" rel="tooltip">Si pasa</button>
                          </form>
                          </div>
      </div>
      
    </div>
  </div> 
                    @endif
                    @endforeach
                             
                    </td>
                      
                    </tr>
                    </tbody>
                    @endforeach
                  </table>
                  </div>
                
                  </div>
                  <div class="row">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<h4><span class="badge badge-info"><i class="bi bi-exclamation-square"></i></span></h4>&nbsp Pendiente
                  &nbsp<h4><span class="badge badge-danger"><i class="bi bi-x-square"></i></span></h4>&nbsp No pasó
                  &nbsp<h4><span class="badge badge-success"><i class="bi bi-check-square"></i></span></h4>&nbsp Pasó
                  </div>
                  <div class="text-center">
                <button class="btn btn-sm btn-facebook" data-toggle="modal" data-target="#myModal2" title="Pasar todos">
                            Pasar todos
                          </button>
                </div>
                          <div class="modal fade" id="myModal2" role="dialog">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                            <span class="text-center">Pase de grado de todos los alumnos de {{$infgrado}}</span>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-footer justify-content-center">
                          <form action="{{route('nopasartodos')}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('PUT')
                          <div style="display:none">
                          <input type="text" name="grado" value="{{$infgrado}}">
                          </div>
                          <button class="btn btn-danger" type="submit" rel="tooltip">No pasa</button>
                          </form>
                          <form action="{{route('pasartodos')}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('PUT')
                          <div style="display:none">
                          <input type="text" name="grado" value="{{$infgrado}}">
                          </div>
                          <button class="btn btn-success" type="submit" rel="tooltip">Si pasa</button>
                          </form>
          
        </div>
      </div>
      
    </div>
  </div> 
    @endif
                       <div class="card-footer mr-auto">
                    {{$notasfinales->links()}}
                </div>
                   
                     </div>
                   </div>      
                </div>
          </div>
        </div>
      </div>
     </div>

@endsection


      
