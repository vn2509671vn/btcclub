<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php require("../models/pd-gd.php");
    $id = $_SESSION['login_id'];
    $user = userDetail($id);
    $listF1 = getF1($id);
    $countF1 = mysql_num_rows($listF1);
    if($countF1 >= 10 && $user['nguoidung_danhanthuong'] == 0 && $user['nguoidung_trangthaihoatdong'] == 'normal'){
        $isCoupon = true;
    }
    else {
        $isCoupon = false;
    }
?>
<!-- Add end models -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Bảng Điều Khiển
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <?php if($isCoupon):?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <span>PHẦN THƯỞNG: Bạn hiện có số lượng F1 từ 10 trở lên nên có thể nhận GD trị giá 150$.</span>
                            <div class="options">
                                <div class="btn-toolbar">
                            		<a class="btn btn-default <?php if($isCoupon) echo 'disabled';?>" data-toggle="modal" data-target="#<?php echo $user['nguoidung_id'];?>"><i class="fa fa-fw fa-plus"></i>Create GET Donetion (GD)</a>
                            		<div class="modal fade" id="<?php echo $user['nguoidung_id'];?>" role="dialog">
                                        <div class="modal-dialog">
                                        <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Vui lòng nhập mật mã giao dịch.</h4>
                                                    </div>
                                                        <div class="modal-body">
                                                            <input class="form-control" type="password" id="pwd2" placeholder="Your existing Security Password">
                                                        </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="createGD()">Xác nhận</button>
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
                <?php endif;?>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-credit-card fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $user['nguoidung_sotiennhan'];?></div>
                                        <div>R - WALLET</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-credit-card fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $user['nguoidung_sotienhoahong'];?></div>
                                        <div>C - WALLET</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bolt fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $user['nguoidung_sopin'];?></div>
                                        <div>PIN BALANCE</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $user['nguoidung_soluongthanhvien'];?></div>
                                        <div>DOWNLINE TREE</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Monition</h3>
                            </div>
                            <div class="panel-body">
                                <h5>
                                   <a href="#" class="title-post">Thông báo: Website chính thức mở lại.</a> 
                                </h5>
                                <p class="text-muted">17/10/2016</p>
                                <!-- Content of post -->
                                
                                <!-- End Content of post -->
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
    function createGD(){
        var pwd2 = $("#pwd2").val();
        var userid = '<?php echo $id;?>';
        $.ajax({
            url:"../models/gd.php",  
            method:"post",  
            data:{
                action: 'createGDFromCoupon',
                amount: 150,
                pass: pwd2,
                userid: userid,
                magd: 'GD<?php echo $user['nguoidung_id'].date("YmdHs");?>'
            },  
            dataType:"text",  
            success:function(data)
            {
                if(data == 0){
                    alert("Có lỗi phát sinh!!! Vui lòng liên hệ admin");
                }
                else if(data == 2){
                    alert("Mật khẩu giao dịch không chính xác!!!");
                }
                else if(data == 1){
                    window.location.replace("gd.php");
                }
            }
        })
    }
    
    selectorMenu("bangdieukhien");
</script>
