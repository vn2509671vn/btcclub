<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/messages.php");
    class userInfo
    {
        public $label;
        public $value;
        public $id;
    }
    if(isset($_GET['receiver'])){
        $receiver = $_GET['receiver'];
    }
    else {
        $receiver = "";
    }
    $userID = $_SESSION['login_id'];
    $listUser = getAllUser();
    $dataAutocomplete = array();
    while($userDetail = mysql_fetch_array($listUser)){
        $tmpUser = new userInfo();
        $tmpUser->id = $userDetail['nguoidung_id'];
        $tmpUser->value = $userDetail['nguoidung_taikhoan'];
        $tmpUser->label = $userDetail['nguoidung_taikhoan'];
        array_push($dataAutocomplete,$tmpUser);
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
                            Soạn Thư
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <form class="form-horizontal" role="form" action="../models/create-mail.php" method="post" enctype="multipart/form-data" id="composeForm">
                                    	<input type="hidden" name="fromUserID" class="form-control" value="<?php echo $userID;?>">
                                    	<div class="form-group">
                                    		<label for="name" class="col-md-2 control-label">Người nhận:</label>
                                    		<div class="col-md-10">
                                    			<input type="text" name="receiver" class="form-control" required id="autocomplete" value="<?php echo $receiver;?>">
                                    		</div>
                                    	</div>
                                    	<div class="form-group">
                                    		<label for="subject" class="col-md-2 control-label">Tiêu đề:</label>
                                    		<div class="col-md-10">
                                    			<input type="text" class="form-control" rows="4" name="subject" id="subject" />
                                    		</div>
                                    	</div>
                                    	<div class="form-group">
                                            <label for="contain" class="col-md-2 control-label">Nội dung:</label>
                                            <div class="col-md-10">
                                    			<textarea class="form-control" rows="5" id="contain" name="contain"></textarea>
                                    		</div>
                                        </div>
                                        <div class="form-group">
                                            <!-- Code upload image-->
                                            <label for="message" class="col-md-2 control-label">File kính kèm:</label>
                                            <div class="col-md-10">
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="fileToUpload" id="fileToUpload"/>
                                            </div>
                                            <!-- Code end upload image-->
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                              <button type="submit" class="btn btn-warning" id="sendMail">Gửi</button>
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
    selectorMenu("compose");
    $('#table-message').DataTable({
        "searching": true,
        "info": true,
    });
    $(document).ready(function() {
        var srcData = <?php echo json_encode($dataAutocomplete);?>;
        var userID;
        $('#autocomplete').autocomplete({
            source: srcData
        });
    });
</script>