<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>laundry | Dashboard</title>

<!-- head css + js -->
<?php $this->load->view("template/head");?>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  
  <!-- nav bar -->
<?php $this->load->view("template/navbar");?>

<!-- side bar -->
<?php $this->load->view("kios/sidebar-mkios");?>
  
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <!-- heading -->

      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Transaksi Bulanan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Keuangan Bulanan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="keuangan" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Jenis Laundry</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="pieChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

        </div>

        <div class="col-md-6"> 
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pegawai</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
     <!-- Isi -->
     <p id="test"></p>

    </section>
  </div>
  <!-- footer -->
  <?php $this->load->view("template/footer");?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php $this->load->view("template/jsfile");?>


<script src="<?php echo base_url('assets/adminlte/bower_components/chart.js/Chart.js')?>"></script>

<script>

  /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data
  
    var data_bulanan;

    var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
    // var areaChartCanvas=document.getElementById("areaChart").getContext('2d');
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas);

    
      var areaChartData = {
        labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','Agustus','September','Oktober','November','Desember'],
        datasets: [
          {
            label               : 'Transaksi',
            fillColor           : 'rgba(60,141,188,0.9)',
            // strokeColor         : 'rgba(60,141,188,0.8)',
            // pointColor          : '#3b8bba',
            // pointStrokeColor    : 'rgba(60,141,188,1)',
            // pointHighlightFill  : '#fff',
            // pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [3,4,5,2,7,6,3]
          }]
      }

     

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }
    

    var link="<?php echo site_url('Mkios/data_bulanan/')?>";
    $.get(link,function(result){
              
              areaChartData.datasets[0].data=JSON.parse(result);
              console.log(areaChartData.datasets[0].data);
              areaChart.Line(areaChartData, areaChartOptions);
              // areaChart.update();

            });


    var grafikkeuangan = $('#keuangan').get(0).getContext('2d');
    // var areaChartCanvas=document.getElementById("areaChart").getContext('2d');
    // This will get the first returned node in the jQuery collection.
    var keuangan       = new Chart(grafikkeuangan);

    
      var datakeuangan = {
        labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','Agustus','September','Oktober','November','Desember'],
        datasets: [
          {
            label               : 'Pemasukan',
            fillColor           : 'rgba(0, 175, 239,0.5)',
            data                : []
          },
          {
            label               : 'Pengeluaran',
            fillColor           : 'rgba(236, 50, 83,0.5)',
            data                : [1000000,500000,2000000,500000,200000,1000000,0,0]
          },
          ]
      }

    var keuanganlink="<?php echo site_url('Mkios/data_keuangan/')?>";
    $.get(keuanganlink,function(result){
              
              var data=JSON.parse(result);
              
              datakeuangan.datasets[0].data=data.pemasukan;
              console.log("keu :"+datakeuangan.datasets[0].data);
              keuangan.Line(datakeuangan, areaChartOptions);
              // areaChart.update();

            });


    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    

     var pielink="<?php echo site_url('Mkios/data_jenis_laundry/')?>";
    $.get(pielink,function(result){
              console.log(JSON.parse(result));
              pieChart.Doughnut(JSON.parse(result), pieOptions)
              // areaChart.update();
            });




    var barChartCanvas                   = $('#barChart').get(0).getContext('2d');
    var barChart                         = new Chart(barChartCanvas);
  
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false;
    

     var datapegawai = {
        labels  : ['A','B','C'],
        datasets: [
          {
            label               : 'Terima',
            fillColor           : '#4abdac',
            data                : []
          },
          {
            label               : 'Kasir',
            fillColor           : '#ec3253',
            data                : []
          },
          {
            label               : 'Strika',
            fillColor           : '#00afef',
            data                : []
          }
        ]
      }
      var userlink="<?php echo site_url('Mkios/get_data_pegawai/')?>";
    $.get(userlink,function(result){
        var users=JSON.parse(result);
        console.log(users);
        var label=Object.keys(users);
        datapegawai.labels=label;
        for (var i = 0; i < label.length; i++) {
          var item=users[label[i]];
          datapegawai.datasets[0].data[i]=item.terima;
          datapegawai.datasets[1].data[i]=item.kasir;
          datapegawai.datasets[2].data[i]=item.strika;
        }
        console.log(datapegawai);
        barChart.Bar(datapegawai, barChartOptions);

    });


    
  


</script>


</body>
</html>
