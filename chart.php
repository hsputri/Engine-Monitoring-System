<?php
$page = 'Grafik Suhu';
    // error_reporting(0);
    require_once 'model/koneksi.php';
    session_start();
    if (!isset($_SESSION['username']) && (!isset($_SESSION['level']))) {
        header("location: index");
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" >
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Engine Monitoring System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- high chart -->
  <link rel="stylesheet" type="text/css" href="https://www.highcharts.com/media/com_demo/css/highslide.css" />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Charts</li>
    </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <div id="clockbox"></div>
</ul>
</nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <!-- <img src="img/pnj.png"> -->
      <img src="img/pnj.png"
           class="brand-image img-circle"
          style="">  
      <span class="brand-text font-weight-bold">EMS PT KAI</span>
    </a>

     <!-- Sidebar -->
     <div class="sidebar">

      <!-- Sidebar Menu -->
      <?php
      include 'menu.php';
      ?>
      </div>
      <!-- /.sidebar -->
   </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- interactive chart -->
            <div class="card card-primary card-outline">
               <div class="card-header">
                 <h3 class="card-title">
                   <i class="fas fa-chart-line"></i>
                     Engine Monitoring System
                 </h3>
               </div>
               <div class="card-body">
                <figure class="highcharts-figure">
                   <div id="container"></div>
                   <p class="highcharts-description">
                       
                   </p>
                 </figure>
               </div>
             </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
   

  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot-old/jquery.flot.pie.min.js"></script>

<!-- high chart -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script type="text/javascript" >
Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'GRAFIK SUHU ENGINE'
    },
    subtitle: {
        text: 'Source: suhuengine.epizy.com'
    },
    xAxis: {
      <?php
      $stmnt = $dbh->prepare("SELECT DATE_FORMAT(`engine`.waktu, '%T') AS waktu FROM `engine`
    WHERE
      `engine`.waktu >= CURRENT_DATE");
      $stmnt->execute();
      
      try{
        $waktu = array();
        $i=0;
        while($row = $stmnt->fetch()){
            $waktu[$i] = $row['waktu'];
            $i++;
        }
        echo '"categories": ' . json_encode($waktu) . '';
    }catch(Exception $ex){
        echo $ex->getMessage();
    }
    ?>
    },
    yAxis: {
        title: {
            text: 'Temperature ( °C )'
        },
        labels: {
            formatter: function () {
                return this.value + '°';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: '',
        marker: {
            symbol: 'square'
        },
        <?php
      $stmnt = $dbh->prepare("SELECT `engine`.datasensor FROM `engine`
    WHERE
      `engine`.waktu >= CURRENT_DATE");
      $stmnt->execute();
      
      try{
        $output = array();
        $i=0;
        while($row = $stmnt->fetch()){
            $output[$i] = floatval($row['datasensor']);
            $i++;
        }
        echo 'data: ' . json_encode($output) . '';
    }catch(Exception $ex){
        echo $ex->getMessage();
    }
    ?>
        // data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, {
        //     y: 26.5,
        //     marker: {
        //         symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'
        //     }
        // }, 23.3, 18.3, 13.9, 9.6]

    }]
});
</script>

<!-- Page script -->


<script type="text/javascript">
function GetClock(){
var d=new Date();
var nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getFullYear();
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}

if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;

var clocktext=""+ndate+"/"+(nmonth+1)+"/"+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
document.getElementById('clockbox').innerHTML=clocktext;
}

GetClock();
setInterval(GetClock,1000);
</script>
</body>
</html>