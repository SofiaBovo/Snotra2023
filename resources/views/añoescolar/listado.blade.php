@extends('layouts.main', ['activePage' => 'añoescolar', 'titlePage' => __('Año escolar')])
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
                <h4 class="card-title ">Años escolares</h4>
                <p class="card-category">Historial de años escolares</p>
              </div> 
              @if($colegio->isEmpty())
                <br>
                 <div class="col-md-12 text-center">
                <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
              <h4><span class="badge badge-warning">Para poder crear el año escolar, <br>antes deberá cargar las configuraciones básicas.</span></h4>
              <?php 
                  }
                  else{?>
              <h4><span class="badge badge-warning">Para poder crear el año escolar, antes deberá cargar las configuraciones básicas.</span></h4>
              </div>
              <br>
              <?php 
                  }
                  ?>
              @elseif(empty($periodocolegio))
                <br>
               <div class="col-md-12 text-center">
                <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
              <h4><span class="badge badge-warning">Para poder crear el año escolar, <br>antes deberá cargar las configuraciones básicas.</span></h4>
              <?php 
                  }
                  else{?>
              <h4><span class="badge badge-warning">Para poder crear el año escolar, antes deberá cargar las configuraciones básicas.</span></h4>
              </div>
                <?php 
                  }
                  ?>
              <br>
              @else
              <div class="card-body">
                <div class="row">
                  <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
                       <div class="col-12" style="text-align:right;">
                    <a href="{{route('añocreate') }}" class="btn btn-sm btn-facebook">Crear</a>
                  </div>
                  <?php 
                  }
                  else{?>
                   <div class="col-12 text-right">
                    <a href="{{route('añocreate') }}" class="btn btn-sm btn-facebook">Crear</a>
                  </div>  
                  <?php 
                  }
                  ?>
                 
                  @if(session('danger'))
                    <div class="alert alert-danger" role="danger">
                    {{session('danger')}}
                    </div>
                    <script type="text/javascript">
                    window.setTimeout(function() {
                    $(".alert-danger").fadeTo(400, 0).slideUp(400, function(){
                    $(this).remove(); 
                    });
                    }, 1000);
                    </script>
                  @endif
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
                  @if($años->isEmpty())
                  <div class="text-center"> 
                    <h4><span class="badge badge-warning">No hay ningún año escolar asociado a este colegio.</span></h4>
                  </div>
                  @else
                  <br>
                  <div class="table-responsive">
                    <br>
                  <table class="table">
                    <thead class="text-primary">
                    <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
                      <th>Año</th>
                      <th>Inicio</th>
                      <th>Fin</th>
                      <th>Estado</th>
                      <th>Acciones</th>                     
                    <?php 
                    }
                    else{?>
                      <th>Descripción</th>
                      <th>Fecha inicio</th>
                      <th>Fecha fin</th>
                      <th>Estado</th>
                      <th>Acciones</th> 
                    <?php 
                    }
                    ?>
                    </thead>
                    @foreach($años as $año)
                    <tr>
                      <td class="v-align-middle">{{$año->descripcion}}</td>
                      <?php 
                      if ($detect->isMobile() or $detect->isTablet()) {?>
                      <td class="v-align-middle">{{ \Carbon\Carbon::parse($año->fechainicio)->format('d/m/y')}}</td>
                      <td class="v-align-middle">{{ \Carbon\Carbon::parse($año->fechafin)->format('d/m/y')}}</td>
                      <?php 
                      }
                      else{?>
                       <td class="v-align-middle">{{ \Carbon\Carbon::parse($año->fechainicio)->format('d/m/Y')}}</td>
                      <td class="v-align-middle">{{ \Carbon\Carbon::parse($año->fechafin)->format('d/m/Y')}}</td>  
                      <?php 
                      }
                      ?>
                      <td class="td-actions v-align-middle">
                        <?php 
                        if($año->estado=='inactivo')
                        {
                          ?>
                          <a href="{{route('actualizarestado',$año->id)}}"class="btn btn-danger">
                          <i class="bi bi-dash-circle"></i>
                          </a>
                        
                          <?php
                        }
                        
                        elseif($año->estado=='activo')
                        {
                          ?>
                          <a href="{{route('actualizarestado',$año->id)}}"class="btn btn-success">
                          <i class="bi bi-check-circle"></i>
                          </a>
                          <?php
                        }
                        elseif($año->estado=='cerrado')
                        {
                          ?>
                          <a href="{{route('actualizarestado',$año->id)}}"class="btn btn-info">
                          <i class="bi bi-lock"></i>
                          </a>
                          <?php
                        }
                        ?>
                      </td>
                      <td class="td-actions v-align-middle">
                          <button class="btn btn-info" data-toggle="modal" data-target="#myModal{{$año->id}}" title="Ver Información de año escolar">
                          <i class="bi bi-info-circle"></i>
                          </button>
                          <div class="modal fade bd-example-modal-lg" id="myModal{{$año->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><strong>Información de año escolar</strong></h5>
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body ">
                            <table class="table">
                              <tr>
                                <td class="v-align-middle" >
                                <label><strong>Año:</strong></label>  {{$año->descripcion}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                <label><strong>Fecha de inicio:</strong></label>  {{\Carbon\Carbon::parse($año->fechainicio)->format('d/m/Y')}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                <label><strong>Fecha de finalización:</strong></label>  {{\Carbon\Carbon::parse($año->fechafin)->format('d/m/Y')}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                <label><strong>Fechas {{$periodocolegio}}</strong></label
                                  >
                                <br>
                                @if($periodocolegio=='Bimestre')
                                &nbsp &nbsp</t><label>Primera Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo1)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo1)->format('d/m/Y')}}
                                  <br>
                                &nbsp &nbsp<label>Segunda Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo2)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo2)->format('d/m/Y')}}
                                  <br>
                                &nbsp &nbsp<label>Tercera Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo3)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo3)->format('d/m/Y')}}
                                  <br>
                                &nbsp &nbsp<label>Cuarta Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo4)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo4)->format('d/m/Y')}}
                                  <br>
                                @endif
                                @if($periodocolegio=='Trimestre')
                                &nbsp &nbsp<label>Primer Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo1)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo1)->format('d/m/Y')}}
                                  <br>
                                &nbsp &nbsp<label>Segunda Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo2)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo2)->format('d/m/Y')}}
                                  <br>
                                &nbsp &nbsp<label>Tercera Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo3)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo3)->format('d/m/Y')}}
                                  <br>
                                @endif
                                @if($periodocolegio=='Cuatrimestre')
                                &nbsp &nbsp<label>Primer Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo1)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo1)->format('d/m/Y')}}
                                  <br>
                                &nbsp &nbsp<label>Segunda Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo2)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo2)->format('d/m/Y')}}
                                  <br>
                                @endif
                                @if($periodocolegio=='Semestre')
                                &nbsp &nbsp<label>Primer Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo1)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo1)->format('d/m/Y')}}
                                  <br>
                                &nbsp &nbsp<label>Segunda Etapa:</label>
                                  {{\Carbon\Carbon::parse($año->inicioperiodo2)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($año->finperiodo2)->format('d/m/Y')}}
                                  <br>
                                @endif
                                </td>
                              </tr>
                           </table>
                         </div>
                       </div>
                     </div>
                   </div>
                        <a href="{{ route('editaraño',$año->id) }}" class="btn btn-warning" title="Modificar año escolar">
                        <i class="bi bi-pencil"></i></a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#myModal2{{$año->id}}" title="Eliminar año escolar">
                        <i class="bi bi-archive"></i>
                        </button>
                          <div class="modal fade" id="myModal2{{$año->id}}" role="dialog">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                          </div>
                          <div class="modal-body">
                          <p class="text-center">¿Está seguro que desea eliminar el año escolar {{$año->descripcion}}?</p>
                          </div>
                          <div class="modal-footer justify-content-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          <form action="{{route('eliminaraño',$año->id)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('DELETE')
                          <button class="btn btn-success" type="submit" rel="tooltip">Aceptar</button>
                          </form>
                    </tr>                                          
                    @endforeach
                    </table>
                    <div style="text-align: center;">
                  <button class="btn btn-danger btn-xs custom" >
                  <i class="bi bi-dash-circle"></i></button> Inactivo
                  <button class="btn btn-success btn-xs custom">
                  <i class="bi bi-check-circle"></i></button> Activo
                  <button class="btn btn-info btn-xs custom">
                  <i class="bi bi-lock"></i></button> Cerrado
                   </div>
                   <div class="card-footer mr-auto" style="text-align: center;">
                    {{ $años->links() }}
                  </div>
                   </div>
                   @endif
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
