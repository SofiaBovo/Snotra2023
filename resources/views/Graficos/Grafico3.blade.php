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
                <a class="btn btn-sm btn-default" onclick="back()"><i class="material-icons">arrow_back</i></a>
                <script type="text/javascript">
                 function back(){
                history.back();
                }
                </script>
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
                title: {
                text: 'Promedio de valoraciones de {{$grado}} durante el año {{$año}}'
                },
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
                yAxis: {
                title: {
                text: 'Valoraciones'
                },
                categories: <?= $califi ?>,
                },
                xAxis: {
                title: {
                text: 'Espacios curriculares'
                },
                categories: <?= $espaciocurricular ?>
                },
                legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
                },
                <?php
                if($periodo=='Trimestre'){?>
                series: [{
                name: <?= $periodo1 ?>,
                data: <?= $data1 ?>,
                }, {
                name: <?= $periodo2 ?>,
                data: <?= $data2 ?>,
                }, {
                name: <?= $periodo3 ?>,
                data: <?= $data3 ?>,
                },],
                <?php 
                }
                ?>
                <?php
                if($periodo=='Semestre'){?>
                series: [{
                name: <?= $periodo1 ?>,
                data: <?= $data1 ?>,
                }, {
                name: <?= $periodo2 ?>,
                data: <?= $data2 ?>,
                },],
                <?php 
                }
                ?>
                <?php
                if($periodo=='Cuatrimestre'){?>
                series: [{
                name: <?= $periodo1 ?>,
                data: <?= $data1 ?>,
                }, {
                name: <?= $periodo2 ?>,
                data: <?= $data2 ?>,
                },],
                <?php 
                }
                ?>
                <?php
                if($periodo=='Bimestre'){?>
                series: [{
                name: <?= $periodo1 ?>,
                data: <?= $data1 ?>,
                }, {
                name: <?= $periodo2 ?>,
                data: <?= $data2 ?>,
                }, {
                name: <?= $periodo3 ?>,
                data: <?= $data3 ?>,
                },{
                name: <?= $periodo4 ?>,
                data: <?= $data4 ?>,
                },],
                <?php 
                }
                ?>
                responsive: {
                rules: [{
                condition: {
                maxWidth: 500
                },
                }]
                }
                });
                </script>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
 </div>
</div>
@endsection