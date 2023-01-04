<?php
$page = 'User Info';
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
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
                <li class="breadcrumb-item active">User Information</li>
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
                            <h1>User Information</h1>
                        </div>
                        <div class="col-sm-6" style="text-align:right">
                            <a href="#!" class="btn btn-flat btn-primary pull-right" data-toggle="modal" data-target="#modal-primary">
                                <i class="fa fa-plus"></i> Add User
                            </a>
                        </div>
                    </div>
                </div>
                <!--/.container-fluid-->
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
                                            <th>NIPP</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody style="text-align:center">
                                    
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
        <!-- update user -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" id="user-edit" action="model/update.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">NIPP</label>
                                <input type="text" name= "nipp" class="form-control" placeholder="Enter NIPP">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <select type="text" name="divisi" class="form-control" placeholder="---Pilih Jabatan---">
                                <option >---Pilih Jabatan---</option>
                                <option >Admin</option>
                                <option >Assman Final Test</option>
                                <option >Assman Listrik Kereta</option>
                                <option >SPV Final Test Safety</option>
                                <option >SPV Kereta 4</option>
                                <option >JS Final Test Safety</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email</label>
                              <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <!-- <div class="form-group">
                                <label>Tipe</label>
                                <select class="form-control satker" name="type" style="width: 100%;" data-placeholder="-- Pilih Satuan Kerja --">
                                </select>
                                <input type="hidden" name="type"/>
                            </div> -->
                        </div>
                        <input type="hidden" name="id"/>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--.modal -->

        
    <!-- add user -->
    <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
            <div class="modal-content bg-primary">
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="model/register.php">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">NIPP</label>
                                <input type="text" class="form-control" name="nipp" id="exampleInputEmail1" placeholder="Enter NIPP">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <select type="text" name="divisi" class="form-control" placeholder="---Pilih Jabatan---">
                                <option >---Pilih Jabatan---</option>
                                <option >Admin</option>
                                <option >Assman Final Test</option>
                                <option >Assman Listrik Kereta</option>
                                <option >SPV Final Test Safety</option>
                                <option >SPV Kereta 4</option>
                                <option >JS Final Test Safety</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tipe Pengguna</label>
                                <select type="text" name="tipe" class="form-control">
                                <option>---Pilih Tipe Pengguna---</option>
                                <option>Admin</option>
                                <option>Teknisi</option>
                                <option>Validator</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email</label>
                              <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <!-- <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div> -->
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" name="hak_akses" class="btn btn-default">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

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
    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                ajax: 'model/feeds/users.php'
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

        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $('.swalDefaultSuccess').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Menghapus'
                })
            });
        });
    </script>

    <script type="text/javascript">
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
        // update
        $(document).on("click", ".edit-user", function () {
            var userid = $(this).data('id');
            $.ajax({
                url:`./model/feeds/detail_user.php?id=${userid}`,
                type: 'get',
                success: function(res){
                    var result = JSON.parse(res).data
                    $('#user-edit [name="id"]').val(result[0])
                    $('#user-edit [name="nipp"]').val(result[1]);
                    $('#user-edit [name="nama"]').val(result[2]);
                    $('#user-edit [name="divisi"]').val(result[3]);
                    $('#user-edit [name="email"]').val(result[4]);
                    $('#user-edit [name="type"]').val(result[5]);
                    $.ajax({
                        url: 'model/feeds/list_satker_by_id.php?id='+result[16],
                        type: 'get',
                        success: function (value) {
                            var data = JSON.parse(value)
                            $('#form-edit .satker').html('<option value=""></option>')
                            for (i in data) {
                                $('#form-edit .satker').append(
                                    '<option value="' + data[i].id + '">' + data[i].satker + '</option>'
                                )
                            }
                            $('#form-edit [name="satuan_kerja"]').val(result[16]).trigger('change')
                        },
                        error: function (res) {
                            console.log(res)
                        }
                    })
                }
            })
        });
        // delete
        $(document).on("click", ".delete-user", function () {
            var userid = $(this).data('id');
            $.ajax({
                data: "idu=" + userid,
                cache: false,
                dataType: 'html',
                success: function(data) {
                    var x;
                    if (confirm("Anda yakin ingin menghapus?") == true) {
                        x = window.location.replace("model/delete.php?idu="+ userid);
                    } 
                }
            })
        });
    </script>
</body>

</html>
