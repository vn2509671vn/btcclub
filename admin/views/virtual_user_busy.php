<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/user.php");
    $getList = getVirtualUserBusy();
    if(!$getList || mysql_num_rows($getList) == 0){
        $rowList = 0;
    }
    else {
        $rowList = 1;
    }
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
                            Quản Lí Tài Khoản Ảo - BUSY
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
                                                <th>ACCOUNT SYSTEM</th>
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
                                            
                                            <?php if ($rowList == 0){?>
                                                    <tr><td colspan="9" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php $iSTT = 1;?>
                                                <?php while($User = mysql_fetch_array($getList)){?>
                                                <tr>
                                                    <td><?php echo $iSTT;?></td>
                                                    <td><?php echo $User['nguoidung_taikhoan'];?></td>
                                                    <td><?php echo getAccountByPD($User['transfer_mapd_id']);?></td>
                                                    <td><?php echo $User['transfer_magd'];?></td>
                                                    <td><?php echo $User['transfer_giatri'];?></td>
                                                    <td><span class="label text-uppercase <?php echo $User['transfer_pd_status'];?>"><?php echo $User['transfer_pd_status'];?></span></td>
                                                    <td><span class="label text-uppercase <?php echo $User['transfer_gd_status'];?>"><?php echo $User['transfer_gd_status'];?></span></td>
                                                    <td <?php if($curDate < $User['transfer_time_remain']) echo 'class="countdown" id="'.$User['transfer_id'].'"' ;?> data-date='<?php echo $User['transfer_time_remain'];?>'></td>
                                                        <?php if(strtolower($User['transfer_gd_status']) == 'waiting' && strtolower($User['transfer_pd_status']) == 'transfered'):?>
                                                            <td><button type="button" class="btn btn-sm btn-info" onclick="confirm(<?php echo $User['transfer_mapd_id'];?>, <?php echo $User['transfer_id'];?>, <?php echo $User['transfer_magd_id'];?>)">Confirmed</button></td>
                                                        <?php elseif($curDate > $User['transfer_time_remain'] && strtolower($User['transfer_pd_status']) == 'waiting' && strtolower($User['transfer_gd_status']) != 'report'):?>
                                                            <td><button type="button" class="btn btn-sm btn-danger" onclick="report(<?php echo $User['transfer_mapd_id'];?>, <?php echo $User['transfer_magd_id'];?>)">Report</button></td>
                                                        <?php else:?>
                                                        <?php endif;?>
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
    function confirm(pdid, transferid, gdid){
        $.ajax({
                url:"../models/user.php", 
                method:"post",  
                data:{
                    action: 'confirmed',
                    pdid: pdid,
                    transferid: transferid,
                    gdid: gdid
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
    
    function report(pdid, gdid){
        $.ajax({
                url:"../models/user.php", 
                method:"post",  
                data:{
                    action: 'gdreport',
                    pdid: pdid,
                    gdid: gdid
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
    
    selectorMenu("virtual-user-busy");
    
    $(document).ready(function() {
        $('.countdown').each(function(){
            timeCountdown($(this).attr("id"));
        });
        
        $('#table-user').DataTable({
            "searching": true,
            "info": true,
        });
    });
</script>