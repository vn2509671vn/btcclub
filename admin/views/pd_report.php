<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $array_id = mysql_fetch_array(getid($user_check));
    $id = $array_id[0];
    $user = get_pd_report();
    $rowUser = 1;
    if(!$user || mysql_num_rows($user) == 0){
        $rowUser = 0;
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
                            Quản Lí PD Reports
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="member_f1.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Quản lý PD Reports </li>
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
                            			<!--<a href="register.php" class="btn btn-default"><i class="fa fa-fw fa-plus"></i>Tạo người dùng mới</a>-->
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <table id="table-user" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>ID</th>
                                                <th>FULL NAME</th>
                                                <th>PHONE</th>
                                                <th>ĐỊA CHỈ VÍ</th>
                                                <th>DATE CREATE</th>
                                                <th>DATE FINISHED</th>
                                                <th>TRANSACTION HASH</th>
                                                <th>PD STATUS</th>
                                                <th>FREEZE</th>
                                                <th>LOCK</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if ($rowUser == 0){?>
                                                    <tr><td colspan="8" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
                                                <?php while($listUser = mysql_fetch_array($user)){?>
                                                <tr>
                                                    <td><?php echo $iSTT;?></td>
                                                    <td><?php echo $listUser['nguoidung_taikhoan'];?></td>
                                                    <td><?php echo $listUser['nguoidung_hoten'];?></td>
                                                    <td><?php echo $listUser['nguoidung_sdt'];?></td>
                                                    <td><?php echo $listUser['nguoidung_btclink'];?></td>
                                                    <td><?php echo $listUser['transfer_ngaytao'];?></td>
                                                    <td><?php echo $listUser['transfer_time_remain'];?></td>
                                                    <td><?php echo $listUser['transfer_magd'];?></td>
                                                    <td><?php echo $listUser['transfer_pd_status'];?></td>
                                                    <input style="display:none" class="form-control" name="id" id="giatri<?php echo $listUser['nguoidung_id'] ?>" type="text" readonly value="<?php echo $listUser['nguoidung_trangthaihoatdong'];?>">
                                                    <td id="<?php echo $listUser['nguoidung_id']?>" class="ngung">
                                                        <button <?php if($listUser['nguoidung_trangthaihoatdong'] == 'lock') echo 'disabled'; ?> type="button" id="ngung<?php echo $listUser['nguoidung_id'] ?>" class="btn btn-sm btn-warning" class="ngung<?php echo $listUser['nguoidung_id'] ?>">
                                                            <?php if( $listUser['nguoidung_trangthaihoatdong']== 'normal') {echo 'Normal';} else if ($listUser['nguoidung_trangthaihoatdong']== 'freeze') { echo 'UnFeezed';} else {echo '---';}?>
                                                        </button>
                                                    </td>
                                                    <td id="<?php echo $listUser['nguoidung_id']?>" class="khoa">
                                                        <button <?php if($listUser['nguoidung_trangthaihoatdong'] == 'freeze') echo 'disabled'; ?> type="button" id="khoa<?php echo $listUser['nguoidung_id'] ?>" class="btn btn-sm btn-danger" class="khoa<?php echo $listUser['nguoidung_id'] ?>">
                                                            <?php if( $listUser['nguoidung_trangthaihoatdong']== 'normal') {echo 'Normal';} else if ($listUser['nguoidung_trangthaihoatdong']== 'freeze') { echo '---';} else {echo 'UnLock';}?>
                                                        </button>
                                                    </td>
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
    selectorMenu("tv_report");
    $('#table-user').DataTable({
        "searching": true,
        "info": true,
    });
    $(document).ready(function() {
       $('.ngung').click(function(){
            var id = $(this).attr("id");
            var ngung = 'ngung' + id;
            var giatristatus = 'giatri' + id;
            var $this = $(this).children('button');
            var giatri = document.getElementById(giatristatus).value;
            if(giatri == 'normal'){
                $.ajax({
                    url:"../models/update_status_user.php", 
                    method:"post",  
                    data:{
                        action: 'freeze',
                        id: id
                    },
                    dataType:"text",  
                    success:function(data)  
                    {
                        if(data == 1){
                            $this.text("UnFreezed");
                            $('#khoa'+id).text("---");
                            document.getElementById(giatristatus).value="freeze";
                        }
                        else{
                            $this.text('Normal');
                        }
                    }
                });
            }
            else{
                $.ajax({
                    url:"../models/update_status_user.php", 
                    method:"post",  
                    data:{
                        action: 'normal',
                        id: id
                    },
                    dataType:"text",  
                    success:function(data)  
                    {
                        if(data == 1){
                            $this.text("Normal");
                            document.getElementById(giatristatus).value="normal";
                        }
                        else{
                            $this.text('UnFreezed');
                        }
                    }
                });
            }
        });
        $('.khoa').click(function(){
            var id = $(this).attr("id");
            var ngung = 'khoa' + id;
            var giatristatus = 'giatri' + id;
            var $this = $(this).children('button');
            var giatri = document.getElementById(giatristatus).value;
            if(giatri == 'normal'){
                $.ajax({
                    url:"../models/update_status_user.php", 
                    method:"post",  
                    data:{
                        action: 'lock',
                        id: id
                    },
                    dataType:"text",  
                    success:function(data)  
                    {
                        if(data == 1){
                            $this.text("UnLock");
                            $('#ngung'+id).text("---");
                            document.getElementById(giatristatus).value="lock";
                        }
                        else{
                            $this.text('Normal');
                        }
                    }
                });
            }
            else{
                $.ajax({
                    url:"../models/update_status_user.php", 
                    method:"post",  
                    data:{
                        action: 'normal',
                        id: id
                    },
                    dataType:"text",  
                    success:function(data)  
                    {
                        if(data == 1){
                            $this.text("Normal");
                            document.getElementById(giatristatus).value="normal";
                        }
                        else{
                            $this.text('UnLock');
                        }
                    }
                });
            }
        });
    });
</script>