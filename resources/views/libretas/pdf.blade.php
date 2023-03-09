<html>
<head>
    <style>
        @page {
            margin: 0.1cm 0.1cm;
        }
        body {
            margin: 3cm 2cm 4cm;
        }
        header {
            position: fixed;
            margin-top:-8px;
            vertical-align:middle;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
            color: black;
            text-align: center;
            line-height: 10px;
        }

        p {
            font-size: 17px;
        }

        footer {
            position:absolute;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            color: black;
            text-align: center;
            line-height: 35px;
        }
        .tabla{
            border: 1px solid;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<header>
	<table style="width:87%;"> 
	<tr>
		<td style="width:17%;text-align:center;"> 
        <?php 
         $idcolegio=Auth::user()->colegio_id;
         $files_id=App\Models\Colegio::where('id',$idcolegio)->pluck('files_id');
         $files_id = preg_replace('/[\[\]\.\;\""]+/', '', $files_id);
         $files=App\Models\File::where('id',$files_id)->pluck('file');
         $files=preg_replace('/[\[\]\\;\""]+/', '', $files);
        ?>
        <br>
        <img src="./file/{{$files}}" width="130px" height="130px"/>
		</td>
		<td style="width:83%;text-align: center;">
			<p style="font-size: 22px;">
    	<?php 
    	 $idcolegio=Auth::user()->colegio_id;
            $nombrecolegio=App\Models\Colegio::where('id',$idcolegio)->pluck('nombre');
            $nombrecolegio = preg_replace('/[\[\]\.\;\""]+/', '', $nombrecolegio); 
            ?>Establecimiento "{{$nombrecolegio}}"  </p>
    <p style="font-size: 18px;">
    	<?php 
    	 $idcolegio=Auth::user()->colegio_id;
    	 $direccioncolegio=App\Models\Colegio::where('id',$idcolegio)->pluck('direccion');
         $direccioncolegio = preg_replace('/[\[\]\.\;\""]+/', '', $direccioncolegio);
         $localidad=App\Models\Colegio::where('id',$idcolegio)->pluck('localidad');
         $localidad = preg_replace('/[\[\]\.\;\""]+/', '', $localidad);
         $provincia=App\Models\Colegio::where('id',$idcolegio)->pluck('provincia');
         $provincia = preg_replace('/[\[\]\.\;\""]+/', '', $provincia);
         ?>Dirección: {{$direccioncolegio}} - {{$localidad}} ({{$provincia}})
    </p>
    <p style="font-size: 18px;">
    	<?php 
    	 $idcolegio=Auth::user()->colegio_id;
    	 $telefonocolegio=App\Models\Colegio::where('id',$idcolegio)->pluck('telefono');
         $telefonocolegio = preg_replace('/[\[\]\.\;\""]+/', '', $telefonocolegio);
         ?>Teléfono: {{$telefonocolegio}}
   	</p>
		</td>
	</tr>
	</table>
    <hr style="background-color:#5B86E5;color:#5B86E5 ;height: 5px;">
</header>
<main style="position:relative;top: 40px;">
    <u><h3 style="text-align:center;">INFORME DE PROGRESO ESCOLAR</h3></u>
    <p style="text-align: justify;">
        <?php
        $generoalumno=App\Models\Alumno::where('nombrecompleto',$nombrecompleto)->pluck('generoalumno');
        $generoalumno = preg_replace('/[\[\]\.\;\""]+/', '', $generoalumno);
        $gradoalumno=App\Models\Alumno::where('nombrecompleto',$nombrecompleto)->pluck('grado');
        $gradoalumno = preg_replace('/[\[\]\.\;\""]+/', '', $gradoalumno);
        $idcolegio=Illuminate\Support\Facades\Auth::user()->colegio_id;
        $infoaño=App\Models\Año::where('id_colegio',$idcolegio)->where('estado','=','activo')->get();
        foreach($infoaño as $activo){
        $idaño="$activo->id";
        $descripcionaño="$activo->descripcion";
        }
        if($generoalumno=='Femenino'){
         ?>
         La alumna <strong>{{$nombrecompleto}}</strong> de <strong>{{$gradoalumno}}</strong> ha obtenido las siguientes valoraciones durante la <strong>{{$periodo}}</strong> perteneciente al año lectivo <strong>{{$descripcionaño}}</strong>. 
        <?php 
        }
        if($generoalumno=='Masculino'){
         ?>
         El alumno <strong>{{$nombrecompleto}}</strong> de <strong>{{$gradoalumno}}</strong> ha obtenido las siguientes valoraciones durante la <strong>{{$periodo}}</strong> perteneciente al año lectivo <strong>{{$descripcionaño}}</strong>. 
        <?php
        }
        ?>
    </p>
    <?php 
    $idalumno=App\Models\Alumno::where('nombrecompleto',$nombrecompleto)->pluck('id');
    $idalumno = preg_replace('/[\[\]\.\;\""]+/', '', $idalumno);
    $informealumno=App\Models\Informes::where('id_alumno',$idalumno)->where('año',$idaño)->where('colegio_id',$idcolegio)->where('periodo',$periodo)->get();
    ?>
        <table class="tabla" style="width: 100%;page-break-after:auto;" >
        <thead style="background-color:#BEC2DD;">
        <th class="tabla" style="width:30%;">Espacio curricular</th>
        <th class="tabla" style="width:15%;">Valoración</th>
        <th class="tabla" style="width:55%;">Síntesis de la etapa</th>
        </thead>
        <tbody>
        @foreach($informealumno as $informe)
        <tr>
        <?php 
        if(empty($informe->espacio)){
        $idpersona=App\Models\User::where('id',$informe->docente)->where('colegio_id',$idcolegio)->pluck('idpersona');
        $idpersona = preg_replace('/[\[\]\.\;\""]+/', '', $idpersona);
        $especialidad=App\Models\Docente::where('id',$idpersona)->where('colegio_id',$idcolegio)->pluck('especialidad');
        $especialidad = preg_replace('/[\[\]\.\;\""]+/', '', $especialidad);
        ?>
        <td class="tabla">{{$especialidad}}</td>
        <?php 
        }
        else{
        ?>
        <td class="tabla">{{$informe->espacio}}</td>
        <?php 
        }
        ?>
        <td class="tabla">{{$informe->nota}}</td>
        <td class="tabla" style="text-align: justify;">{{$informe->observacion}}</td>
        </tr>
        @endforeach
        </tbody>
        </table>
</main>
   <div id="content" style="position: absolute; left: 91px;bottom:50px;">
    <table style="width:100%;">
        <tr>
            <td style="text-align:center;width: 200px;">..........................................</td>
            <td style="text-align:center;width: 200px;"></td>
            <td style="text-align:center;width: 200px;">...........................................</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size: 17px;width: 200px;">Firma directivo</td>
            <td style="text-align:center;font-size: 17px;width: 200px; ">Sello establecimiento</td>
            <td style="text-align:center;font-size: 17px;width: 200px; ">Firma docente</td>
        </tr>
    </table>
</div>

   <div id="footer"><script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(260, 810, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script></div>


</body>
</html>
