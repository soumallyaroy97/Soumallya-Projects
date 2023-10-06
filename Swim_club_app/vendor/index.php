<?php require('config/db.php'); ?>
<?php require('config/config.php'); ?>
<?php   
session_start();
if(isset($_SESSION['uid']) && $_SESSION['uid']==1){
  header('location: '.ROOT_URL. 'member_list.php');
}
elseif(isset($_SESSION['uid']) && $_SESSION['uid']==2){
  header('location: '.ROOT_URL. 'team_member_list.php');
}
elseif(isset($_SESSION['uid']) && $_SESSION['uid']==3){
  header('location: '.ROOT_URL. 'team_member_list.php');
}
?>

<?php
if(isset($_POST['login'])){
  $username = $_POST['uname'];
  $password = $_POST['pass'];

  $qry = "SELECT * FROM `user` 
  WHERE `username` = '$username' AND `password` = '$password'";

  $result = mysqli_query($conn, $qry);

  $row = mysqli_num_rows($result);

  if($row <1){
?>
    <script>alert('Username or Password not match !!'); 
    window.open('user.php', '_self');
    </script>
    <?php
  }
  else{
    $data = mysqli_fetch_assoc($result);

    $id = $data['user_id'];
echo $id;

    
?>

<script>alert('You have successfully logged in  !!'); </script>
   <?php 
 //die();
 
    $_SESSION['uid']= $id;
    if($_SESSION['uid']==1){
      header('location: '.ROOT_URL.'member_list.php');
    }
    elseif($_SESSION['uid']==2){
      header('location: '.ROOT_URL.'team_member_list.php');
    }
    elseif($_SESSION['uid']==3){
      header('location: '.ROOT_URL.'team_member_list.php');
    }
  }
}



?>
<?php require('login_header.php');?>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="<?php ROOT_URL; ?>"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"></p>    





    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <div class="form-group has-feedback">
      <!-- type="email" -->
        <input type="text" name="uname" id="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="pass" class="form-control" placeholder="Password">
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
          <button name="login" type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
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