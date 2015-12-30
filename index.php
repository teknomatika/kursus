<!DOCTYPE html>
<?php session_start();
include '_db.php';
$db = new Database();
$db->connect();

if(isset($_SESSION['level'])){
    eksyen('','admin/');
}

if(isset($_POST['username'])){
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $md5pass = md5($password);

    $db->select('users','*',NULL,"email='$username' and password='$md5pass'");
    $data = $db->getResult();

    if($data){
        $_SESSION['nama'] = $data[0]['nama'];
        $_SESSION['id'] = $data[0]['id'];
        switch ($data[0]['level']) {
            case 'Admin':
                $_SESSION['level'] = 'Admin';
                break;

            case 'Direktur':
                $_SESSION['level'] = 'Direktur';
                break;

            case 'Pegawai':
                $_SESSION['level'] = 'Pegawai';
                break;
            
            default:
                unset($_SESSION['nama']);
                unset($_SESSION['id']);
                unset($_SESSION['level']);
                break;
        }
        $db->update('users',array('login'=>wkt(),'logged'=>'1'),"email='$username'");
        eksyen('Selamat datang, '. $data[0]['nama'].' sebagai '.$data[0]['level'],'admin/');
    }else{
        eksyen('User tidak ditemukan','');
    }
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - <?=TITLE;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login <small>Halaman ini terbatas</small></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!--div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div-->
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-success btn-block btn-lg">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>