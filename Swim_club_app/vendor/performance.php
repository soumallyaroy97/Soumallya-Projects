<?php require('config/db.php');
require('config/config.php');
?>
<?php
session_start();
if(!isset($_SESSION['uid'])){
  
   header('location: '.ROOT_URL.'index.php');
  
}











// $query = 'SELECT swimmer_performance. FROM swimmer_performance';

$query = "SELECT swimmer_performance.swim_id,swimmer_performance.student_id, swimmer_performance.performance, student.name, student.age FROM `swimmer_performance`, `student` WHERE swimmer_performance.student_id=student.id";
//get result

$result = mysqli_query($conn, $query);


//fetch data

$performance = mysqli_fetch_all($result, MYSQLI_ASSOC);

// var_dump($performance);
//free result
mysqli_free_result($result);


//close connection

mysqli_close($conn);

?>


<?php require('includes/header.php');?>
<?php require('includes/left-menu.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
     
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-md-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Member List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">SQ No.</th>
     
      <th scope="col">Member Id</th>
      <th scope="col">Swimmer Name</th>
      <th scope="col">Swimmer Age</th>
      <th scope="col">Performance</th>
      <?php if($_SESSION['uid']==1) { ?>  
      <th scope="col">Update Performance</th>
      <?php  } ?>
    </tr>
  </thead>
  <tbody>
 
    <tr>
    <?php foreach($performance as $performances): ?>
      <td scope="row"><?php echo $performances['swim_id']; ?></td>
 
      <td scope="row">CRSC-100<?php echo $performances['student_id']; ?></td>
      <td scope="row"><?php echo $performances['name']; ?></td>
      <td scope="row"><?php echo $performances['age']; ?></td>
      <td><?php echo $performances['performance']; ?></td>
      <td><a class="btn btn-primary" <?php if($_SESSION['uid']==2 || $_SESSION['uid']==3) { ?> style="display: none;" <?php  } ?> href="<?php echo ROOT_URL; ?>edit_performance.php?swim_id=<?php echo $performances['swim_id']; ?>">Edit</a></td>
    
     
    </tr>
    <?php endforeach; ?>

  </tbody>
</table>
            </div>
            <!-- /.box-body -->
           
          </div>
          <!-- /.box (chat box) -->

   

        </section>
        <!-- /.Left col -->
      
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
    
<?php require('includes/footer.php'); ?>

