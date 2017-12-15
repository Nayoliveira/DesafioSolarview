<script type="text/javascript">

      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

      // Define the chart to be drawn.

      function drawChart() {
        var dataJSON = <?php echo json_encode($inversor->index()); ?>;
        //console.log(JSON.stringify(dataJSON));
        // var dt = JSON.parse(dataJSON);
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
            // gridLines:{count:2}
          },
          explorer: { 
            actions: ['dragToZoom', 'rightClickToReset'],
            axis: 'horizont'}
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart'));

        chart.draw(data, google.charts.Line.convertOptions(options));
        // document.visualization.Line('').onchange = function(){
        //   options['vAxis']['format'] = this.value; 
        // }

        var dataInicio = document.getElementById(dataInicio);
        var dataFim = document.getElementById(dataFim); 
        function mostrarValor() {
            document.getElementById("d").innerHTML = dataInicio;
        }



      }
    </script>