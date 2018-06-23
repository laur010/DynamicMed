

<script type="text/javascript">

  // Morris bar chart
  function initBarChart() {

    var data_chart_1 = <?php echo json_encode($chart_1)?>;

    Morris.Bar({
      element: 'chart_1',
      data: data_chart_1,
      xkey: 'label',
      ykeys: ['pozitiv', 'negativ'],
      labels: ['Pozitiv', 'Negativ'],
      barColors: ['#7cb5ec', '#fac89d'],
      hideHover: 'auto',
      gridLineColor: '#b7b7b7',
      resize: true

    });
  }
  // Morris donut chart
  function initDonutChart() {
    var data_chart_2 = <?php echo json_encode($chart_2)?>;
    Morris.Donut({
      element: 'chart_2',
      data: [{
        label: "Masculin",
        value: data_chart_2[0]

      }, {
        label: "Feminin",
        value: data_chart_2[1]
      }],

      resize: true,
      colors: ['#7cb5ec', '#fab2c0']
    });
  }
  function MorrisLineChart(){
    var data_chart_3 = <?php echo json_encode($chart_3)?>;
    var line = new Morris.Line({
      element: 'chart_3',
      resize: true,
      data: data_chart_3,
      xkey: 'label',
      ykeys: ['number'],
      labels: ['Pacienti Internati'],
      gridLineColor: '#eef0f2',
      lineColors: ['#a3a4a9'],
      lineWidth: 1,
      hideHover: 'auto'
    });
  }
  $(function () {

  });

  function getChartJs(type) {
    var config = null;

    if (type === 'line') {
      config = {
        type: 'line',
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "My First dataset",
            data: [28, 32, 39, 37, 42, 55, 50],
            borderColor: 'rgba(102,165,226, 0.2)',
            backgroundColor: 'rgba(102,165,226, 0.7)',
            pointBorderColor: 'rgba(102,165,226, 0.5)',
            pointBackgroundColor: 'rgba(102,165,226, 0.2)',
            pointBorderWidth: 1
          }, {
            label: "My Second dataset",
            data: [40, 48, 50, 48, 63, 62, 71],
            borderColor: 'rgba(140,147,154, 0.2)',
            backgroundColor: 'rgba(140,147,154, 0.2)',
            pointBorderColor: 'rgba(140,147,154, 0)',
            pointBackgroundColor: 'rgba(140,147,154, 0.9)',
            pointBorderWidth: 1
          }]
        },
        options: {
          responsive: true,
          legend: false

        }
      }
    }
    else if (type === 'bar') {
      var data_chart_4 = <?php echo json_encode($chart_4)?>;
      var labels = [];
      var under = [];
      var good = [];
      var over = [];
      for (var i=0;i<data_chart_4.length;i++){
        labels.push(data_chart_4[i]['label']);
        under.push(data_chart_4[i]['under']);
        good.push(data_chart_4[i]['good']);
        over.push(data_chart_4[i]['over']);
      }
      config = {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: "Sub Limita",
            data: under,
            backgroundColor: '#7cb5ec',
            strokeColor: "rgba(255,118,118,0.1)"
          }, {
            label: "In Limita",
            data: good,
            backgroundColor: '#fac89d',
            strokeColor: "rgba(255,118,118,0.1)"
          },
            {
              label: "Peste Limita",
              data: over,
              backgroundColor: '#fab2c0',
              strokeColor: "rgba(255,118,118,0.1)"
            }]
        },
        options: {
          responsive: true,
          legend: false
        }
      }
    }
    else if (type === 'radar') {
      var data_chart_5 = <?php echo json_encode($chart_5)?>;
      var radar_labels = [];
      var data_set_1 = [];
      var data_set_2 = [];
      for (var i=0;i<data_chart_5.length;i++){
        radar_labels.push(data_chart_5[i]['label']);
        data_set_1.push(data_chart_5[i]['data_set_1']);
        data_set_2.push(data_chart_5[i]['data_set_2']);
      }
      config = {
        type: 'radar',
        data: {
          labels: radar_labels,
          datasets: [{
            label: "Urgente",
            data: data_set_1,
            borderColor: 'rgba(102,165,226, 0.8)',
            backgroundColor: 'rgba(102,165,226, 0.5)',
            pointBorderColor: 'rgba(102,165,226, 0)',
            pointBackgroundColor: 'rgba(102,165,226, 0.8)',
            pointBorderWidth: 1
          }, {
            label: "Trimitere Medic Fam.",
            data: data_set_2,
            borderColor: 'rgba(140,147,154, 0.8)',
            backgroundColor: 'rgba(140,147,154, 0.5)',
            pointBorderColor: 'rgba(140,147,154, 0)',
            pointBackgroundColor: 'rgba(140,147,154, 0.8)',
            pointBorderWidth: 1
          }]
        },
        options: {
          responsive: true,
          legend: false
        }
      }
    }
    else if (type === 'pie') {
      config = {
        type: 'pie',
        data: {
          datasets: [{
            data: [150, 53, 121, 87, 45],
            backgroundColor: [
              "#2a8ceb",
              "#58a3eb",
              "#6fa6db",
              "#86b8e8",
              "#9dc7f0"
            ]
          }],
          labels: [
            "Pia A",
            "Pia B",
            "Pia C",
            "Pia D",
            "Pia E"
          ]
        },
        options: {
          responsive: true,
          legend: false
        }
      }
    }
    return config;
  }
  jQuery(document).ready(function(){
    initBarChart();
    initDonutChart();
    MorrisLineChart();
    new Chart(document.getElementById("chart_4").getContext("2d"), getChartJs('bar'));
    new Chart(document.getElementById("chart_5").getContext("2d"), getChartJs('radar'));
  });
</script>

<section class="content home">
  <div class="container-fluid">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <h2 style="text-align: center;">GRAFICE
            <small class="text-muted"></small>
          </h2>
        </div>
      </div>
    </div>

    <div class="row clearfix">

      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>Hemoleucogramă</strong></h2>
          </div>
          <div class="body">
            <canvas id="chart_4"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-6 col-lg-6 col-xs-12">
        <div class="card">
          <div class="header">
            <h2><strong>Sexul M/F</strong></h2>
          </div>
          <div class="body">
            <div id="chart_2"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-xs-12">
        <div class="card">
          <div class="header">
            <h2><strong>Grupa Sangvina</strong></h2>
          </div>
          <div class="body">
            <div id="chart_1" class="graph"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">

    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="header">
            <h2><strong>Incidență Internări Lunare</strong></h2>
          </div>
          <div class="body">
            <canvas id="chart_5" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-12 col-lg-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2><strong>Incidență Internări Anuale</strong></h2>
          </div>
          <div class="body">
            <div id="chart_3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- Main Content -->
<section class="content home">

</section>