<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $id = $_SESSION['login_id'];
    $user = danhsach_f1($id);
    $rowUser = false;
    if($user && mysql_num_rows($user) != 0){
        $rowUser = true;
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
                            Quản Lí Cây F1
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="member_f1.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Quản lý F1 </li>
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
                            			<a href="register.php" class="btn btn-default"><i class="fa fa-fw fa-plus"></i>Tạo người dùng mới</a>
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
                                                <th>EMAIL</th>
                                                <th>PHONE</th>
                                                <th>CẤP BẬT</th>
                                                <th>DATE CREATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if ($rowUser == false){?>
                                                    <tr><td colspan="8" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
                                                <?php while($listUser = mysql_fetch_array($user)){?>
                                                <tr>
                                                    <td><?php echo $iSTT;?></td>
                                                    <td><?php echo $listUser['nguoidung_taikhoan'];?></td>
                                                    <td><?php echo $listUser['nguoidung_hoten'];?></td>
                                                    <td><?php echo $listUser['nguoidung_mail'];?></td>
                                                    <td><?php echo $listUser['nguoidung_sdt'];?></td>
                                                    <td><?php echo $listUser['nguoidung_capbac'];?></td>
                                                    <td><?php echo $listUser['nguoidung_ngaytao'];?></td>
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
    selectorMenu("member_f1");
    $('#table-user').DataTable({
        "searching": true,
        "info": true,
    });
</script>