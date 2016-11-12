<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $id = $_SESSION['login_id'];
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
                            Thông tin chi tiết
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="children.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Thông tin chi tiết</li>
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
                                            Thông tin tài khoản
                                        </div>
                                    <div class="panel-body">
                                            <input style="display:none" class="form-control" name="idnhanh" id="idnhanh" type="text" readonly value="<?php echo $idnhanh;?>">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Người giới thiệu:</label>
                                                    <input name="nguoidung_gioithieu" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_gioithieu'];?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label>Dưới nhánh:</label>
                                                    <input name="nguoidung_parent_id" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_parent_id'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tài khoản:</label>
                                                    <input name="nguoidung_taikhoan" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_taikhoan'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label>Cấp bậc:</label>
                                                    <input name="nguoidung_capbac" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_capbac'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ngày tạo:</label>
                                                    <input name="nguoidung_ngaytao" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_ngaytao'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Họ Tên:</label>
                                                    <input class="form-control" name="nguoidung_hoten" id="disabledInput" type="text" value="<?php echo $status['nguoidung_hoten'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label>Số điện thoại:</label>
                                                    <input name="nguoidung_sdt" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_sdt'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label>CMND:</label>
                                                    <input name="nguoidung_cmnd" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_cmnd'];  ?>" <?php if($status['nguoidung_cmnd'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input name="nguoidung_mail" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_mail'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                    
                                                </div>
                                                 <div class="form-group">
                                                    <label>Địa chỉ:</label>
                                                    <input name="nguoidung_diachi" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_diachi'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                                 <div class="form-group">
                                                    <label>Đường dẫn ví Bitcoin:</label>
                                                    <input name="nguoidung_btclink" class="form-control" id="disabledInput" type="text" value="<?php echo $status['nguoidung_btclink'];  ?>" <?php if($status['nguoidung_quyen'] != 'admin'){ echo 'disabled';} ?>>
                                                </div>
                                            </div>
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