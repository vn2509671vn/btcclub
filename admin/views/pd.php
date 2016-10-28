<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php require("../models/pd.php");
require("../models/pd-gd.php");
    $id = "1";
    $getPD = danhsachpd($id);
    $isPD = isEnableProvide($id);
    if(!$getPD || mysql_num_rows($getPD) == 0){
        $rowPD = 0;
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
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="options">
                            		<div class="btn-toolbar">
                            			<a class="btn btn-default <?php if(!$isPD) echo 'disabled';?>" href="#"><i class="fa fa-fw fa-plus"></i>Create PROVIDE Donetion (PD)</a>
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
                                            <tr>
                                                <?php if ($rowPD == 0):?>
                                                <td colspan="8" class="text-center">No item</td>
                                                <?php else:?>
                                                    <?php $iSTT = 1;?>
                                                    <?php while($listPD = mysql_fetch_array($getPD)):?>
                                                        <td><?php echo $iSTT;?></td>
                                                        <td><?php echo $listPD['taikhoan'];?></td>
                                                        <td><?php echo $listPD['pd_ngaytao'];?></td>
                                                        <td><?php echo $listPD['pd_mapd'];?></td>
                                                        <td><?php echo number_format($listPD['pd_filled']);?></td>
                                                        <td><?php echo number_format($listPD['pd_maxprofit']);?></td>
                                                        <td><?php echo $listPD['pd_status'];?></td>
                                                        <?php if(strtolower($listPD['pd_status']) == "waiting"):?>
                                                            <td>---</td>
                                                        <?php else:?>
                                                            <td><a href="#" class="orange-color">Transfer list</a></td>
                                                        <?php endif;?>
                                                        <?php $iSTT++;?>
                                                    <?php endwhile;?>
                                                <?php endif;?>
                                            </tr>
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
      $('#table-pd').DataTable({
        "searching": true,
        "info": true,
      });
    });
</script>