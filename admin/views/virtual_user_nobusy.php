<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/user.php");
    $getList = getVirtualUserNotBusy();
    if(!$getList || mysql_num_rows($getList) == 0){
        $rowList = 0;
    }
    else {
        $rowList = 1;
    }
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Quản Lí Tài Khoản Ảo - FREE
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!--<div class="panel-heading">-->
                            <!--    <div class="options">-->
                            <!--		<div class="btn-toolbar">-->
                            <!--			<a href="#" class="btn btn-default"><i class="fa fa-fw fa-plus"></i>Tạo người dùng mới</a>-->
                            <!--		</div>-->
                            <!--	</div>-->
                            <!--</div>-->
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <table id="table-user" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>ACCOUNT ID</th>
                                                <th>BTC Link</th>
                                                <th>EMAIL</th>
                                                <th>R-WALLET</th>
                                                <th>C-WALLET</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if ($rowList == 0){?>
                                                    <tr><td colspan="7" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
                                                <?php while($User = mysql_fetch_array($getList)){?>
                                                <tr>
                                                    <td><?php echo $iSTT;?></td>
                                                    <td><?php echo $User['nguoidung_taikhoan'];?></td>
                                                    <td><?php echo $User['nguoidung_btclink'];?></td>
                                                    <td><?php echo $User['nguoidung_mail'];?></td>
                                                    <td><?php echo $User['nguoidung_sotiennhan'];?></td>
                                                    <td><?php echo $User['nguoidung_sotienhoahong'];?></td>
                                                    <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dg<?php echo $User['nguoidung_id'];?>">Create GD</button></td>
                                                        <div class="modal fade" id="dg<?php echo $User['nguoidung_id'];?>" role="dialog">
                                                            <div class="modal-dialog">
                                                              <!-- Modal content-->
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <h4 class="modal-title">Vui lòng nhập số R-Wallet cần rút.</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <select class="form-control" id="FF<?php echo $iSTT+$User['nguoidung_id'];?>">
                                                                    <option>50</option>
                                                                    <option>100</option>
                                                                    <option>150</option>
                                                                    <option>200</option>
                                                                    <option>250</option>
                                                                    <option>300</option>
                                                                    <option>350</option>
                                                                    <option>400</option>
                                                                    <option>450</option>
                                                                    <option>500</option>
                                                                  </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="createGD('FF<?php echo $iSTT+$User['nguoidung_id'];?>','<?php echo $User['nguoidung_id'];?>')">Xác nhận</button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    <?php $iSTT++;?>
                                                </tr>
                                                <?php }?>
                                            <?php }?>
                                        </tbody>
                                    </table>
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
    function createGD(element, userID){
        var r_wallet = $('#'+element).val();
        var userID = userID;
        $.ajax({
                url:"../models/user.php", 
                method:"post",  
                data:{
                    action: 'createGD',
                    userID: userID,
                    magd: 'GD'+userID+'<?php echo date("YmdHs");?>',
                    wallet: r_wallet
                },  
                dataType:"text",  
                success:function(data)  
                {  
                    if(data){
                        window.location.replace("virtual_user_waiting.php");
                    }
                    else {
                        alert("Có lỗi phát sinh!!! Vui lòng liên hệ admin");
                    }
                }  
            });
    }
    selectorMenu("virtual-user-nobusy");
    $('#table-user').DataTable({
        "searching": true,
        "info": true,
    });
</script>