<!-- Add start Header-->
<?php require("nag.php");?>
<?php require('models/xuly_login.php');
?>
<!-- Add end Header-->
<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
        <form method="post" action="#" role="login">
          <img src="img/logo.png" class="img-responsive"width="200" alt="" />
          <input type="input" name="username"  required class="form-control input-lg" placeholder="Please input account" />
          <input type="password" class="form-control input-lg" placeholder="**********" id="password" name="password" placeholder="Password" required="" />
          <div class="pwstrength_viewport_progress"></div>
          <?php if($error == 1){ ?>
            <div class="alert alert-danger" id="error_login">
                <a href="#" class="close" data-dismiss="alert">×</a>
                <strong>Error :</strong>
                <div>
                    <?php echo "Username or Password is invalid"; ?>
                </div>
            </div>     
          <?php } else if($error == 2){?>
            <div class="alert alert-danger" id="error_login">
              <a href="#" class="close" data-dismiss="alert">×</a>
              <strong>Error :</strong>
              <div>
                  <?php echo "Tài khoản của bạn đã bị khóa."; ?>
              </div>
            </div> 
          <?php }?>
          <button type="submit" id="submit" name="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
          <div>
            <!--<a class="reset_pass" href="#">Reset password</a>-->
            <a id="reset_pass" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dg">Reset Password?</a>
          </div>
        </form>
        
        <div class="form-links">
          <a target="_blank" href="https://btcclub.info">www.btcclub.info</a>
        </div>
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      <div class="modal fade" id="dg" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Vui lòng nhập tài khoản cần đổi.</h4>
            </div>
            <div class="modal-body">
              <input type="text" class="form-control" class="account" id="account"/>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="reset_pass()">Xác nhận</button>
            </div>
          </div>
        </div>
      </div>

  </div>   
  
  
</div>
<script type="text/javascript">
    function reset_pass(){
      var account = $('#account').val();
      $.ajax({
          url:"models/reset_pass.php", 
          method:"post",  
          data:{
              action: 'update',
              account: account
          },
          dataType:"text",  
          success:function(data)  
          {
              if(data == 1){
                  alert("Vui lòng check mail để cập nhật password");
              }
              else if(data == 0){
                  alert("Người nhận không tồn tại");
              }
              else{
                alert("Email không hợp lệ. VUilòng liên hệ Admin.");
              }
          }
      });
    }
</script>