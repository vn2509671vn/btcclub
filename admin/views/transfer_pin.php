<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $array_id = mysql_fetch_array(getid($user_check));
    $id = $array_id[0];
    $tranferPin = getlichsupin($id);
    $rowUser = 1;
    if(!$tranferPin || mysql_num_rows($tranferPin) == 0){
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
                            Lịch sử giao dịch Pin
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="member_f1.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Lịch sử giao dịch pin </li>
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
                            			<a href="pin.php" class="btn btn-default"><i class="fa fa-fw fa-plus"></i>Giao dịch Pin</a>
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <table id="table-user" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>LOẠI GIAO DỊCH</th>
                                                <th>SỐ LƯỢNG (PIN)</th>
                                                <th>MÔ TẢ HỆ THỐNG</th>
                                                <th>MÔ TẢ NGƯỜI DÙNG</th>
                                                <th>NGÀY TẠO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if ($rowUser == 0){?>
                                                    <tr><td colspan="8" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
                                                <?php while($lstPin = mysql_fetch_array($tranferPin)){?>
                                                <tr>
                                                    <td><?php echo $iSTT;?></td>
                                                    <td><?php echo $lstPin['pin_transaction_type'];?></td>
                                                    <td><?php echo $lstPin['pin_giatri'];?></td>
                                                    <td><?php echo $lstPin['pin_system_description'];?></td>
                                                    <td><?php echo $lstPin['pin_user_description'];?></td>
                                                    <td><?php echo $lstPin['pin_ngaytao'];?></td>
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
    selectorMenu("pin");
    $('#table-user').DataTable({
        "searching": true,
        "info": true,
    });
</script>