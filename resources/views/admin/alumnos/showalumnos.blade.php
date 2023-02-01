@extends('layouts.main', ['activePage' => 'alumno', 'titlePage' => 'Detalles del alumno'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary" style="background-color: grey;">
            <div class="card-title">Alumnos Registrados</div>
            <p class="card-category">Vista detallada del alumno: {{ $alu->nombrealumno }} {{ $alu->apellidoalumno }}</p>
          </div>
          <div class="card-body row justify-content-center ">
                <div class="row ">
                  <div class="col-md-14">
                    <div class="card card-user" style="border: solid lightgrey;">
                      <div class="card-body">
                        <p class="card-text" >
                          <div class="author">
                            <h5 class="tittle mt-3"><strong>ALUMNO: {{$alu->nombrealumno}} {{$alu->apellidoalumno}}</strong></h5>
                          </div>
                        <p class="description">
                            <table class="table">
                              <tr>
                                <td class="v-align-middle" >
                                <label>DNI:</label>  {{$alu->dnialumno}}
                                </td>
                                <td class="v-align-middle">
                                <label>Género:</label>  {{$alu->generoalumno}}
                                </td>
                                <td class="v-align-middle">
                                <label>Fecha de nacimiento:</label>  {{$alu->fechanacimiento}}
                                </td> 
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                <label>Domicilio:</label>  {{$alu->domicilio}}
                                </td>
                                <td class="v-align-middle">
                                <label>Localidad:</label>  {{$alu->localidad}}
                                </td>
                                <td class="v-align-middle">
                                <label>Provincia:</label>  {{$alu->provincia}}
                                </td>
                                </tr>
                           </table>
                        </p>
                        <div class="row ">
                        <div class="col-md-14">
                            <h5 class="tittle mt-3"><strong>DATOS DEL FAMILIAR: </strong></h5>
                          </div>
                        <p class="description">
                            <table class="table">
                              <tr>
                                <td class="v-align-middle" >
                                <label>DNI:</label>  {{$familia->dnifamilia}}
                                </td>
                                <td class="v-align-middle">
                                <label>Apellido:</label>  {{$familia->apellidofamilia}}
                                </td>
                                <td class="v-align-middle">
                                <label>Nombre:</label>  {{$familia->nombrefamilia}}
                                </td>
                                </tr> 
                              <tr>
                                <td class="v-align-middle">
                                <label>Género:</label>  {{$familia->generofamilia}}
                                </td>
                                <td class="v-align-middle">
                                <label>Teléfono celular:</label>  {{$familia->telefono}}
                                </td>
                                <td class="v-align-middle">
                                <label>Email:</label>  {{$familia->email}}
                                </td>
                                </tr>
                                <tr>
                                <td class="v-align-middle">
                                <label>Vínculo Familiar:</label>  {{$familia->vinculofamiliar}}
                                </td>
                                </tr>                                
                           </table>
                        </p>
                      </div>
                  <div class="card-footer" >
                  <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                  <a href="{{route('alumnos.index')}}" class="btn btn-sm btn-facebook">Volver</a>
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