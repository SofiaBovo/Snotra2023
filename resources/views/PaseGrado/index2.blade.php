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
                     </div>
                   </div>      
                </div>
          </div>
        </div>
      </div>
     </div>

@endsection


      
