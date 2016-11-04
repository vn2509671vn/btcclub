<!-- Add start Header-->
<?php require("../header.php");
    require("../models/pd_new.php");
    require("../models/pd-gd_new.php");
?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $array_id = mysql_fetch_array(getid($user_check));
    $id = $array_id[0];
    $status = sttaccount($id);
    $lstStatus = $status[0];
    $user  = danhsach();
    
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
                            Quản lí pin
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="member.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Quản lí Pin</li>
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
                                            Chuyển Pin
                                        </div>
                                    <div class="panel-body">
                                            <input style="display:none" class="form-control" name="id" id="id" type="text" readonly value="<?php echo $id;?>">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Dưới nhánh:</label>
                                                    <select name="nguoidung_parent_id" id="nguoidung_parent_id" class="form-control">
                                                        <?php
                                                            $new_array = array();
                                                            while ($row = mysql_fetch_array($user)) 
                                                                {
                                                                    $new_array[$row['nguoidung_id']]['nguoidung_id'] = $row['nguoidung_id'];
                                                                    $new_array[$row['nguoidung_id']]['nguoidung_taikhoan'] = $row['nguoidung_taikhoan'];
                                                                    $new_array[$row['nguoidung_id']]['nguoidung_parent_id'] = $row['nguoidung_parent_id'];
                                                                }
                                                            $newString = nhanhcon($new_array, $id, $newString);
                                                            $newString = trim($newString);
                                                            $ds = explode(',',$newString);
                                                            for($i=0; $i < count($ds)-1;$i++){
                                                                $dem = $ds[$i];
                                                                $k = getparent(intval($dem));
                                                                $tem = mysql_num_rows($k);
                                                                    $ds_nhanh = sttaccount(intval($dem)); ?>
                                                                    <option value="<?php echo $ds_nhanh['nguoidung_id']; ?>"><?php echo $ds_nhanh['nguoidung_taikhoan'] . ' ('. ' ' . $ds_nhanh['nguoidung_hoten'] .')'; ?></option>
                                                                <?php }
                                                                ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Số Pin:</label>
                                                    <select id="amount"  name="amount" class="form-control">
                                                        <?php
                                                        $i=5;
                                                        while($i <= 20){ ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php $i += 5;} ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Mật khẩu giao dịch:</label>
                                                    <input id="nguoidung_matkhaugd"  name="nguoidung_matkhaugd" class="form-control" type="password" required placeholder ="Vui lòng nhập mật khẩu giao dịch.">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nội dung chuyển:</label>
                                                    <textarea id="pin_user_description" name="pin_user_description" class="form-control" type="textarea" required rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <button class="btn btn-primary"  id="chuyenpin">
                                                    Chuyển Pin
                                                </button>
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
    selectorMenu("pin");
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
    
    
    
    $(document).ready(function() {
        $('#chuyenpin').click(function(){
            var amount = $('#amount').val();
            var gioithieu = $('#nguoidung_parent_id').val();
            var noidung = $('#pin_user_description').val();
            var mk = $('#nguoidung_matkhaugd').val();
            var mk_nguoichuyen = '<?php echo $status['nguoidung_matkhaugd']; ?>';
            var sopin_chuyen = '<?php echo $status["nguoidung_sopin"]; ?>';
            var isAutoPD = false;
            if(parseInt(amount) < parseInt(sopin_chuyen)){
                $.ajax({
                    url:"../models/transfer_pin.php", 
                    method:"post",  
                    data:{
                        action: 'create',
                        idchuyen: '<?php echo $id;?>',
                        gioithieu: gioithieu,
                        amount: amount,
                        sopinchuyen: '<?php echo $status["nguoidung_sopin"]; ?>',
                        mk: mk,
                        noidung: noidung
                    },
                    dataType:"text",  
                    success:function(data)  
                    {
                        if(data == 1){
                            alert("Giao dich pin thanh cong");
                            isAutoPD = true;
                        }
                        else if(data == 0){
                            alert("Chứng thực giao dịch mật khẩu giao dịch thất bại. ");
                        }
                        else{
                            alert("Giao dich khong thanh cong");
                        }
                    }
                }).done(function(){
                        if(isAutoPD){
                            $.ajax({
                                url:"../models/pd_new.php", 
                                method:"post",  
                                data:{
                                    action: 'create',
                                    id: gioithieu,
                                    mapd: 'PD<?php echo $status['nguoidung_parent_id'].date("YmdHs");?>'
                                },  
                                dataType:"text",  
                                success:function(data)  
                                {
                                    if(data==1){
                                        alert("Giao dịch thành công! Đã kích hoạt lệnh PD.");
                                    }
                                }  
                            });
                        }
                    });
                }
                else{
                    alert( "So pin cua ban khong du de giao dich");
                }
        });
    });
</script>