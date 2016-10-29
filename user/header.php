<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nguoi Dung BTC Club</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../css/user.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <script src="../js/function.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    
    <!-- Plugin for datatable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.bootstrap.js"></script>
</head>
<?php 
    require('../../config.php');
    require('../models/user.php');
    session_start();
    $_SESSION['login_id'] = "13";
    $id = $_SESSION['login_id'];
    $userDetail = thongtinchitiet($id);
?>
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
                <a class="navbar-brand" href="../views/index.php">BTC CLub</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li>
                    <a href="#"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userDetail['nguoidung_hoten'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="bangdieukhien">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Bảng điều khiển</a>
                    </li>
                    <li id="pd">
                        <a href="pd.php"><i class="fa fa-fw fa-cloud-upload"></i> Quản lý lệnh PD</a>
                    </li>
                    <li id="gd">
                        <a href="gd.php"><i class="fa fa-fw fa-cloud-download"></i> Quản lý lệnh GD</a>
                    </li>
                    <li id="pin">
                        <a href="pin.php"><i class="fa fa-fw fa-bolt"></i> Quản lý PIN</a>
                    </li>
                    <li id="register">
                        <a href="register.php"><i class="fa fa-fw fa-plus-square"></i> Đăng ký thành viên mới</a>
                    </li>
                    <li id="member_f1">
                        <a href="member_f1.php"><i class="fa fa-fw fa-users"></i> Quản lý F1</a>
                    </li>
                    <li id="tree_member">
                        <a href="tree_member.php"><i class="fa fa-fw fa-share-alt fa-rotate-90"></i> Quản lý thành viên</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#thongtin"><i class="fa fa-fw fa-user"></i> Thông tin cá nhân <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="thongtin" class="collapse">
                            <li id="info">
                                <a href="info.php">Thông tin chi tiết</a>
                            </li>
                            <li>
                                <a href="#">Thông tin giao dịch</a>
                            </li>
                            <li>
                                <a href="#">Đổi mật khẩu đăng nhập</a>
                            </li>
                            <li>
                                <a href="#">Đổi mật khẩu giao dịch</a>
                            </li>
                        </ul>
                    </li>
                    <li id="logout">
                        <a href="#"><i class="fa fa-fw fa-sign-out"></i> Thoát</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>