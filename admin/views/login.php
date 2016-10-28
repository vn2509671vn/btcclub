<!-- Add start Header-->
<?php require("../nag.php");?>
<?php include('../models/xuly_login.php'); 
  if(isset($_SESSION['login_user'])){
    header("location: index.php");
  }
?>
<!-- Add end Header-->
<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
        <form method="post" action="#" role="login">
          <img src="../img/logo.png" class="img-responsive"width="200" alt="" />
          <input type="input" name="username"  required class="form-control input-lg" placeholder="btc12323" />
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
          <?php }?>
          <button type="submit" id="submit" name="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
          <div>
            <a href="#">reset password</a>
          </div>
          
        </form>
        
        <div class="form-links">
          <a target="_blank" href="http://btcclub.org">www.btcclub.org</a>
        </div>
      </section>  
      </div>
      
      <div class="col-md-4"></div>

  </div>   
  
  
</div>