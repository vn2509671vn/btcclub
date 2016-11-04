<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $array_id = mysql_fetch_array(getid($user_check));
    $id = $array_id[0];
    $status = sttaccount($id);
    $lstStatus = $status[0];
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">
                <input style="display:none" class="form-control" id="status" type="text" readonly value="<?php echo strtolower($lstStatus);?>">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Đăng Kí Thành Viên
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="member.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Đổi mật khẩu</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="options">
                            		<div class="btn-toolbar">
                            			<div id="dis"></div>
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                                <div id="xulystatus" class="panel panel-default" style="display:none">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            Thông tin Mật khẩu
                                        </div>
                                        <div class="form-group">
                                                    <label>Tài khoản:</label>
                                                    <input name="nguoidung_taikhoan" class="form-control" id="disabledInput" type="text" placeholder="<?php echo $status['nguoidung_taikhoan'];  ?>" disabled="">
                                                </div>
                                    <div class="panel-body">
                                        <form role="form" method='post' id='emp-UpdateForm' action='#'>
                                            <input style="display:none" class="form-control" name="id" id="id" type="text" readonly value="<?php echo $id;?>">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Mật khẩu đăng nhập:</label>
                                                    <input  name="nguoidung_matkhaudn" class="form-control" type="password"  placeholder ="Vui lòng nhập mật khẩu đăng nhập.">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nhập lại mật khẩu đăng nhập:</label>
                                                    <input  name="nguoidung_matkhaudn_repeat" class="form-control" type="password"  placeholder ="Vui lòng nhập lại mật khẩu đăng nhập.">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Mật khẩu giao dịch:</label>
                                                    <input  name="nguoidung_matkhaugd" class="form-control" type="password"  placeholder ="Vui lòng nhập mật khẩu giao dịch.">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nhập lại mật khẩu giao dịch:</label>
                                                    <input  name="nguoidung_matkhaugd_repeat" class="form-control" type="password"  placeholder ="Vui lòng nhập lại mật khẩu giao dịch.">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <button type="submit" class="btn btn-primary" name="btn-update" id="btn-update">
                                                    Lưu tài khoản
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
<script type="text/javascript">
    selectorMenu("thongtin");
    var status =$('#status').val();
    window.onload = function()
    {
        if(status == 'clock'){
            $("#xulystatus").fadeOut('slow', function()
			 {
				$("#xulystatus").fadeIn('slow');
				$("#xulystatus").show();
				$("#xulystatus").html('<div class="alert alert-danger" id="error_login">' +
                                            '<a href="#" class="close" data-dismiss="alert">×</a>' +
                                            '<strong>Error :</strong>' + 
                                            '<div> Tài khoản của ban đã bị đóng băng. Vui lòng liên hệ Admin để được mở khoá. </div>' + 
                                      '</div>');
			});
        }
        else{
            $("#xulystatus").show();
        }
    };
</script>