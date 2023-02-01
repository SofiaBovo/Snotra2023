@extends('layouts.main' , ['activePage' => 'criteriosevaluacion', 'titlePage => Criterios'])
<?php
      $detect = new Mobile_Detect;
?>
@section ('content')
 <div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title "> Criterios de evaluación</h4>  
              </div>
              <div class="card-body">
                @if($tipodoc=='Grado')
                @if($datoscriterio->isEmpty())
                  @if(empty($especialidad) && empty($añoescolar))
                  <div class="row">
                  <div class="col-12 text-right">
                   <a href="{{route('criteriocreate')}}" class="btn btn-sm btn-facebook" title="Crear criterio"><i class="material-icons">add</i></a>
                  </div>
                </div>
                <div class="text-center"><h4><span class="badge badge-warning"> Aún no hay Criterios de Evaluación creados.</span></h4></div>
                @else
                <div class="card card-body" style="border: thin solid lightgrey;">
                  <form>
                      <input name="buscarespecialidad" class="form-control mr-sm-2" type="search" placeholder="Buscar por espacio curricular" aria-label="Search" value="{{$especialidad}}">
                        <input name="buscarañoescolar" class="form-control mr-sm-2" type="search" placeholder="Buscar por año escolar" aria-label="Search" value="{{$añoescolar}}">
                        <div class="text-right"><button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                        <a href="{{url ('criteriosevaluacion') }}" class="btn btn-sm btn-facebook"> Limpiar </a></div>
                    </form> 
                  </div>
                  <div class="text-center"><h4><span class="badge badge-warning">Lo sentimos. No encontramos resultados para el filtro aplicado.</span></h4></div>

                  @endif
            @else
                <!-- TABLA DOCENTE DE GRADO -->
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                    <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
                    <th>Espacio</th>
                    <th>Criterio</th>
                    <th>Acciones</th>
                    <?php 
                    }
                    else{?>
                    <th>Año escolar</th>
                    <th>Etapa</th>
                    <th>Espacio curricular</th>
                    <th>Criterio</th>
                    <th>Acciones</th>
                    <?php 
                    }
                    ?>
                      
                    </thead>
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
                     @if(session('danger'))
                    <div class="alert alert-danger" role="danger">
                    {{session('danger')}}
                    </div>
                    <script type="text/javascript">
                    window.setTimeout(function() {
                    $(".alert-danger").fadeTo(400, 0).slideUp(400, function(){
                    $(this).remove(); 
                    });
                    }, 2000);
                    </script>
                  @endif
                     <div class="text-right">
                      <a href="{{route('criteriocreate')}}" class="btn btn-sm btn-facebook" title="Crear criterio"><i class="material-icons">add</i></a>
                       <button class="btn btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="material-icons">filter_list</span></button>
                    <div class="collapse" id="collapseExample">
                    <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                    <div class="card card-body" style="border: thin solid lightgrey; margin-top: 2%; width: 95%; margin-left: 1%;">
                    <?php 
                  }
                  else{?>
                    <div class="card card-body" style="border: thin solid lightgrey; margin-top: 2%; ">
                    <?php 
                  }
                  ?>
                      <form>
                       <input name="buscarespecialidad" class="form-control mr-sm-2" type="search" placeholder="Buscar por espacio curricular" aria-label="Search" value="{{$especialidad}}">
                        <input name="buscarañoescolar" class="form-control mr-sm-2" type="search" placeholder="Buscar por año escolar" aria-label="Search" value="{{$añoescolar}}">
                        <div class="text-right"><button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                        <a href="{{url ('criteriosevaluacion') }}" class="btn btn-sm btn-facebook"> Limpiar </a>
                        </div>
                     </form>
                  </div>
                    </div>
                    </div>                   
                    <tbody>
                    @foreach($datoscriterio as $criterio)
                    <tr>
                      <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {
                    }
                    else{?>
                      <td class="v-align-middle">{{$criterio->id_año}}</td>
                       <td class="v-align-middle">{{$criterio->periodo}}</td>
                    <?php 
                    }
                    ?>
                      <td class="v-align-middle">{{$criterio->id_espacio}}</td>
                      <td class="v-align-middle">{{$criterio->criterio}}</td>
                      <td class="td-actions v-align-middle">
                      <button class="btn btn-info" data-toggle="modal" data-target="#ModalCriterioEvaluacion{{$criterio->id}}"  title="Ver Información Criterio de Evaluación"><i class="bi bi-info-circle"></i></button> 

                         <div class="modal fade bd-example-modal-lg" id="ModalCriterioEvaluacion{{$criterio->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><strong><i class="bi bi-list-check"></i> Vista detallada del Criterio de Evaluación</strong></h5>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                            <table class="table">
                               <tr>
                                <td class="v-align-middle" >
                                <label><strong>Año Escolar:</strong></label>  {{$criterio->id_año}}
                                </td>
                              </tr>
                               <tr>
                                <td class="v-align-middle" >
                                <label><strong>Espacio Curricular:</strong></label>  {{$criterio->id_espacio}}
                                </td>
                              </tr>
                              <tr>
                               <td class="v-align-middle" >
                                <label><strong>Etapa:</strong></label>  {{$criterio->periodo}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Criterio de Evaluación:</strong></label>  {{$criterio->criterio}}
                                </td>
                              </tr>
                                 <tr>
                                <td class="v-align-middle" >
                                <label><strong>Ponderación:</strong> {{$criterio->ponderacion}} - </label>&nbsp  
                                @if($criterio->ponderacion==1) 
                                  <label style="color: #008000;"><strong>Muy baja.</strong></label>
                                @elseif($criterio->ponderacion==2) 
                                  <label style="color: #57a639;"><strong>Baja.</strong></label>
                                @elseif($criterio->ponderacion==3) 
                                  <label style="color: #cccc00;"><strong>Media.</strong></label>
                                @elseif($criterio->ponderacion==4) 
                                  <label style="color: #FF8000;"><strong>Alta.</strong></label>
                                @elseif($criterio->ponderacion==5) 
                                  <label style="color: #FF0000;"><strong>Muy Alta.</strong></label>
                                </td>
                              </tr>
                              @endif
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Descripción:</strong></label>  {{$criterio->descripcion}}
                                </td>
                              </tr>
                           </table>
                         </div>
                       </div>
                     </div>
                   </div>      
                    
                    <a href="{{ route('editarcriterio',$criterio->id) }}"class="btn btn-warning"  title="Editar Criterio de Evaluación"><i class="bi bi-pencil"></i></a>  

                    <button class="btn btn-danger" data-toggle="modal" data-target="#EliminarCriterioEvaluación{{$criterio->id}}" title="Eliminar Criterio de Evaluación">
                            <i class="bi bi-trash"></i>
                          </button>
                          <div class="modal fade" id="EliminarCriterioEvaluación{{$criterio->id}}" role="dialog">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="EliminarCriterioEvaluación"><strong><i class="bi bi-exclamation-circle" style="color: red;"></i>  Criterio de Evaluación</strong></h5> 
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                          <p class="text-center">¿Está seguro que desea eliminar el Criterio de Evaluación <strong>{{$criterio->criterio}}</strong>, para el espacio curricular {{$criterio->id_espacio}}?</p>
                          </div>
                          <div class="modal-footer justify-content-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          <form action="{{route('destroycriterio',$criterio->id)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('DELETE')
                          <button class="btn btn-success" type="submit" rel="tooltip">Aceptar</button>
                          </form>
                          </div>
                          </div>
                          </div>
                          </div>                                       
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                @endif
                @else
                @if($datoscriterio->isEmpty())
                  @if(empty($especialidad) && empty($añoescolar))
                  <div class="row">
                  <div class="col-12 text-right">
                   <a href="{{route('criteriocreate')}}" class="btn btn-sm btn-facebook" title="Crear criterio"><i class="material-icons">add</i></a>
                  </div>
                </div>
                <div class="text-center"><h4><span class="badge badge-warning"> Aún no hay Criterios de Evaluación creados.</span></h4></div>
                @else
                <div class="card card-body" style="border: thin solid lightgrey;">
                  <form>
                      <input name="buscarañoescolar" class="form-control mr-sm-2" type="search" placeholder="Buscar por año escolar" aria-label="Search" value="{{$añoescolar}}">
                      <input name="buscargrado" class="form-control mr-sm-2" type="search" placeholder="Buscar por grado" aria-label="Search" value="{{$grado}}">
                      <div class="text-right"><button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                      <a href="{{url ('criteriosevaluacion') }}" class="btn btn-sm btn-facebook"> Limpiar </a></div>
                    </form> 
                  </div>
                  <div class="text-center"><h4><span class="badge badge-warning">Lo sentimos. No encontramos resultados para el filtro aplicado.</span></h4></div>
                  @endif
            @else
              
                <!-- TABLA DOCENTE ESPECIAL -->
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                    <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
                    <th>Grado</th>
                    <th>Criterio</th>
                    <th>Acciones</th>
                    <?php 
                    }
                    else{?>
                    <th>Año escolar</th>
                    <th>Etapa</th>
                    <th>Grado</th>
                    <th>Criterio</th>
                    <th>Acciones</th>
                    <?php 
                    }
                    ?>
                    </thead>
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
                     @if(session('danger'))
                    <div class="alert alert-danger" role="danger">
                    {{session('danger')}}
                    </div>
                    <script type="text/javascript">
                    window.setTimeout(function() {
                    $(".alert-danger").fadeTo(400, 0).slideUp(400, function(){
                    $(this).remove(); 
                    });
                    }, 2000);
                    </script>
                  @endif
                    <div class="text-right">
                      <a href="{{route('criteriocreate')}}" class="btn btn-sm btn-facebook" title="Crear criterio"><i class="material-icons">add</i></a>
                       <button class="btn btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="material-icons">filter_list</span></button>
                    <div class="collapse" id="collapseExample">
                    <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                    <div class="card card-body" style="border: thin solid lightgrey; margin-top: 2%; width: 95%; margin-left: 1%;">
                    <?php 
                  }
                  else{?>
                    <div class="card card-body" style="border: thin solid lightgrey; margin-top: 2%; ">
                    <?php 
                  }
                  ?>
                      <form>
                       <input name="buscarañoescolar" class="form-control mr-sm-2" type="search" placeholder="Buscar por año escolar" aria-label="Search" value="{{$añoescolar}}">
                        <input name="buscargrado" class="form-control mr-sm-2" type="search" placeholder="Buscar por grado" aria-label="Search" value="{{$grado}}">
                        <div class="text-right"><button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                        <a href="{{url ('criteriosevaluacion') }}" class="btn btn-sm btn-facebook"> Limpiar </a>
                        </div>
                     </form>
                  </div>
                    </div>
                    </div> 

                    <tbody>
                    @foreach($datoscriterio as $criterio)
                    <tr>
                       <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {
                    }
                    else{?>
                      <td class="v-align-middle">{{$criterio->id_año}}</td>
                       <td class="v-align-middle">{{$criterio->periodo}}</td>
                    <?php 
                    }
                    ?>
                      <td class="v-align-middle">{{$criterio->id_grado}}</td>
                      <td class="v-align-middle">{{$criterio->criterio}}</td> 
                      <td class="td-actions v-align-middle">
                      <button class="btn btn-info" data-toggle="modal" data-target="#ModalCriterioEvaluacion{{$criterio->id}}"  title="Ver Información Criterio de Evaluación"><i class="bi bi-info-circle"></i></button> 

                         <div class="modal fade bd-example-modal-lg" id="ModalCriterioEvaluacion{{$criterio->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="ModalCriterioEvaluacion"><strong><i class="bi bi-list-check"></i> Vista detallada del Criterio de Evaluación</strong></h5>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                            <table class="table">
                               <tr>
                                <td class="v-align-middle" >
                                <label><strong>Año Escolar:</strong></label>  {{$criterio->id_año}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Grado:</strong></label>  {{$criterio->id_grado}}
                                </td>
                              </tr>
                               <tr>
                                <td class="v-align-middle" >
                                <label><strong>Etapa:</strong></label>  {{$criterio->periodo}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Criterio de Evaluación:</strong></label>  {{$criterio->criterio}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Ponderación:</strong> {{$criterio->ponderacion}} - </label>&nbsp  
                                @if($criterio->ponderacion==1) 
                                  <label style="color: #008000;"><strong>Muy baja.</strong></label>
                                @elseif($criterio->ponderacion==2) 
                                  <label style="color: #57a639;"><strong>Baja.</strong></label>
                                @elseif($criterio->ponderacion==3) 
                                  <label style="color: #cccc00;"><strong>Media.</strong></label>
                                @elseif($criterio->ponderacion==4) 
                                  <label style="color: #FF8000;"><strong>Alta.</strong></label>
                                @elseif($criterio->ponderacion==5) 
                                  <label style="color: #FF0000;"><strong>Muy Alta.</strong></label>
                                </td>
                              </tr>
                              @endif
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Descripción:</strong></label>  {{$criterio->descripcion}}
                                </td>
                              </tr>
                           </table>
                         </div>
                        </div>
                      </div>
                    </div>
                    
                    <a href="{{ route('editarcriterio',$criterio->id) }}" class="btn btn-warning"  title="Editar Criterio de Evaluación"><i class="bi bi-pencil"></i></a>  

                    <button class="btn btn-danger" data-toggle="modal" data-target="#EliminarCriterioEvaluación{{$criterio->id}}" title="Eliminar Criterio de Evaluación">
                            <i class="bi bi-trash"></i>
                          </button>
                          <div class="modal fade" id="EliminarCriterioEvaluación{{$criterio->id}}" role="dialog">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="EliminarCriterioEvaluación"><strong><i class="bi bi-exclamation-circle" style="color: red;"></i>  Criterio de Evaluación</strong></h5> 
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                          <p class="text-center">¿Está seguro que desea eliminar el Criterio de Evaluación <strong>{{$criterio->criterio}}</strong>, para  {{$criterio->id_grado}} ?</p>
                          </div>
                          <div class="modal-footer justify-content-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          <form action="{{route('destroycriterio',$criterio->id)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('DELETE')
                          <button class="btn btn-success" type="submit" rel="tooltip">Aceptar</button>
                          </form>
                          </div>
                          </div>
                          </div>
                          </div>     
                    </tr>                              
                    @endforeach
                    </tbody>
                  </table>
                  
                </div>
                   @endif
                @endif
                <div class="card-footer mr-auto">
                    {{$datoscriterio->links()}}
                </div>
                </div>
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
@endsection


      
