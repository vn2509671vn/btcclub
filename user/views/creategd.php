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
                                                <input type="radio" name="radio" id="rwallet" value="rwallet" checked>R - WALLET
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="radio" id="cwallet" value="cwallet">C - WALLET
                                            </label>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-2">Amount:</label>
                                    <div class="col-sm-10"> 
                                        <select class="form-control" id="amount">
                                            <option>150</option>
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
    $('input[type=radio]').change(function(){
        var action  = this.value;
        var userID = <?php echo $user['nguoidung_id'];?>;
        $.ajax({
            url:"../models/gd.php",  
            method:"post",  
            data:{
                action: action,
                userID: userID
            },  
            dataType:"text",  
            success:function(data)
            {
                if(data){
                    $('#amount').html(data);
                }
                else{
                    $('#amount').html("");
                }
            }
        });
    });
    
    $('#submit').click(function(){
        var r = confirm("Vui lòng nhấn OK để xác nhận!");
        if (r == true) {
            var type = $('input[type=radio]:checked').val();
            var amount = $('#amount').val();
            var pass = $('#pwd').val();
            var userid = '<?php echo $id;?>';
            var tongtiennhan = '<?php echo $user['nguoidung_sotiennhan'];?>';
            var tonghoahong = '<?php echo $user['nguoidung_sotienhoahong'];?>';
            var magd = type + '<?php echo $user['nguoidung_id'].date("YmdHs");?>';
            $.ajax({
                url:"../models/gd.php",  
                method:"post",  
                data:{
                    action: 'create',
                    type: type,
                    amount: amount,
                    pass: pass,
                    userid: userid,
                    magd: magd,
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
                    else if(data == 3){
                        alert("Tài khoản của bạn không đủ! Vui lòng kiểm tra lại số tiền có trong tài khoản!!!");
                    }
                    else if(data == 1){
                        window.location.replace("gd.php");
                    }
                }
            })
        }
    });
</script>