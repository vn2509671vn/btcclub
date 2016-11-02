<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/commission.php");
    $id = $_SESSION['login_id'];
    $getCommission = getCommissionList($id);
    if(!$getCommission || mysql_num_rows($getCommission) == 0){
        $numRows = 0;
    }
    else {
        $numRows = 1;
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
                            Lịch sử nhận hoa hồng
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li class="active">Lịch sử giao dịch pin </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <table id="table-commission" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NGÀY TẠO</th>
                                                <th>MÔ TẢ</th>
                                                <th>HOA HỒNG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if ($numRows == 0){?>
                                                    <tr><td colspan="4" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
                                                <?php while($commissionItem = mysql_fetch_array($getCommission)){?>
                                                <tr>
                                                    <td><?php echo $iSTT;?></td>
                                                    <td><?php echo $commissionItem['commission_date'];?></td>
                                                    <td><?php echo $commissionItem['commission_descript'];?></td>
                                                    <td><?php echo $commissionItem['commission_value'];?></td>
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
    $('#table-commission').DataTable({
        "searching": true,
        "info": true,
    });
</script>