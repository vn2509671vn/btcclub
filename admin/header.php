<?php
    include('../models/session.php');
?>
<!-- Add start nag-->
<?php require("../nag.php");?>
<!-- Add end nag-->

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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge pull-right">42</span><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge pull-right">42</span><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_check; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="info.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" id="btnthoat" type="submit" name="remove_levels_h"><i class="fa fa-fw fa-power-off" > </i>Logout</a>
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
                    <li id="matching-auto">
                        <a href="matching-auto.php"><i class="fa fa-fw fa-cloud-download"></i> Khớp lệnh AUTO</a>
                    </li>
                    <li id="matching-num">
                        <a href="matching-num.php"><i class="fa fa-fw fa-cloud-download"></i> Khớp lệnh Thủ Công</a>
                    </li>
                    <li id="pin">
                        <a href="transfer_pin.php"><i class="fa fa-fw fa-bolt"></i> Quản lý PIN</a>
                    </li>
                    <li id="register">
                        <a href="register.php"><i class="fa fa-fw fa-plus-square"></i> Đăng ký thành viên mới</a>
                    </li>
                    <li id="member_f1">
                        <a href="member_f1.php"><i class="fa fa-fw fa-users"></i> Quản lý F1</a>
                    </li>
                    <li id="tree_member">
                        <a href="f1.php"><i class="fa fa-fw fa-share-alt fa-rotate-90"></i> Quản lí Cây F1</a>
                    </li>
                    <li id="member">
                        <a href="member.php"><i class="fa fa-fw fa-user"></i> Quản lý thành viên</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#thongtin"><i class="fa fa-fw fa-user"></i> Thông tin cá nhân <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="thongtin" class="collapse">
                            <li id="info">
                                <a href="info.php">Thông tin chi tiết</a>
                            </li>
                            <li>
                                <a href="thongtin_giaodich.php">Thông tin giao dịch</a>
                            </li>
                            <li>
                                <a href="matkhau.php">Đổi mật khẩu</a>
                            </li>
                        </ul>
                    </li>
                    <li id="logout">
                        <!--<a href="#" id="btnDelete" type="submit" name="remove_levels"><i class='fa fa-fw fa-sign-out'> </i>Thoát</a>-->
                        <a href="#" id="btnlogout" type="submit" name="remove_levels"><i class="fa fa-fw fa-sign-out" > </i>Thoát</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>