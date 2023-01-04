<?php
    $page = "Table Monitoring";
    // error_reporting(0);
    require_once 'koneksi.php';
?>
<html>
    <head>
        <title>Halaman Table Monitoring</title>
        <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>

<body>
<!-- <img src="pnj.jpg" class="rounded float-left" alt="left">
<img src="..." class="rounded float-right" alt="..."> -->
    <center>
    <h2>Engine Monitoring System</h2>
    <h5>PT KERETA API INDONESIA</h5>

    <nav class="navbar navbar-expand-lg navbar navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-weight:bold;">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="tabel.php">Table Monitoring <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="grafik.php">Trend Temperature</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="report.php">Report</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Log Out</a>
            </li>
          </ul>
        </div>
    <div id="clockbox"></div>
      </nav>

<table id="myTable"border="1"class="table"style="width:50%">
    <thead>
    <tr>
        <th><center>No</center></th>
        <th><center>Tanggal/Waktu</center></th>
        <th><center>Nilai Suhu (Celcius)</center></th>
    </tr>
    </thead>
    </center>
    <tbody>
    <?php
    $no=1;
    $query = mysqli_query ($conn, "SELECT * FROM engine");
    while ($data = mysqli_fetch_array($query)){
    ?>
    <tr>
        <td><center><?php echo $no++; ?></center></td>
        <td><center><?php echo $data ['waktu']; ?></center></td>
        <td><center><?php echo $data ['datasensor']; ?></center></td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
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
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>