<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php require("../models/gd.php");
require("../models/pd-gd.php");
    $id = $_SESSION['login_id'];
    $getGD = danhsachgd($id);
    $isGD = isEnableGet($id);
    $user = mysql_fetch_array(kiemtrastatus($id));
    if(!$getGD || mysql_num_rows($getGD) == 0){
        $rowGD = 0;
    }
    else {
        $rowGD = 1;
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
                            List of GET Donation (GD)
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
                            		    <?php if($isGD):?>
                            			<a class="btn btn-default" href="creategd.php?id=<?php echo $id;?>"><i class="fa fa-fw fa-plus"></i>Create GET Donation (GD)</a>
                            			<?php endif;?>
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                                <!-- Content of post -->
                                <div class="table-responsive padding-top-10">
                                    <table id="table-gd" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>GD NUMBER</th>
                                                <th>AMOUNT</th>
                                                <th>DATE CREATED</th>
                                                <th>STATUS</th>
                                                <th>TRANSFER LIST</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php if ($rowGD == 0):?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No item</td>
                                                </tr>
                                                <?php else:?>
                                                    <?php $iSTT = 1;?>
                                                    <?php while($listGD = mysql_fetch_array($getGD)):?>
                                                    <tr>
                                                        <td><?php echo $iSTT;?></td>
                                                        <td><?php echo $listGD['gd_magd'];?></td>
                                                        <td><?php echo number_format($listGD['gd_giatri']);?></td>
                                                        <td><?php echo $listGD['gd_ngaytao'];?></td>
                                                        <td><span class="label text-uppercase <?php echo $listGD['gd_status'];?>"><?php echo $listGD['gd_status'];?></span></td>
                                                        <?php if(strtolower($listGD['gd_status']) == "waiting"):?>
                                                            <td>---</td>
                                                        <?php else:?>
                                                            <td><a href="gdtransfer.php?id=<?php echo $listGD['gd_id'];?>" class="orange-color">Transfer list</a></td>
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
    selectorMenu("gd");
    $(document).ready(function() {
        $('#table-gd').DataTable({
            "searching": true,
            "info": true,
        });
    });
</script>