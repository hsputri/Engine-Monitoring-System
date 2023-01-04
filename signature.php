<?php
$page = 'Signature';
    // error_reporting(0);
    require_once 'model/koneksi.php';
    session_start();
    if (!isset($_SESSION['username']) && (!isset($_SESSION['level']))) {
        header("location: index");
    }
?>
<!doctype html>
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
                    <li class="breadcrumb-item active">Signature</li>
                </ul>
             <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <div id="clockbox"></div>
                </ul>
            </nav>
        </div>
        
        <!-- jQuery -->
        <script src='signature/jquery-3.0.0.js' type='text/javascript'></script>

        <!-- jSignature -->
        <script src="signature/jSignature-master/libs/jSignature.min.js"></script>
        <script src="signature/jSignature-master/libs/modernizr.js"></script>

        <!--[if lt IE 9]>
        <script type="text/javascript" src="jSignature-maste/libs/flashcanvas.js"></script>
        <![endif]-->

        <!-- jSignature -->
         <style>
            #signature{
                width: 60%;
                height: auto;
                border: 1px solid black;
            }
        </style>
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
          <!-- <section class="content-header"> -->
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
          </section>
        
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary card-outline">
                        
                        <?php
                        $username = $_SESSION['username'];
                        $stmnt = $dbh->prepare("SELECT * FROM users WHERE username = '$username' ORDER BY id DESC");
                        $stmnt->execute();
                        $row = $stmnt->fetch();
                        
                        
                        $filename = $row['img'];
                        $image = $row['base64'];
                        $pecah = explode(",", $image);
                        if ($row['img'] != null){
                            echo ' <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-pen"></i>
                                Tanda Tangan
                            </h3>
                        </div>
                            <img src="data:image/jpeg;base64,'.$hasil = $pecah[1].'"/>';
                        }else{
                            echo '<div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-pen"></i>
                                Create your sign here!
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Signature area -->
                            <div id="signature"></div><br/>
                            <input type="button" id="click" value="preview">
                            <form enctype="multipart/form-data" action="model/upload_signature.php" method="POST">
		                        <textarea id="output" name="img"></textarea><br/>
		                        <input type="submit" value="Upload" />
		                    </form>
                            <!-- Preview image -->
                            <img src="" id="sign_prev" style="display: none;" />
                        </div>';
                        }
                        
                        ?>
                    </div>
                </div>
            </section>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
              <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
    

        <!-- Script -->

	    <script>
            $(document).ready(function() {

                // Initialize jSignature
                var $sigdiv = $("#signature").jSignature({'UndoButton':true});

                $('#click').click(function(){
                    // Get response of type image
                    var data = $sigdiv.jSignature('getData', 'image');

                    // Storing in textarea
                    $('#output').val(data);
                    
                    // Alter image source
                    $('#sign_prev').attr('src',"data:"+data);
                    $('#sign_prev').show();
                });
            });
	    </script>
<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
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