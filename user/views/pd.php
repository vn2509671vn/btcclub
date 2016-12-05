<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php require("../models/pd.php");
require("../models/pd-gd.php");
    $id = $_SESSION['login_id'];
    $getPD = danhsachpd($id);
    $isPD = isEnableProvide($id);
    $user = mysql_fetch_array(kiemtrastatus($id));
    if(!$getPD || mysql_num_rows($getPD) == 0){
        $rowPD = 0;
    }
    else {
        $rowPD = 1;
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
                            List of Provide Donation (PD)
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <?php if($user['nguoidung_sopin'] <= 1):?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-danger">
                          <div class="panel-heading">
                            <span>Warning: Số PIN hiện tại của bạn là <?php echo $user['nguoidung_sopin'];?></span>
                          </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="options">
                            		<div class="btn-toolbar">
                            		    <?php if($isPD):?>
                            			<a class="btn btn-default" id="providepd"><i class="fa fa-fw fa-plus"></i>Create PROVIDE Donetion (PD)</a>
                            			<?php endif;?>
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                                <!-- Content of post -->
                                <div class="table-responsive padding-top-10">
                                    <table id="table-pd" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>ACCOUNT</th>
                                                <th>DATE CREATED</th>
                                                <th>PD NUMBER</th>
                                                <th>FILLED</th>
                                                <th>MAX PROFIT</th>
                                                <th>STATUS</th>
                                                <th>TRANSFER LIST</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                <?php if ($rowPD == 0):?>
                                                <tr>
                                                    <td colspan="8" class="text-center">No item</td>
                                                </tr>
                                                <?php else:?>
                                                    <?php $iSTT = 1;?>
                                                    <?php while($listPD = mysql_fetch_array($getPD)):?>
                                                    <tr>
                                                        <td><?php echo $iSTT;?></td>
                                                        <td><?php echo $listPD['taikhoan'];?></td>
                                                        <td><?php echo $listPD['pd_ngaytao'];?></td>
                                                        <td><?php echo $listPD['pd_mapd'];?></td>
                                                        <td><?php echo number_format($listPD['pd_filled']);?></td>
                                                        <td><?php echo number_format($listPD['pd_maxprofit']);?></td>
                                                        <td><span class="label text-uppercase <?php echo $listPD['pd_status'];?>"><?php echo $listPD['pd_status'];?></span></td>
                                                        <?php if(strtolower($listPD['pd_status']) == "waiting"):?>
                                                            <td>---</td>
                                                        <?php else:?>
                                                            <td><a href="pdtransfer.php?id=<?php echo $listPD['pd_id'];?>" class="orange-color">Transfer list</a></td>
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
    selectorMenu("pd");
    $(document).ready(function() {
        $('#providepd').click(function(){
            var r = confirm("Vui lòng nhấn OK để xác nhận!");
            if (r == true) {
                var sopin = <?php echo $user['nguoidung_sopin']; ?>;
                var sopindadung = <?php echo $user['nguoidung_sopindadung']; ?>;
                var status = '<?php echo $user['nguoidung_trangthaikichhoat'];?>';
                if(status == "new"){
                    status = "old";
                }
                sopin -= 1;
                sopindadung += 1;
                
                $.ajax({
                    url:"../models/pd.php", 
                    method:"post",  
                    data:{
                        action: 'create',
                        id: '<?php echo $id;?>',
                        sopin: sopin,
                        status: status,
                        sopindadung: sopindadung,
                        mapd: 'PD<?php echo $user['nguoidung_id'].date("YmdHs");?>'
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
        });
        
        $('#table-pd').DataTable({
            "searching": true,
            "info": true,
        });
    });
</script>