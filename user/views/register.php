<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    class userInfo
    {
        public $label;
        public $value;
        public $id;
    }
    
    require("../models/member_f1.php");
    $id = $_SESSION['login_id'];
    $user = danhsach();
    $status = sttaccount($id);
    $lstStatus = $status[0];
    
    // Data for autocomplete
    $new_array = array();
    $dataAutocomplete = array();
    $classUser = new userInfo();
    while ($row = mysql_fetch_array($user)) 
        {
            $new_array[$row['nguoidung_id']]['nguoidung_id'] = $row['nguoidung_id'];
            $new_array[$row['nguoidung_id']]['nguoidung_taikhoan'] = $row['nguoidung_taikhoan'];
            $new_array[$row['nguoidung_id']]['nguoidung_parent_id'] = $row['nguoidung_parent_id'];
        }
    $newString = pathparent($new_array, $id, $newString);
    $newString = str_replace('<ul></ul>', '', $newString);
    $newString = trim($newString);
    $ds = explode(',',$newString);
    $parent = getparent($id);
    $numparent = mysql_num_rows($parent);
    if($numparent != 2 ){
        $ds_nhanh_parent = sttaccount($id);
        $classUser->id = $ds_nhanh_parent['nguoidung_id'];
        $classUser->value = $ds_nhanh_parent['nguoidung_taikhoan'];
        $classUser->label = $ds_nhanh_parent['nguoidung_taikhoan'];
        array_push($dataAutocomplete,$classUser);
    }
    for($i=0; $i < count($ds)-1;$i++){
        $tmpUser = new userInfo();
        $dem = $ds[$i];
        $k = getparent(intval($dem));
        $tem = mysql_num_rows($k);
        if($tem < 2){
            $ds_nhanh = sttaccount(intval($dem));
            $tmpUser->id = $ds_nhanh['nguoidung_id'];
            $tmpUser->value = $ds_nhanh['nguoidung_taikhoan'];
            $tmpUser->label = $ds_nhanh['nguoidung_taikhoan'];
            array_push($dataAutocomplete,$tmpUser);
        }
    }
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
                                <li class="active">Đăng kí thành viên</li>
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
                                        <form role="form" method='post' id='emp-SaveForm' action="#">
                                            <input style="display:none" class="form-control" name="idnhanh" id="idnhanh" type="text" readonly value="<?php echo $idnhanh;?>">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Người giới thiệu:</label>
                                                    <select name="nguoidung_gioithieu"  class="form-control">
                                                        <option value="<?php echo $id; ?>"><?php echo $status['nguoidung_taikhoan']; ?></option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>ID Quản lí:</label>
                                                    <input type="text" class="form-control" required id="autocomplete" placeholder="Nhập tài khoản cần gắn">
                                                    <input type="hidden" name="nguoidung_parent_id" class="form-control" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tài khoản:</label>
                                                    <input  name="nguoidung_taikhoan" class="form-control" type="text" required value="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Mật khẩu đăng nhập:</label>
                                                    <input  name="nguoidung_matkhaudn" class="form-control" type="password" required placeholder ="Mật khẩu phải lớn hơn 6 kí tự.">
                                                </div>
                                                <div class="form-group">
                                                    <label>Mật khẩu giao dịch:</label>
                                                    <input  name="nguoidung_matkhaugd" class="form-control" type="password" required placeholder ="Mật khẩu phải lớn hơn 6 kí tự.">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Họ Tên:</label>
                                                    <input name="nguoidung_hoten" required class="form-control" type="text">
                                                </div>
                                                 <div class="form-group">
                                                    <label>Số điện thoại:</label>
                                                    <input type="number" name="nguoidung_sdt" required class="form-control" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input name="nguoidung_mail" required class="form-control" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Địa chỉ:</label>
                                                    <input name="nguoidung_diachi" required class="form-control" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Số CMND:</label>
                                                    <input name="nguoidung_cmnd" required class="form-control" type="number">
                                                </div>
                                                 <div class="form-group">
                                                    <label>Địa chỉ ví Bitcoin:</label>
                                                    <input name="nguoidung_btclink" required class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <button type="submit" class="btn btn-primary" name="btn-save" id="btn-save">
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
    $(document).ready(function(){
        var srcData = <?php echo json_encode($dataAutocomplete);?>;
        var managementID;
        $('#autocomplete').autocomplete({
            source: srcData,
            select: function(event, ui) {
                managementID = ui.item.id;
                $('input[name="nguoidung_parent_id"]').attr("value",managementID);
            }
        });
    })
    
    selectorMenu("register");
    var status =$('#status').val();
    window.onload = function()
    {
        if(status == 'freeze'){
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