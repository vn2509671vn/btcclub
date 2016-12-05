<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php require("../models/pd.php");
require("../models/pd-gd.php");
    $gdid = $_GET['id']; // Get from url
    $userID = $_SESSION['login_id'];
    $getTransfer = dsgdkhoplenh($gdid, $userID);
    date_default_timezone_set('Asia/Bangkok');
    $dateTime = new DateTime();
    $curDate = $dateTime->format('Y-m-d H:i:s');
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Danh sách chuyển
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-cloud-upload"></i> <a href="gd.php"> GD</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-list"></i> Danh sách chuyển
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                
                            </div>
                            <div class="panel-body">
                                <!-- Content of post -->
                                <div class="table-responsive padding-top-10">
                                    <table id="table-gdtransfer" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>DATE CREATED</th>
                                                <th>ACCOUNT SENT</th>
                                                <th>TRADE CODE</th>
                                                <th>AMOUNT</th>
                                                <th>PD STATUS</th>
                                                <th>GD STATUS</th>
                                                <th>TIME REMAIN</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                <?php if(mysql_num_rows($getTransfer) == 0):?>
                                                <tr>
                                                    <td colspan="8" class="text-center">No item</td>
                                                </tr>
                                                <?php else:?>
                                                    <?php $iSTT = 1;?>
                                                    <?php while($listTransfer = mysql_fetch_array($getTransfer)):?>
                                                    <tr>
                                                        <td><?php echo $iSTT;?></td>
                                                        <td><?php echo $listTransfer['transfer_ngaytao'];?></td>
                                                        <td><a href="sentinfo.php?id=<?php echo $listTransfer['transfer_mapd_id'];?>&amount=<?php echo number_format($listTransfer['transfer_giatri']);?>&transferid=<?php echo $gdid;?>"><?php echo $listTransfer['nguoidung_hoten'];?></a></td>
                                                        <td><?php echo $listTransfer['transfer_magd'];?></td>
                                                        <td><?php echo number_format($listTransfer['transfer_giatri']);?></td>
                                                        <td><span class="label text-uppercase <?php echo $listTransfer['transfer_pd_status'];?>"><?php echo $listTransfer['transfer_pd_status'];?></span></td>
                                                        <td><span class="label text-uppercase <?php echo $listTransfer['transfer_gd_status'];?>"><?php echo $listTransfer['transfer_gd_status'];?></span></td>
                                                        <td <?php if($curDate < $listTransfer['transfer_time_remain']) echo 'class="countdown" id="'.$listTransfer['pd_nguoidung_id'].'"' ;?> data-date='<?php echo $listTransfer['transfer_time_remain'];?>'></td>
                                                        <td>
															<?php if(strtolower($listTransfer['transfer_gd_status']) == 'waiting' && strtolower($listTransfer['transfer_pd_status']) == 'transfered'):?>
															<button type="button" class="btn btn-sm btn-info" onclick="confirmGD(<?php echo $listTransfer['transfer_mapd_id'];?>, <?php echo $listTransfer['transfer_id'];?>)">Confirmed</button>&nbsp
															<?php endif;?>
															<?php if($curDate > $listTransfer['transfer_time_remain'] && strtolower($listTransfer['transfer_gd_status']) == 'waiting'):?>
															<button type="button" class="btn btn-sm btn-danger" onclick="reportGD(<?php echo $listTransfer['transfer_mapd_id'];?>)">Report</button>&nbsp
															<?php endif;?>
															<a class="btn btn-sm btn-info" href="sentinfo.php?id=<?php echo $listTransfer['transfer_mapd_id'];?>&amount=<?php echo number_format($listTransfer['transfer_giatri']);?>&transferid=<?php echo $gdid;?>">INFO</a>
														</td>
                                                        <?php $iSTT++;?>
                                                    </tr>
                                                    <?php endwhile;?>
                                                <?php endif;?>
                                        </tbody>
                                    </table>
                                </div>
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
    function confirmGD(pdid, transferid){
        var r = confirm("Vui lòng nhấn OK để xác nhận!");
        if (r == true) {
            $.ajax({
                url:"../models/pd-gd.php", 
                method:"post",  
                data:{
                    action: 'confirmed',
                    pdid: pdid,
                    transferid: transferid,
                    gdid: '<?php echo $gdid;?>'
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
    }
    
    function reportGD(pdid){
        var r = confirm("Vui lòng nhấn OK để xác nhận!");
        if (r == true) {
            $.ajax({
                url:"../models/pd-gd.php", 
                method:"post",  
                data:{
                    action: 'gdreport',
                    pdid: pdid,
                    gdid: '<?php echo $gdid;?>'
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
    }
    
    selectorMenu("gd");
    
    $(document).ready(function() {
        $('.countdown').each(function(){
            timeCountdown($(this).attr("id"));
        });
        
        $('#table-gdtransfer').DataTable({
            "searching": true,
            "info": true,
        });
    });
</script>