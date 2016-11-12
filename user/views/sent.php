<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/messages.php");
    $userID = $_SESSION['login_id'];
    $getList = getSent($userID);
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
                            Thư Đã Gửi
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <table id="table-message" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>RECEIVER</th>
                                                <th>SUBJECT</th>
                                                <th>SEND DATE</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($rowList == 0){?>
                                                    <tr><td colspan="3" class="text-center">No item</td></tr>
                                            <?php }else{?>
                                                <?php while($mail = mysql_fetch_array($getList)){?>
                                                <tr>
                                                    <td><?php echo $mail['nguoidung_hoten'];?></td>
                                                    <td><?php echo $mail['subject'];?></td>
                                                    <td><?php echo $mail['create_date'];?></td>
                                                    <td><a href="mail-detail-sent.php?msgid=<?php echo $mail['messages_id'];?>" class="btn btn-info">READ</a></td>
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
    selectorMenu("sent");
    $('#table-message').DataTable({
        "searching": true,
        "info": true,
    });
</script>