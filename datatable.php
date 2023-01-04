<?php
$page = 'Tabel Suhu';
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
	
<meta charset="utf-8" http-equiv="refresh" content=120>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Engine Monitoring System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
              <li class="breadcrumb-item active">Table Suhu</li>
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
            <h1>Engine Monitoring System</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
    <tr style="text-align:center">
        <th>No</th>
        <th>Tanggal/Waktu</th>
        <th>Suhu (Celcius)</th>
        <th>Status</th>
        <?php
        if ($_SESSION['level'] == 'teknisi'){
          echo '<th>Operator</th>';
        }
        ?>
        
    </tr>
    </thead>
    
    <tbody style="text-align:center">
    <?php
    $no=1;    
    $query = "SELECT users.nama, 
    users.nipp, 
    `engine`.idsuhu,
    `engine`.idsuhu, 
    `engine`.waktu, 
    `engine`.datasensor
  FROM
    `engine`
    LEFT JOIN
    users
    ON 
      `engine`.operator = users.id
      ORDER BY waktu DESC";
    $stmnt = $dbh->prepare($query);
    $stmnt->execute();
    while ($data = $stmnt->fetch()){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $data ['waktu']; ?></td>
        <td><?php echo $data ['datasensor']; ?></td>
        <?php
        if ($data ['datasensor']>=80.0){
            echo '<td><button type="button" class="btn btn-block btn-danger btn-sm">overheat</button></td>';
        }
        else{
            echo '<td><button type="button" class="btn btn-block btn-success btn-sm">normal</button></td>';
        }
        ?>
        
        <?php
        if ($_SESSION['level'] == 'teknisi'){
          if ($data['nama'] != null){
            echo '<td>'.$data['nama']. '-' .$data['nipp'].'</td>';
          }else{
            echo '<td><a href="model/action.php?id='.$data['idsuhu'].'"><input type="button" value="not ack"/></a></td>';
          }
          
          // echo '<td><button type="submit" formaction="model/action.php" name="ack" class="">not ack</button></td>';
        }
        
        ?>

    </tr>
    <?php
    }
    ?>
    </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
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
