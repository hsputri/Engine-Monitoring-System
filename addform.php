<?php
$page = 'Form';
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
    <meta charset="utf-8">
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
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
                <li class="breadcrumb-item"><a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active">Forms</li>
                <li class="breadcrumb-item active">Tambah Form</li>
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
                <?php include 'menu.php'; ?>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm" style="text-align:center">
                            <h1>Lembar Pengetesan Model Engine</h1>
                        </div>
                    </div>
                </div>
                <!--/.container-fluid-->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="post" action="model/addform.php">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>No. LTG</label>
                                                    <input type="text" name="ltg" class="form-control" placeholder="No. LTG">
                                                </div>
                                                <div class="form-group">
                                                    <label>Dipo</label>
                                                    <input type="text" name="dipo" class="form-control" placeholder="Dipo">
                                                </div>
                                                <div class="form-group">
                                                    <label>Sifat Perawatan</label>
                                                    <input type="text" name="sifat_perawatan" class="form-control" placeholder="Sifat Perawatan">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>Sifat Perawatan</label>
                                                    <select class="form-control" name="sifat_perawatan" data-placeholder="Pilih Sifat Perawatan">
                                                        <option value="">---Pilih Sifat Perawatan---</option>
                                                        <option value="1">Preventive Maintenance</option>
                                                        <option value="2">Periodic Maintenance</option>
                                                        <option value="3">Predictive Maintenance</option>
                                                        <option value="4">Corrective Maintenance</option>
                                                    </select>
                                                </div> -->

                                                <!-- select -->
                                                <div class="form-group">
                                                    <label>Jenis Kereta</label>
                                                    <select class="form-control" name="jenis_kereta">
                                                        <option>---Pilih Jenis Kereta---</option>
                                                        <option>P</option>
                                                        <option>MP</option>
                                                        <option>KMP</option>
                                                        <option>KP</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>No. Seri Kereta</label>
                                                    <input type="text" name="seri_kereta" class="form-control" placeholder="No. Seri Kereta">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>No. Genset</label>
                                                    <input type="text" name="nogenset" class="form-control" placeholder="No. Genset">
                                                </div>

                                                <div class="form-group">
                                                    <label>Type Genset</label>
                                                    <input type="text" name="typegenset" class="form-control" placeholder="Type Genset">
                                                </div>

                                                <div class="form-group">
                                                    <label>Tanggal Masuk BYMRI</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="text" name="tgl_masuk" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->
                                                <div class="form-group">
                                                    <label>Tanggal Test</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="text" name="tgl_test" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->
                                                <!-- time Picker -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="bootstrap-timepicker">
                                                          <div class="form-group">
                                                            <label>Waktu Mulai</label>

                                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                              <input type="text" name= "waktu_mulai" class="form-control datetimepicker-input" data-target="#timepicker"/>
                                                              <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                              </div>
                                                              </div>
                                                            <!-- /.input group -->
                                                          </div>
                                                          <!-- /.form group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="bootstrap-timepicker">
                                                            <div class="form-group">
                                                              <label>Waktu Selesai</label>

                                                              <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                                                <input type="text" name= "waktu_selesai" class="form-control datetimepicker-input" data-target="#timepicker2"/>
                                                                <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                                </div>
                                                                </div>
                                                              <!-- /.input group -->
                                                            </div>
                                                            <!-- /.form group -->
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="simpan_form" value="simpan" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col (right) -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
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
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

    <script>
        $(function() {
            //Datemask2 mm/dd/yyyy
            $('[data-mask]').inputmask('yyyy/mm/dd', {
                'placeholder': 'yyyy/mm/dd'
            })
            //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker1
    $('#timepicker').datetimepicker({
        format: 'HH:mm'
    })
    //Timepicker2
    $('#timepicker2').datetimepicker({
        format: 'HH:mm'
    })
    

        })

        function GetClock() {
            var d = new Date();
            var nmonth = d.getMonth(),
                ndate = d.getDate(),
                nyear = d.getFullYear();
            var nhour = d.getHours(),
                nmin = d.getMinutes(),
                nsec = d.getSeconds(),
                ap;

            if (nhour == 0) {
                ap = " AM";
                nhour = 12;
            } else if (nhour < 12) {
                ap = " AM";
            } else if (nhour == 12) {
                ap = " PM";
            } else if (nhour > 12) {
                ap = " PM";
                nhour -= 12;
            }

            if (nmin <= 9) nmin = "0" + nmin;
            if (nsec <= 9) nsec = "0" + nsec;

            var clocktext = "" + ndate + "/" + (nmonth + 1) + "/" + nyear + " " + nhour + ":" + nmin + ":" + nsec + ap + "";
            document.getElementById('clockbox').innerHTML = clocktext;
        }

        GetClock();
        setInterval(GetClock, 1000);
    </script>
</body>

</html>
