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
    <u><h3 style="text-align:center;">INFORME FINAL</h3></u>
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
         La alumna <strong>{{$nombrecompleto}}</strong> de <strong>{{$gradoalumno}}</strong> ha obtenido las siguientes valoraciones durante el año lectivo <strong>{{$descripcionaño}}</strong>. 
        <?php 
        }
        if($generoalumno=='Masculino'){
         ?>
         El alumno <strong>{{$nombrecompleto}}</strong> de <strong>{{$gradoalumno}}</strong> ha obtenido las siguientes valoraciones durante el año lectivo <strong>{{$descripcionaño}}</strong>. 
        <?php
        }
        ?>
    </p>
    <?php 
    $idalumno=App\Models\Alumno::where('nombrecompleto',$nombrecompleto)->pluck('id');
    $idalumno = preg_replace('/[\[\]\.\;\""]+/', '', $idalumno);
    $informealumno=App\Models\Informes::where('id_alumno',$idalumno)->where('año',$idaño)->where('colegio_id',$idcolegio)->get();
    $espacioscurri=App\Models\Informes::where('id_alumno',$idalumno)->where('año',$idaño)->where('colegio_id',$idcolegio)->get();
    $espacioscurri=$espacioscurri->unique('espacio');
    $espacioscurri=$espacioscurri->pluck('espacio');
    ?>
        <table class="tabla" style="width: 100%;page-break-after:auto;" >
        <thead style="background-color:#BEC2DD;">
        <th class="tabla" style="width:20%;">Espacio curricular</th>
        @if($informacionperiodo=='Bimestre')
        <?php 
        $cantidadperiodo=4;
        ?>
        <th class="tabla" style="width:15%;">Primera Etapa</th>
        <th class="tabla" style="width:15%;">Segunda Etapa</th>
        <th class="tabla" style="width:15%;">Tercera Etapa</th>
        <th class="tabla" style="width:15%;">Cuarta Etapa</th>
        @endif
        @if($informacionperiodo=='Trimestre')
        <?php 
        $cantidadperiodo=3;
        ?>
        <th class="tabla" style="width:15%;">Primera Etapa</th>
        <th class="tabla" style="width:15%;">Segunda Etapa</th>
        <th class="tabla" style="width:15%;">Tercera Etapa</th>
        @endif
        @if($informacionperiodo=='Cuatrimestre')
        <?php 
        $cantidadperiodo=2;
        ?>
        <th class="tabla" style="width:15%;">Primera Etapa</th>
        <th class="tabla" style="width:15%;">Segunda Etapa</th>
        @endif
        @if($informacionperiodo=='Semestre')
        <?php 
        $cantidadperiodo=2;
        ?>
        <th class="tabla" style="width:15%;">Primera Etapa</th>
        <th class="tabla" style="width:15%;">Segunda Etapa</th>
        @endif
        <th class="tabla" style="width:12%;">Valoración Final</th>
        </thead>
        <tbody>
        <?php 
        $contadorespacios=count($espacioscurri)-1;
        for($i=0;$i<=$contadorespacios;$i++){?>
        <tr>
        <td class="tabla">{{$espacioscurri[$i]}}</td>
        <?php 
        $notasespacio=[];
        for($j=0;$j<=$cantidadperiodo;$j++){
        $notasespacio[$j]='-';
        }
        ?>
        @foreach($informealumno as $informe)
        <?php
        if($espacioscurri[$i]==$informe->espacio){
        $notasfinales=App\Models\NotaFinal::where('id_alumno',$idalumno)->where('año',$idaño)->where('colegio_id',$idcolegio)->where('espacio',$espacioscurri[$i])->pluck("nota");
        $notasfinales = preg_replace('/[\[\]\.\;\""]+/', '', $notasfinales);
        if($informe->periodo=='Primera Etapa'){
        $notasespacio[0]=$informe->nota;
        }
        elseif($informe->periodo=='Segunda Etapa'){
        $notasespacio[1]=$informe->nota;
        }
        elseif($informe->periodo=='Tercera Etapa'){
        $notasespacio[2]=$informe->nota;
        }
        elseif($informe->periodo=='Cuarta Etapa'){
        $notasespacio[3]=$informe->nota;
        }       
        }
        ?>
        @endforeach
        <?php
        for($j=0;$j<$cantidadperiodo;$j++){?>
        <td class="tabla">{{$notasespacio[$j]}}</td> 
        <?php   
        }
        ?>
        <td class="tabla">{{$notasfinales}}</td> 
        </tr>
        <?php
        }
        ?>
        </tbody>
        </table>
        <?php
        $observacionesespacio=[];
        for($j=0;$j<=$cantidadperiodo;$j++){
        $observacionesespacio[$j]='-';
        }
        for($i=0;$i<=$contadorespacios;$i++){   
        ?>
        @foreach($informealumno as $informe)
        <?php
        $observacionesfinales=App\Models\NotaFinal::where('id_alumno',$idalumno)->where('año',$idaño)->where('colegio_id',$idcolegio)->where('espacio',$espacioscurri[$i])->pluck("observacion");
        $observacionesfinales = preg_replace('/[\[\]\.\;\""]+/', '', $observacionesfinales);
        if($espacioscurri[$i]==$informe->espacio){ 
        if($informe->periodo=='Primera Etapa'){
        $observacionesespacio[0]=$informe->observacion;
        }
        elseif($informe->periodo=='Segunda Etapa'){
        $observacionesespacio[1]=$informe->observacion;
        }
        elseif($informe->periodo=='Tercera Etapa'){
        $observacionesespacio[2]=$informe->observacion;
        }
        elseif($informe->periodo=='Cuarta Etapa'){
        $observacionesespacio[3]=$informe->observacion;
        }
        }
        ?> 
        @endforeach
        <h4>{{$espacioscurri[$i]}}</h4>
        <table class="tabla" style="width: 100%;page-break-after:auto;" >
        <thead style="background-color:#BEC2DD;">
        <th class="tabla" style="width:30%;">Etapa</th>
        <th class="tabla" style="width:30%;">Síntesis de la etapa</th>
        </thead>
        <tbody>
        @if($informacionperiodo=='Bimestre')
        <tr><td class="tabla">Primera Etapa</td>
        <td class="tabla">{{$observacionesespacio[0]}}</td></tr>
        <tr><td class="tabla">Segunda Etapa</td>
        <td class="tabla">{{$observacionesespacio[1]}}</td></tr>
        <tr><td class="tabla">Tercera Etapa</td>
        <td class="tabla">{{$observacionesespacio[2]}}</td></tr>
        <tr><td class="tabla">Cuarta Etapa</td>
        <td class="tabla">{{$observacionesespacio[3]}}</td></tr>
        @endif
        @if($informacionperiodo=='Trimestre')
        <tr><td class="tabla">Primera Etapa</td>
        <td class="tabla">{{$observacionesespacio[0]}}</td></tr>
        <tr><td class="tabla">Segunda Etapa</td>
        <td class="tabla">{{$observacionesespacio[1]}}</td></tr>
        <tr><td class="tabla">Tercera Etapa</td>
        <td class="tabla">{{$observacionesespacio[2]}}</td></tr>
        @endif
        @if($informacionperiodo=='Cuatrimestre')
        <tr><td class="tabla">Primera Etapa</td>
        <td class="tabla">{{$observacionesespacio[0]}}</td></tr>
        <tr><td class="tabla">Segunda Etapa</td>
        <td class="tabla">{{$observacionesespacio[1]}}</td></tr>
        @endif
        @if($informacionperiodo=='Semestre')
        <tr><td class="tabla">Primera Etapa</td>
        <td class="tabla">{{$observacionesespacio[0]}}</td></tr>
        <tr><td class="tabla">Segunda Etapa</td>
        <td class="tabla">{{$observacionesespacio[1]}}</td></tr>
        @endif
        </tbody>
        </table>
        <br>
        <div class="cuadrado">
        <strong>Sintesis Final</strong>
        <br>
        {{$observacionesfinales}}
        </div>
        <style>
        .cuadrado{
        padding:5px;
        width: 98.5%;
        background-color: #DBF98E;
        border: solid 0.5px #BDC8A2;
        color: black;
        }
        </style>
        <?php 
        }
        ?>
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
