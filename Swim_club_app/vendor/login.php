<?php require('config/db.php'); ?>
<?php require('config/config.php'); ?>



<?php require('login_header.php');?>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="<?php ROOT_URL; ?>"><b>Admin</b>Panel</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"></p>    





    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <div class="form-group has-feedback">
      <!-- type="email" -->
        <input name="username" id="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->

   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<?php require('login_footer.php');?>