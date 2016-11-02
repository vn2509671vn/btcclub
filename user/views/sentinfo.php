<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php
    $userid = $_GET['id']; // Get from url
    $amount = $_GET['amount'];
    $transferid = $_GET['transferid'];
    $user = userDetail($userid);
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Sent Member Information
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-cloud-upload"></i> <a href="gd.php"> GD</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-list"></i> Sent Member Information
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="options">
                            		<div class="btn-toolbar">
                            			<a class="orange-color" href="gdtransfer.php?id=<?php echo $transferid;?>"><i class="fa fa-angle-double-left"></i> Back to previous page</a>
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                                <!-- Content of post -->
                                <div class="row">
                                    <div class="col-md-6">
                                      <h4>Sent Bitcoin Account</h4>
                                      <dl>
                                        <dt>Bitcoin Link</dt>
                                        <dd><a class="orange-color" href="<?php echo $user['nguoidung_btclink'];?>">Vui lòng click vào đây!!</a></dd>
                                      </dl>
                                    </div>
                                    <div class="col-md-6">
                                      <h4>Send Information</h4>
                                      <dl>
                                        <dt>Account Send</dt>
                                        <dd><?php echo $user['nguoidung_taikhoan'];?></dd>
                                        <dt>Email</dt>
                                        <dd><?php echo $user['nguoidung_mail'];?></dd>
                                        <dt>Phone</dt>
                                        <dd><?php echo $user['nguoidung_sdt'];?></dd>
                                        <dt>Amount</dt>
                                        <dd><code><?php echo number_format($amount);?></code></dd>
                                      </dl>
                                    </div>
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
</script>