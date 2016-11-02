<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $array_id = mysql_fetch_array(getid($user_check));
    $id = $array_id[0];
    $user = danhsach();
    $rowUser = 1;
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            DANH SÁCH PD TUYẾN DƯỚI
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="member_f1.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Danh Sách PD tuyến dưới </li>
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
                            			
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <table id="table-user" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>TÀI KHOẢN PD</th>
                                                <th>TRẠNG THÁI PD</th>
                                                <th>NGÀY TẠO</th>
                                                <th>TG KẾT THÚC</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if ($rowUser == 0){?>
                                                    <tr><td colspan="8" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
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
                                                    $ds_thanhvien = substr($newString, 0, strlen($newString) - 1);
                                                    $ds_tv = thanhvien_pd($ds_thanhvien);
                                                    if($newString == false)
                                                    { ?>
                                                         <tr><td colspan="8" class="text-center">No item</td></tr>
                                                <?php }
                                                    else{
                                                    while($row = mysql_fetch_array($ds_tv)){
                                                        ?>
                                                                    <td><?php echo $iSTT;?></td>
                                                                    <td><?php echo $row['nguoidung_taikhoan'];?></td>
                                                                    <td><?php echo $row['transfer_pd_status'];?></td>
                                                                    <td><?php echo $row['transfer_ngaytao'];?></td>
                                                                    <td><?php echo $row['transfer_time_remain'];?></td>
                                                    <?php $iSTT++; } ?>
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
    selectorMenu("thanhvien");
    $('#table-user').DataTable({
        "searching": true,
        "info": true,
    });
</script>