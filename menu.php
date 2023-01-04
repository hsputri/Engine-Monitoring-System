<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['level'])) {
    header("location: index");
}
?>

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
        <?php
        if (($_SESSION['level'] == 'teknisi')|| ($_SESSION['level'] == 'validator')){
            echo '<li class="nav-item has-treeview">
            <a href="datatable.php" class="nav-link ';
            if ($page == 'Tabel Suhu'){
                echo 'active';
            } 
            echo '">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Tabel Suhu
                </p>
            </a>';
        }
        ?> 
        <?php
        if (($_SESSION['level'] == 'teknisi')|| ($_SESSION['level'] == 'validator')){
            echo '<li class="nav-item has-treeview">
            <a href="chart.php" class="nav-link ';
            if ($page == 'Grafik Suhu'){
                echo 'active';
            } 
            echo '">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                    Grafik Suhu
                </p>
            </a>';
        }
        ?> 
        

        <?php
        if ($_SESSION['level'] == 'teknisi'){
            echo '<li class="nav-item has-treeview">
            <a href="form.php" class="nav-link ';
            if ($page == 'Form'){
                echo 'active';
            } 
            echo '">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Forms
                </p>
            </a>';
        }
        ?> 

        <?php
        if (($_SESSION['level'] == 'teknisi')|| ($_SESSION['level'] == 'validator')){
            echo '<li class="nav-item has-treeview">
            <a href="report.php" class="nav-link ';
            if ($page == 'Report'){
                echo 'active';
            } 
            echo '">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Reports
                </p>
            </a>';
        }
        ?> 
        <?php
        if ($_SESSION['level'] == 'admin'){
            echo '<li class="nav-item has-treeview">
            <a href="usertable.php" class="nav-link ';
            if ($page == 'User Info'){
                echo 'active';
            } 
            echo '">
                <i class="nav-icon fas fa-table"></i>
                <p>
                User Information
                </p>
            </a>';
        }
        ?> 
        
        
        <li class="nav-item has-treeview">
            <a href="model/login.php?op=out" class="nav-link">
                <i class="nav-icon fas fa-circle nav-icon"></i>
                <p>
                    Log Out
                </p>
            </a>
        </li>
        <?php
        if (($_SESSION['level'] == 'teknisi')|| ($_SESSION['level'] == 'validator')){
            echo
        '<li class="nav-header">INFO</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Maintenance Schedule
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    SOP
                </p>
            </a>
        </li>';
        }
        ?>
        <?php
        if (($_SESSION['level'] == 'teknisi')||($_SESSION['level'] == 'validator')){
            echo '<li class="nav-item has-treeview">
            <a href="signature.php" class="nav-link ';
            if ($page == 'Signature'){
                echo 'active';
            } 
            echo '">
                <i class="nav-icon fas fa-pen"></i>
                <p>
                Signature
                </p>
            </a>';
        }
        ?> 
        <!-- <li class="nav-item has-treeview">
            <a href="signature/signature.php" class="nav-link">
                <i class="nav-icon fas fa-pen"></i>
                <p>
                    Signature
                </p>
            </a>
        </li> -->
                
               
                

    </ul>
</nav>
<!-- /.sidebar-menu -->