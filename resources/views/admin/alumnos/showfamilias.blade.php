@extends('layouts.main', ['activePage' => 'alumno', 'titlePage' => 'Detalles de la familia'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <div class="card-title">Familia</div>
            <p class="card-category">Vista detallada del familiar: {{ $fam->nombrefamilia }} {{ $fam->apellidofamilia }}</p>
          </div>
          <div class="card-body row justify-content-center ">
                <div class="row ">
                  <div class="col-md-14">
                    <div class="card card-user" style="border: 5px solid grey">
                      <div class="card-body">
                        <p class="card-text" >
                          <div class="author">
                            <h5 class="tittle mt-3"><strong>FAMILIA: {{$fam->nombrefamilia}} {{$fam->apellidofamilia}}</strong></h5>
                          </div>
                        <p class="description">
                            <table class="table">
                              <tr>
                                <td class="v-align-middle" >
                                <label>DNI:</label>  {{$fam->dnifamilia}}
                                </td>
                                </tr> 
                              <tr>
                                <td class="v-align-middle">
                                <label>Género:</label>  {{$fam->generofamilia}}
                                </td>
                                <td class="v-align-middle">
                                <label>Teléfono:</label>  {{$fam->telefono}}
                                </td>
                                <td class="v-align-middle">
                                <label>Email:</label>  {{$fam->email}}
                                </td>
                                </tr>
                                <tr>
                                <td class="v-align-middle">
                                <label>Vínculo Familiar:</label>  {{$fam->vinculofamiliar}}
                                </td>
                                </tr>                                
                           </table>
                        </p>
                      </div>
                  <div class="card-footer" >
                  <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                  <a href="{{route('alumnos.create')}}" class="btn btn-sm btn-facebook">Volver</a>
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