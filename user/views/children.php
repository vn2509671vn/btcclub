<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    $userID = $_SESSION['login_id'];
    $arrChild = array();
    $arrChild = getChild($userID, $arrChild);
    $countChild = count($arrChild);
    if(!$arrChild || $countChild == 0){
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
                            Quản Lí Thành Viên
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
                                                <th>ACCOUNT</th>
                                                <th>STATUS</th>
                                                <th>CREATE DATE</th>
                                                <th>BTC LINK</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if ($rowList == 0){?>
                                                    <tr><td colspan="5" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
                                                <?php foreach ($arrChild as $user){?>
                                                <tr>
                                                    <td><?php echo $iSTT;?></td>
                                                    <td><?php echo $user['nguoidung_taikhoan'];?></td>
                                                    <td><span class="label text-uppercase <?php echo $user['nguoidung_trangthaihoatdong'];?>"><?php echo $user['nguoidung_trangthaihoatdong'];?></span></td>
                                                    <td><?php echo $user['nguoidung_ngaytao'];?></td>
                                                    <td><?php echo $user['nguoidung_btclink'];?></td>
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
    selectorMenu("children");
    $('#table-user').DataTable({
        "searching": true,
        "info": true,
    });
</script>