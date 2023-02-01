@extends('layouts.main' , ['activePage' => 'familia', 'titlePage => Familias'])
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
        <h4 class="card-title"> Familias</h4>
        <p class="card-category">Familias Registradas</p>    
      </div>
        @if($colegio->isEmpty())
          <br>
                  <?php 
                if ($detect->isMobile() or $detect->isTablet()) {?>
                <div class="col-md-12 text-center">
                <h4><span class="badge badge-warning">Para poder cargar las familias, antes deberá cargar la información del colegio.</span></h4>
                </div>
                <?php 
                  }
                else{?>
                <div class="col-md-12 text-center">
                <h4><span class="badge badge-warning">Para poder cargar las familias, antes deberá cargar la información del colegio.</span></h4>
                </div>
                  <?php 
                        }
                        ?>
          <br>
          
          @else
          
          <div class="card-body">
            @if ($familias->isEmpty())
              @if(empty($apellido) && empty($dni))
              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{route('crearfamilia')}}" class="btn btn-sm btn-facebook" title="Registrar familia"><i class="material-icons">person_add_alt</i></a>
                </div>
              </div>

              <div class="text-center"> <h4><span class="badge badge-warning">Aún no hay Familias creadas.</span></h4>
              </div>
                  
              @else
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
                    <input name="buscarapellido" class="form-control mr-sm-2" type="search" placeholder="Buscar por Apellido" value="{{$apellido}}">
                    <input name="buscardni" class="form-control mr-sm-2" type="search" placeholder="Buscar por DNI" aria-label="Search" value="{{$dni}}">
                    <div class="text-right">
                    <button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                    <a href="{{url ('admin/familias') }}" class="btn btn-sm btn-facebook"> Limpiar </a>
                    </div>
                    </form> 
                </div>
                 <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                <div class="text-center"><h4><span class="badge badge-warning">Lo sentimos.<br> No encontramos resultados para el filtro aplicado.</span></h4></div><?php 
                  }
                 else{?>
                  <div class="text-center"><h4><span class="badge badge-warning">Lo sentimos.<br> No encontramos resultados para el filtro aplicado.</span></h4></div> <?php 
                  }
                  ?>
                @endif
            
              @else
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                     <?php 
                    if ($detect->isMobile() or $detect->isTablet()) {?>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                     <?php 
                  }
                  else{?>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
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
                    }, 2000);
                    </script>
                    @endif

                  <div class="text-right">
                  <a href="{{route('crearfamilia')}}" class="btn btn-sm btn-facebook"><i class="material-icons">person_add_alt</i></a>
                  <button class="btn btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Filtrar familias"><span class="material-icons">filter_list</span></button>

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
                      
                      <input name="buscarapellido" class="form-control mr-sm-2" type="search" placeholder="Buscar por Apellido" aria-label="Search" value="{{$apellido}}">
                      <input name="buscardni" class="form-control mr-sm-2" type="search" placeholder="Buscar por DNI" aria-label="Search" value="{{$dni}}">
                      <div class="text-right">
                      <button class="btn btn-sm btn-facebook" type="submit">Buscar</button>
                      <a href="{{url ('admin/familias') }}" class="btn btn-sm btn-facebook"> Limpiar </a>
                      </div>
                    </form>
                  </div>
                  </div>
                  </div>
                  @foreach($familias as $fam)
                    <tr>
                  <?php 
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                      
                      <td class="v-align-middle">{{$fam->nombrefamilia}}</td>
                      <td class="v-align-middle">{{$fam->apellidofamilia}}</td>
                      <?php 
                  }
                  else{?>
                      <td class="v-align-middle">{{$fam->id}}</td>
                      <td class="v-align-middle">{{$fam->dnifamilia}}</td>
                      <td class="v-align-middle">{{$fam->nombrefamilia}}</td>
                      <td class="v-align-middle">{{$fam->apellidofamilia}}</td>
                           <?php 
                  }
                  ?>
                       <td class="td-actions td-actions v-align-middle">
                      <button class="btn btn-info" data-toggle="modal" data-target="#myModal{{$fam->id}}" title="Ver Información Familia"><i class="bi bi-person"></i></button>
                 
                      <div class="modal fade bd-example-modal-lg" id="myModal{{$fam->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><strong>Vista detallada de {{$fam->nombrefamilia}} {{$fam->apellidofamilia}}</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                        </div>
                        <?php 
                  
                  if ($detect->isMobile() or $detect->isTablet()) {?>
                    <div class="modal-body ">
                          <table class="table">
                            <tr>
                              <td class="v-align-middle" style="width: 100%;">
                              <label>DNI:</label> {{$fam->dnifamilia}}
                              </td>
                            </tr>
                            <tr>
                              <td  class="v-align-middle" style="width: 100%;">
                              <label>Género:</label> {{$fam->generofamilia}}
                              </td>
                            </tr>
                            <tr>
                              <td  class="v-align-middle" style="width: 100%;">
                              <label>Fecha de nacimiento:</label> {{\Carbon\Carbon::parse($fam->fechanacimiento)->format('d/m/y')}}
                               </td>
                            </tr>
                            
                            <tr>
                              <td class="v-align-middle" style="width: 100%;">
                                <label>Domicilio:</label>  {{$fam->domiciliofamilia}}
                              </td>
                              </tr>
                               <tr>
                              <td class="v-align-middle" style="width: 100%;">
                                <label>Localidad:</label>  {{$fam->localidadfamilia}}
                              </td>
                              </tr>
                                <tr>
                              <td class="v-align-middle" style="width: 100%;">
                                <label>Provincia:</label>  {{$fam->provinciafamilia}}
                              </td>
                            </tr>
                           </table>

                         </div>
                  <?php 
                  }
                  else{?>
                        <div class="modal-body ">
                          <table class="table">
                            <tr>
                              <td class="v-align-middle" >
                                <label>DNI:</label>  {{$fam->dnifamilia}}
                              </td>
                              <td class="v-align-middle">
                                <label>Género:</label>  {{$fam->generofamilia}}
                              </td>
                              <td class="v-align-middle">
                                <label>Vínculo familiar:</label>  {{$fam->vinculofamiliar}}
                              </td> 
                            </tr>
                            <tr>
                              <td class="v-align-middle">
                                <label>Domicilio:</label>  {{$fam->domiciliofamilia}}
                              </td>
                              <td class="v-align-middle">
                                <label>Localidad:</label>  {{$fam->localidadfamilia}}
                              </td>
                              <td class="v-align-middle">
                                <label>Provincia:</label>  {{$fam->provinciafamilia}}
                              </td>
                            </tr>
                             <tr>
                              <td class="v-align-middle">
                                <label>Teléfono:</label>  {{$fam->telefono}}
                              </td>
                              <td class="v-align-middle">
                                <label>Correo electrónico:</label>  {{$fam->email}}
                              </td>
                            </tr>
                           </table>

                         </div>
                          <?php 
                  }
                  ?>
                        </div>
                        </div>
                        </div>
                      <a href="{{ route('editarfam',$fam->id) }}" class="btn btn-warning" title="Modificar familia"><i class="bi bi-pencil"></i></a>
                      <button class="btn btn-danger" data-toggle="modal" data-target="#myModal2{{$fam->id}}" title="Eliminar familia"><i class="bi bi-trash"></i></button>
                          
                      <div class="modal fade" id="myModal2{{$fam->id}}" role="dialog">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" title="Cerrar">&times;</button>
                        </div>
                        <div class="modal-body">
                        <p class="text-center">¿Está seguro que desea eliminar el familiar {{$fam->nombrefamilia}}  {{$fam->apellidofamilia}}?</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <form action="{{route('eliminarfamilia',$fam->id)}}" method="POST" style="display: inline-block;">
                          @csrf
                          @METHOD('DELETE')
                        <button class="btn btn-success" type="submit" rel="tooltip">Aceptar</button>
                        </form>
                        </div>
                        </div>
                        </div>
                      </div>              
                      </td>
                      </tr>  
                      @endforeach

                          
                        
                  
                @endif


                </table>

                
                  
              </div>
             <div class="card-footer mr-auto">
                {{$familias->links() }}
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

