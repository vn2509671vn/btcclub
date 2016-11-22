<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/transfer-report.php");
    $getList = getListTransferWaiting();
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
                            Quản lý giao dịch
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <table id="table-user" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>TRANSFER ID</th>
                                                <th>CREATE DATE</th>
												<th>USER PD</th>
                                                <th>PD STATUS</th>
												<th>USER GD</th>
                                                <th>GD STATUS</th>
                                                <th>TRANSFER STATUS</th>
                                                <th>FINISH DATE</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if ($rowList == 0){?>
                                                    <tr><td colspan="7" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
                                                <?php while($detailTransfer = mysql_fetch_array($getList)){?>
                                                <tr>
                                                    <td><?php echo $iSTT;?></td>
                                                    <td><?php echo $detailTransfer['transfer_id'];?></td>
                                                    <td><?php echo $detailTransfer['transfer_ngaytao'];?></td>
                                                    <td><?php echo $detailTransfer['PDName'];?></td>
                                                    <td><span class="label text-uppercase <?php echo $detailTransfer['transfer_pd_status'];?>"><?php echo $detailTransfer['transfer_pd_status'];?></span></td>
                                                    <td><?php echo $detailTransfer['GDName'];?></td>
                                                    <td><span class="label text-uppercase <?php echo $detailTransfer['transfer_gd_status'];?>"><?php echo $detailTransfer['transfer_gd_status'];?></span></td>
                                                    <td><span class="label text-uppercase <?php echo $detailTransfer['transfer_status'];?>"><?php echo $detailTransfer['transfer_status'];?></span></td>
                                                    <td><?php echo $detailTransfer['transfer_time_remain'];?></td>
                                                    <td><button type="button" class="btn btn-info btn-sm" onclick="
                                                    proceed(
                                                        <?php echo $detailTransfer['transfer_mapd_id'];?>,
                                                        '<?php echo $detailTransfer['transfer_pd_status'];?>',
                                                        <?php echo $detailTransfer['transfer_magd_id'];?>,
                                                        '<?php echo $detailTransfer['transfer_gd_status'];?>',
                                                        <?php echo $detailTransfer['transfer_id'];?>,
                                                        <?php echo $detailTransfer['transfer_giatri'];?>
                                                    )">PROCEED</button></td>
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
    function proceed(pdId, pdStatus, gdId, gdStatus, transferID, amount){
        $.ajax({
                url:"../models/transfer-report.php", 
                method:"post",  
                data:{
                    action: 'proceedTransfer',
                    pdId: pdId,
                    pdStatus: pdStatus,
                    gdId: gdId,
                    gdStatus: gdStatus,
                    transferID: transferID,
                    amount: amount
                },  
                dataType:"text",  
                success:function(data)  
                {  
                    if(data){
                        window.location.reload();
                    }
                    else {
                        alert("Có lỗi phát sinh!!! Vui lòng liên hệ admin");
                    }
                }  
            });
    }
    
    selectorMenu("transfer-report");
    $('#table-user').DataTable({
        "searching": true,
        "info": true,
    });
</script>