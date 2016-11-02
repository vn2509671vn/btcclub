<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php require("../models/pd.php");
require("../models/pd-gd.php");
session_start();
    $pdid = $_GET['id']; // Get from url
    $userID = $_SESSION['login_id'];
    $getTransfer = dspdkhoplenh($pdid, $userID);
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
                                <i class="fa fa-cloud-upload"></i> <a href="pd.php"> PD</a>
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
                                    <table id="table-pdtransfer" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>DATE CREATED</th>
                                                <th>ACCOUNT RECECIVED</th>
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
                                                        <td><a href="receivedinfo.php?id=<?php echo $listTransfer['gd_nguoidung_id'];?>&amount=<?php echo number_format($listTransfer['transfer_giatri']);?>&transferid=<?php echo $pdid;?>"><?php echo $listTransfer['nguoidung_hoten'];?></a></td>
                                                        <td><?php echo number_format($listTransfer['transfer_giatri']);?></td>
                                                        <td><span class="label text-uppercase <?php echo $listTransfer['transfer_pd_status'];?>"><?php echo $listTransfer['transfer_pd_status'];?></span></td>
                                                        <td><span class="label text-uppercase <?php echo $listTransfer['transfer_gd_status'];?>"><?php echo $listTransfer['transfer_gd_status'];?></span></td>
                                                        <td <?php if($curDate < $listTransfer['transfer_time_remain']) echo 'class="countdown" id="'.$listTransfer['gd_nguoidung_id'].'"' ;?> data-date='<?php echo $listTransfer['transfer_time_remain'];?>'></td>
                                                        <?php if(strtolower($listTransfer['transfer_pd_status']) == 'waiting'):?>
                                                            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dg<?php echo $listTransfer['gd_nguoidung_id'];?>">Transfered</button></td>
                                                            <div class="modal fade" id="dg<?php echo $listTransfer['gd_nguoidung_id'];?>" role="dialog">
                                                            <div class="modal-dialog">
                                                              <!-- Modal content-->
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <h4 class="modal-title">Vui lòng nhập mã giao dịch.</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <input type="text" class="form-control" id="FF<?php echo $iSTT+$listTransfer['gd_nguoidung_id'];?>"/>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="transfer('FF<?php echo $iSTT+$listTransfer['gd_nguoidung_id'];?>', <?php echo $listTransfer['transfer_magd_id'];?>, '<?php echo $listTransfer['transfer_time_remain'];?>')">Xác nhận</button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            </div>
                                                        <?php elseif($curDate > $listTransfer['transfer_time_remain'] && strtolower($listTransfer['transfer_gd_status']) != 'confirmed'):?>
                                                            <td><a class="btn btn-sm btn-danger" id="report" onclick="report(<?php echo $listTransfer['transfer_magd_id'];?>)">Report</a></td>
                                                        <?php else:?>
                                                        <?php endif;?>
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
    function transfer(element, gdid, time){
        var magd = $('#'+element).val();
        var time = time;
        $.ajax({
                url:"../models/pd-gd.php", 
                method:"post",  
                data:{
                    action: 'transfered',
                    pdid: '<?php echo $pdid;?>',
                    gdid: gdid,
                    magd: magd,
                    time: time
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
    
    function report(gdid){
        $.ajax({
                url:"../models/pd-gd.php", 
                method:"post",  
                data:{
                    action: 'pdreport',
                    gdid: gdid,
                    pdid: '<?php echo $pdid;?>'
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
    selectorMenu("pd");
    $(document).ready(function() {
        $('.countdown').each(function(){
            timeCountdown($(this).attr("id"));
        });
        
        $('#table-pdtransfer').DataTable({
            "searching": true,
            "info": true,
        });
    });
</script>