<!DOCTYPE html>
<?php session_start();
include '../_db.php';

if(!isset($_SESSION['level'])){
    eksyen('','../');
}

$db = new Database();
$db->connect();
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrasi - <?=TITLE;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../bower_components/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?=TITLE;?> ||  <?=$_SESSION['level'];?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?=$_SESSION['nama'];?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?p=profil"><i class="fa fa-user fa-fw"></i> Ubah Profil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php include 'menu.php';?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php 
                    if(isset($_GET['p'])){
                        if(file_exists($_GET['p'].'.php')){
                            include $_GET['p'].'.php';
                        }else{
                            eksyen('Halaman tidak ditemukan','index.php');
                        }
                    }else{
                    ?>
                    <h1>Admin Panel</h1>
                    <?php } ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Just Number -->
    <script src="../js/isNumber.js"></script>

    <script>
    $(document).ready(function() {
        $('#tbl,#tbl2,#tbl3').DataTable({
                responsive: true
        });

        $( "#datepicker" ).datepicker({
            changeYear: true,
            changeMonth: true,
            dateFormat:"yy-mm-dd"
        });

        // js kode kelas
        var kodekelas = [
            <?php
            $db = new Database();
            $db->connect();
            $db->select('kelas','kode'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
            $res = $db->getResult();
            foreach ($res as $d) {
                echo "\"".$d['kode']."\",";
            }
            ?>
        ];
        $("#kodekelas").autocomplete({
            source: kodekelas
        });

        // js asal sekolah
        var namakelas = [
            <?php
            $db = new Database();
            $db->connect();
            $db->select('kelas','nama'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
            $res = $db->getResult();
            foreach ($res as $d) {
                echo "\"".$d['nama']."\",";
            }
            ?>
        ];
        $("#namakelas").autocomplete({
            source: namakelas
        });

        // js asal sekolah
        var asalsekolah = [
            <?php
            $db = new Database();
            $db->connect();
            $db->select('siswa','sekolah'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
            $res = $db->getResult();
            foreach ($res as $d) {
                echo "\"".$d['sekolah']."\",";
            }
            ?>
        ];
        $("#inputSekolah").autocomplete({
            source: asalsekolah
        });

        // js PTN
        var ptn = [
            <?php
            $db = new Database();
            $db->connect();
            $db->select('ptn','nama'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
            $res = $db->getResult();
            foreach ($res as $d) {
                echo "\"".$d['nama']."\",";
            }
            ?>
        ];
        $("#inputPtn1,#inputPtn2,#inputPtn3").autocomplete({
            source: ptn
        });

        // js job ortu
        var jobs = [
            <?php
            $db = new Database();
            $db->connect();
            $db->select('siswa','kerjaortu'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
            $res = $db->getResult();
            foreach ($res as $d) {
                echo "\"".$d['kerjaortu']."\",";
            }
            ?>
        ];
        $("#inputPekerjaan").autocomplete({
            source: jobs
        });

        // js kodepos
        var kodepos = [
            <?php
            $db = new Database();
            $db->connect();
            $db->select('siswa','kodepos'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
            $res = $db->getResult();
            foreach ($res as $d) {
                echo "\"".$d['kodepos']."\",";
            }
            ?>
        ];
        $("#inputKodepos").autocomplete({
            source: kodepos
        });
    });
    </script>

</body>

</html>