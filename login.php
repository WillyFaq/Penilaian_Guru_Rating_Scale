<?php 
    require_once('config/koneksi.php'); 
    if(isset($_GET['logout'])){
        $_SESSION[md5('admin')] = '';
        unset($_SESSION[md5('admin')]);
        pesan('index.php', '');
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

    <title>Login | Penilaian Kinerja SMA Muhammadyah.</title>
    
    <link rel="shortcut icon" href="assets/images/icon.png"/>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <style>
        body{
            background:#F5F5F5;
        }

        .login_box{
            margin-top: 150px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 login_box">
                <?php
                    if(isset($_POST['btnlogin'])){
                        $username = mysql_real_escape_string(htmlspecialchars($_POST['username']));
                        $password = mysql_real_escape_string(htmlspecialchars($_POST['password']));

                        $q = mysql_query("SELECT * FROM pengguna WHERE username = '$username' AND password = '$password' ");
                        if(mysql_num_rows($q)>0){
                            $row = mysql_fetch_array($q);
                            $_SESSION[md5('admin')] = $row['username'];
                ?>
                        <script type="text/javascript">
                            alert('Login Berhasil!');
                            document.location = 'index.php';
                        </script>
                <?php
                        }else{
                ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Login Gagal!</strong> username/password salah!
                        </div>
                <?php
                        }
                    }
                ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-key"></i> Login
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit" name="btnlogin" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>
