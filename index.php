<?php require_once('config/koneksi.php'); 
    if(!isset($_SESSION[md5('admin')])){
        pesan('login.php','');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Penilaian Kinerja SMA Muhammadyah.</title>
    
    <link rel="shortcut icon" href="assets/images/icon.png"/>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <!-- Morris Charts CSS -->

    <!-- Custom Fonts -->
    
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/summernote/dist/summernote.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
    <link href="assets/plugins/morrisjs/morris.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="assets/css/sb-admin.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SMA Muhammadyah</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= get_user(); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?p=pengguna&ket=ubah&id=<?= $_SESSION[md5('admin')]; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="login.php?logout=true"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="home">
                        <a href="index.php"><i class="fa fa-fw fa-home"></i> Beranda</a>
                    </li>
                    <?php if(get_hak_akses()==0){ ?>
                    <li id="guru">
                        <a href="index.php?p=guru"><i class="fa fa-fw fa-graduation-cap"></i> Guru</a>
                    </li>
                    <li id="periode">
                        <a href="index.php?p=periode"><i class="fa fa-fw fa-calendar"></i> Periode</a>
                    </li>
                    <li id="kategori">
                        <a href="index.php?p=kategori"><i class="glyphicon glyphicon-saved"></i>  Kategori Penilaian</a>
                    </li>
                    <li id="pertanyaan">
                        <a href="index.php?p=pertanyaan"><i class="fa fa-fw fa-newspaper-o"></i>  Pertayaan dan Penyataan</a>
                    </li>
                    <?php } ?>
                    <?php if(get_hak_akses()==1 || get_hak_akses()==2 || get_hak_akses()==3){ ?>
                    <li id="penilaian">
                        <a href="index.php?p=penilaian"><i class="glyphicon glyphicon-edit"></i>  Penilaian</a>
                    </li>
                    <li id="lap_penilaian">
                        <a href="javascript:;" data-toggle="collapse" data-target="#men-lap"><i class="glyphicon glyphicon-list-alt"></i>  Laporan Penilaian <b class="caret "></b></a>
                        <ul id="men-lap" class="collapse">
                            <li><a href="index.php?p=lap_penilaian"><i class="fa fa-fw fa-th-list"></i> Keseluruhan</a></li>
                            <li><a href="index.php?p=lap_penilaian_guru"><i class="fa fa-fw fa-user"></i> Per-Guru</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if(get_hak_akses()==0){ ?>
                    <li id="pengguna">
                        <a href="index.php?p=pengguna"><i class="fa fa-fw fa-user"></i>  Pengguna</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php
                   
                    if(isset($_GET['p'])){
                        $dir = 'pages';
                        $page = $_GET['p'].'.php';
                        $hal = scandir($dir);
                        if(in_array($page, $hal)){
                            include $dir.'/'.$page;
                        }else{
                            echo 'NOT FOUND';
                        }
                    }else{
                        include 'pages/home.php';
                    }
                ?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.id.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.id.js"></script>
    <script type="text/javascript" src="assets/plugins/summernote/dist/summernote.js"></script>
    <script type="text/javascript" src="assets/plugins/raphael/raphael.min.js"></script>
    <script type="text/javascript" src="assets/plugins/morrisjs/morris.min.js"></script>
    <script type="text/javascript" src="assets/js/link.js"></script>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.summernote').summernote({
                height: 450
            });

        });
        $(document).ready(function(){
            $('.tgl').datepicker({
                format: "yyyy-mm-dd",
                language: "id",
                autoclose: true
            });
            $('.tgltime').datetimepicker({
                format: "yyyy-mm-dd hh:ii",
                language: "id",
                autoclose: true
            });
        });
    </script>

</body>

</html>
