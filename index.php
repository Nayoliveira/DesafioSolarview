 <?php  
 require_once 'assets/php/classInversor.php';

 $inversor = new Inversor();

 ?>
 <html>
  <head>
    <title> SolarView</title>
   
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.js">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script type="text/javascript" src="assets/js/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

      // Desenhar o gráfico

      function drawChart() {
        var dataJSON = <?php echo json_encode($inversor->index()); ?>;
        var dt = new Array();
        var linhas = new Array('Index', 'Corrente A', 'Tensão Fase AN', 'Potência AC', 'Frequência da Linha','Fator de Potência', 'Energia AC', 'Horas de Injeção', 'Corrente DC','Tensão DC','Potência DC','Corrente CC String2','Tensão CC String2','Temperatura Outro');
        dt.push(linhas);
        for(var i=0; i < 1000; i++){
            var arr = new Array(dataJSON[i]['atualizadoEm'], parseInt(dataJSON[i]['correnteFaseA']), parseInt(dataJSON[i]['tensaoFaseAN']),parseInt(dataJSON[i]['potenciaAC']),parseInt(dataJSON[i]['frequenciaDaLinha']),parseInt(dataJSON[i]['fatorDePotencia']),parseInt(dataJSON[i]['energiaAC']),parseInt(dataJSON[i]['horasInjecao']),parseInt(dataJSON[i]['correnteDC']),parseInt(dataJSON[i]['tensaoDC']),parseInt(dataJSON[i]['potenciaDC']),parseInt(dataJSON[i]['correnteCCString2']),parseInt(dataJSON[i]['tensaoCCString2']),parseInt(dataJSON[i]['temperaturaOutro']));
            dt.push(arr);
        }

        var data = google.visualization.arrayToDataTable(dt);
        var options = {
          title: "Monitoramento e gestão de sistemas fotovoltaicos SolarView",
          lineType: 'function',
          legend: {position: 'right'},
          hAxis: {
            title: 'Atualizado em',
            titleTextStyle: {
            color: '#333'
            },
            slantedText: true,
            slantedTextAngle: 80  
          }, 
          vAxis: {
            title: "Kwh",
            minValue: 0,
            dataType: 'date'
          },
          explorer: { 
            maxZoomOut: true,
            actions: ['dragToZoom', 'rightClickToReset'],
            axis: 'vertical'}
        };
        var chart = new google.charts.Line(document.getElementById('curve_chart'));
        chart.draw(data, google.charts.Line.convertOptions(options));
        var dataInicio = document.getElementById(dataInicio);
        var dataFim = document.getElementById(dataFim);  
      }
    </script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <header id="header">
            <img src="assets/images/logo.png">
          </header>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4 col-md-6 col-sm-2">
        </div>
        <div class="col-xs-4 col-md-6 col-sm-2">
          <form>
            <div class="form-group">
              <div> 
                <h5>Selecione o intervalo de data para análise:</h5>
              </div>
              <p></p>
              De <input class="form-control input-md" type="date" name="data" id="dataInicio">             
              Até <input class="form-control input-md" type="date" name="data" id="dataFim">              
            </div>
          </form>            
        </div>
        <div class="col-xs-4 col-md-6 col-sm-2">
          <p id="d"></p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-xs-4 col-md-2">
        </div>
        <div class="col-sm-6 col-xs-4 col-md-2">
          <div id="curve_chart">          
          </div> 
        </div>                         
      </div>
      <div class="row" id="footer">
        <footer class="col-md-12">
          Desenvolvido por Nayara Oliveira
        </footer>        
      </div>
      
    </div>

  </body>
</html>