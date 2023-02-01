@extends('layouts.main' , ['activePage' => 'graficos', 'titlePage => Gráficos'])

@section ('content')
 <div class="content">
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title ">Visualización de gráficos</h4>
              </div>
              <div class="card-body">
                <div id="container">
                </div> 
                <script src="https://code.highcharts.com/highcharts.js"></script>
              <script src="https://code.highcharts.com/modules/data.js"></script>
              <script src="https://code.highcharts.com/modules/drilldown.js"></script>
              <script src="https://code.highcharts.com/modules/exporting.js"></script>
              <script src="https://code.highcharts.com/modules/export-data.js"></script>
              <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                <script>
                Highcharts.chart('container', {
                lang: {
                downloadCSV:"Descargar CSV",
                downloadXLS:"Descargar Excel",         
                viewFullscreen:"Ver en pantalla completa",
                printChart:"Imprimir gráfico",
                downloadPNG:"Descargar imagen PNG",
                downloadJPEG:"Descargar imagen JPEG",
                downloadPDF:"Descargar PDF",
                downloadSVG:"Descargar imagen vectorial SVG",
                viewData:"Ver tabla de datos",  
                },
                credits: {
                enabled: false
                },
                title: {
                text: 'Evolución del alumno <?= $alumno?> en <?= $espacio?>'
                },
                xAxis: {
                lineWidth: 0, 
                minorGridLineWidth: 0,
                title:{
                text: 'Años escolares'
                },
                categories: <?= $añoscolegio ?>
                },
                yAxis: {
                tickmarkPlacement:'on',
                title:{
                text: 'Calificaciones',
                },
                categories: <?= $califi ?>,
                },
                <?php
                if($periodo=='Trimestre'){?>
                series: [{
                type: 'column',
                name: <?= $per1 ?>,
                data: <?= $data1 ?>
                },{
                type: 'column',
                name: <?= $per2 ?>,
                data: <?= $data2 ?>
                },{
                type: 'column',
                name: <?= $per3 ?>,
                data: <?= $data3 ?>
                },{
                type: 'spline',
                name: 'Promedio',
                data: <?= $califpromedio ?>,
                marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'orange'
                }
                },]
                <?php
                }
                ?>
                <?php
                if($periodo=='Bimestre'){?>
                series: [{
                type: 'column',
                name: <?= $per1 ?>,
                data: <?= $data1 ?>
                },{
                type: 'column',
                name: <?= $per2 ?>,
                data: <?= $data2 ?>
                },{
                type: 'column',
                name: <?= $per3 ?>,
                data: <?= $data3 ?>
                },{
                type: 'column',
                name: <?= $per4 ?>,
                data: <?= $data4 ?>
                },{
                type: 'spline',
                name: 'Promedio',
                data: <?= $califpromedio ?>,
                marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'orange'
                }
                },]
                <?php
                }
                ?>
                <?php
                if($periodo=='Cuatrimestre'){?>
                series: [{
                type: 'column',
                name: <?= $per1 ?>,
                data: <?= $data1 ?>
                },{
                type: 'column',
                name: <?= $per2 ?>,
                data: <?= $data2 ?>
                },{
                type: 'spline',
                name: 'Promedio',
                data: <?= $califpromedio ?>,
                marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'orange'
                }
                },]
                <?php
                }
                ?>
                <?php
                if($periodo=='Semestre'){?>
                series: [{
                type: 'column',
                name: <?= $per1 ?>,
                data: <?= $data1 ?>
                },{
                type: 'column',
                name: <?= $per2 ?>,
                data: <?= $data2 ?>
                },{
                type: 'spline',
                name: 'Promedio',
                data: <?= $califpromedio ?>,
                marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'orange'
                }
                },]
                <?php
                }
                ?>
                });
                </script>
              
            </div>
            <a class="btn btn-sm btn-default" onclick="back()"><i class="material-icons">arrow_back</i></a>
                <script type="text/javascript">
                 function back(){
                history.back();
                }
                </script>
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
</div>
@endsection