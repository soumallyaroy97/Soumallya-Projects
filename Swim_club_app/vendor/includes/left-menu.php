<?php
//require('config/db.php');
//require('config/config.php');
// session_start();
// if(!isset($_SESSION['uid'])){
  
//    header('location: '.ROOT_URL.'index.php');
  
// }
?>
 
 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php if($_SESSION['uid']==1 || $_SESSION['uid']==2){
        ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php
          if($_SESSION['uid']==1){
          ?>
        <li>
        <a href="<?php echo ROOT_URL; ?>member_list.php">
            <i class="fa fa-users"></i> <span>Member List</span>
          </a>
        </li>
        <?php } 
        else if($_SESSION['uid']==2){ 
         ?>
        <li>
        <a href="<?php echo ROOT_URL; ?>team_member_list.php">
            <i class="fa fa-users"></i> <span>Team Member List</span>
          </a>
        </li>
        <?php }?> 
        <?php
          if($_SESSION['uid']==1){
          ?>
        <li>
        <a href="<?php echo ROOT_URL; ?>add_member.php">
            <i class="fa fa-th"></i> <span>Add Member</span>
          </a>
        </li>
       <?php } ?>
        <?php
          if($_SESSION['uid']==1 || $_SESSION['uid']==2){
          ?>
        <li> 
        <a href="<?php echo ROOT_URL; ?>performance.php">
            <i class="fa fa-th"></i> <span>Performance List</span>
          </a>
        </li>
        <?php 
         }?>
        <li>
          
      
       
     
      </ul>
      <?php }
      else{
        
      } ?>
    </section>
    <!-- /.sidebar -->
  </aside>