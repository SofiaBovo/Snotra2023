@extends('layouts.main' , ['activePage' => 'docente', 'titlePage => Ver docentes'])

@section('content')

 <div class="content">
   <div class="container-fluid ">
     <div class="row">
      <div class="col-md-12 ">
            <div class="card ">
              <div class="card-header card-header-primary" style="background-color: grey;">
                <h4 class="card-title ">Docentes registrados</h4>
                <p class="card-category">Vista detallada del docente {{$doc->nombre}} {{$doc->apellido}}</p>    
              </div>
              <div class="card-body row justify-content-center ">
                <div class="row ">
                  <div class="col-md-14">
                    <div class="card card-user" style="border: solid lightgrey;">
                      <div class="card-body">
                        <p class="card-text" >
                          <div class="author">
                            <h5 class="tittle mt-3"><strong>DOCENTE: {{$doc->nombre}} {{$doc->apellido}} </strong></h5>
                          </div>
                          <p class="description">
                            <table class="table">
                              <tr>
                                <td class="v-align-middle" >
                                <label>DNI</label>  {{$doc->dni}}
                                </td>
                                <td class="v-align-middle">
                                <label>Género</label>  {{$doc->genero}}
                                </td>
                                <td class="v-align-middle">
                                <label>Fecha de nacimiento</label>  {{$doc->fechanacimiento}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                <label>Domicilio</label>  {{$doc->domicilio}}
                                </td>
                                <td class="v-align-middle">
                                <label>Localidad</label>  {{$doc->localidad}}
                                </td>
                                <td class="v-align-middle">
                                <label>Provincia</label>  {{$doc->provincia}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                <label>Estado civil</label>  {{$doc->estadocivil}}
                                </td>
                                <td class="v-align-middle">
                                <label>Teléfono</label>  {{$doc->telefono}}
                                </td>
                                <td class="v-align-middle">
                                <label>Email</label>  {{$doc->email}}
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                <label>Legajo</label>  {{$doc->legajo}}
                                </td>
                                <td class="v-align-middle">
                                <label>Especialidad</label>  {{$doc->especialidad}}
                                </td>
                              </tr>
                           </table>
                        </p>
                        </p>
                        <div class="card-footer" >
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <a href="{{route('docentes.index')}}" class="btn btn-sm btn-facebook">Volver</a>
                        </div>
                        </div>
                      </div>
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