<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php require("../models/gd.php");
require("../models/pd-gd.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        $id = "0";
    }
    $isGD = isEnableGet($id);
    $user = userDetail($id);
    $minRwallet = 50;
    $userRWallet = $user['nguoidung_sotiennhan'];
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Create GD
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-cloud-download"></i> <a href="gd.php"> GD</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-list"></i> Create GD
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
                                <div class="form-horizontal">
                                  <div class="form-group">
                                    <label class="control-label col-sm-2">From Wallet:</label>
                                    <div class="col-sm-10">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="rwallet" id="rwallet" value="rwallet" checked>R - WALLET
                                            </label>
                                        </div>
                                        <!--<div class="radio">-->
                                        <!--    <label>-->
                                        <!--        <input type="radio" name="cwallet" id="cwallet" value="cwallet">C - WALLET-->
                                        <!--    </label>-->
                                        <!--</div>-->
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-2">Amount:</label>
                                    <div class="col-sm-10"> 
                                        <select class="form-control" id="amount">
                                            <?php for($i = $minRwallet; $i <= $userRWallet; $i+=50 ){?>
                                                <option><?php echo $i;?></option>
                                            <?php };?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="form-group"> 
                                    <label class="control-label col-sm-2">Bitcoin Link:</label>
                                    <div class="col-sm-10"> 
                                        <input class="form-control" type="text" readonly value="<?php echo $user['nguoidung_btclink'];?>">
                                    </div>
                                  </div>
                                  <div class="form-group"> 
                                    <label class="control-label col-sm-2">Security Password:</label>
                                    <div class="col-sm-10"> 
                                        <input class="form-control" type="password" id="pwd" placeholder="Your existing Security Password">
                                    </div>
                                  </div>
                                  <div class="form-group"> 
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button class="btn btn-warning <?php if(!$isGD) echo 'disabled';?>" id="submit">Create GD</button>
                                    </div>
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
    $('#submit').click(function(){
        var type = $('input[type=radio]').val();
        var amount = $('#amount').val();
        var pass = $('#pwd').val();
        var userid = '<?php echo $id;?>';
        var tongtiennhan = '<?php echo $user['nguoidung_sotiennhan'];?>';
        var tonghoahong = '<?php echo $user['nguoidung_sotienhoahong'];?>';
        $.ajax({
            url:"../models/gd.php",  
            method:"post",  
            data:{
                action: 'create',
                type: type,
                amount: amount,
                pass: pass,
                userid: userid,
                magd: 'GD<?php echo $user['nguoidung_id'].date("YmdHs");?>',
                tongtiennhan: tongtiennhan,
                tonghoahong: tonghoahong
            },  
            dataType:"text",  
            success:function(data)
            {
                if(data == 0){
                    alert("Có lỗi phát sinh!!! Vui lòng liên hệ admin");
                }
                else if(data == 2){
                    alert("Mật khẩu giao dịch không chính xác!!!");
                }
                else if(data == 1){
                    window.location.replace("gd.php");
                }
            }
        })
    });
</script>