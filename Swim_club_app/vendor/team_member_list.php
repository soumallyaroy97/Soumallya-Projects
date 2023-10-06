<?php require('config/db.php');
require('config/config.php');
?>
<?php
session_start();
if(!isset($_SESSION['uid'])){
  
   header('location: '.ROOT_URL.'index.php');
  
}











$query = 'SELECT * FROM student';

//get result

$result = mysqli_query($conn, $query);

//fetch data

$student = mysqli_fetch_all($result, MYSQLI_ASSOC);

//var_dump($student);
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
              <h3 class="box-title">Team List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">Team Member Id</th>
      <th scope="col">Team Member's Image</th>
      <th scope="col">Team Member's Name</th>
    
      <th scope="col">Age</th>
      <th scope="col">Address</th>
      <th scope="col">Father's Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone No.</th>
      <th scope="col">See Full Profile</th> 
    </tr>
  </thead>
  <tbody>
 
    <tr>
    <?php foreach($student as $students): ?>
      <td scope="row">CRSC-100<?php echo $students['id']; ?></td>
      <td><img width="50px" class="img-fluid" src="<?php echo $students['student_img']; ?>"></td>
      <td><?php echo $students['name']; ?></td>
      <td><?php echo $students['age']; ?></td>
      <td><?php echo $students['address']; ?></td>
      <td><?php echo $students['father_name']; ?></td>
      <td><?php echo $students['email']; ?></td>
      <td><?php echo $students['phone']; ?></td>
      <td><a class="btn btn-outline-primary" href="<?php echo ROOT_URL;?>member_details.php?id=<?php echo $students['id']; ?>">View</a></td>
     
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

