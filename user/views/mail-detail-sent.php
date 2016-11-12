<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/messages.php");
    if(!isset($_GET['msgid'])){
        echo "<script>window.location.replace('inbox.php')</script>";
    }
    else {
        $msgID = $_GET['msgid'];
    }
    
    $msgDetail = msgSentDetail($msgID);
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            READ MAIL
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <form class="form-horizontal" role="form" action="#" method="post" enctype="multipart/form-data" id="repMail">
                                    	<div class="form-group">
                                    		<label for="name" class="col-md-2 control-label">Người nhận:</label>
                                    		<div class="col-md-10">
                                    			<input type="text" name="receiver" class="form-control"  value="<?php echo $msgDetail['nguoidung_taikhoan']?>">
                                    		</div>
                                    	</div>
                                    	<div class="form-group">
                                    		<label for="subject" class="col-md-2 control-label">Tiêu đề:</label>
                                    		<div class="col-md-10">
                                    			<input class="form-control" rows="4" name="subject" id="subject" value="<?php echo $msgDetail['subject']?>" />
                                    		</div>
                                    	</div>
                                    	<div class="form-group">
                                            <label for="contain" class="col-md-2 control-label">Nội dung:</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="contain" name="contain"><?php echo $msgDetail["contain"]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="contain" class="col-md-2 control-label">File đính kèm:</label>
                                            <div class="col-md-10">
                                                <a href="../../img/msg/<?php echo $msgDetail["path_img"];?>" target="_blank"><?php echo $msgDetail["path_img"];?></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                              <a href="compose.php?receiver=<?php echo $msgDetail['nguoidung_taikhoan'];?>" class="btn btn-warning">Trả Lời</a>
                                            </div>
                                        </div>
                                    </form>
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
    $('#table-message').DataTable({
        "searching": true,
        "info": true,
    });
    
</script>