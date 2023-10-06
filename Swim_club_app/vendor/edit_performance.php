<?php
require('config/config.php');
require('config/db.php');
session_start();
if(!isset($_SESSION['uid'])){
  
   header('location: '.ROOT_URL.'index.php');
  
}
$swim_id = mysqli_real_escape_string($conn, $_GET['swim_id']);


$query = 'SELECT swimmer_performance.swim_id,swimmer_performance.student_id, swimmer_performance.performance, student.name, student.age FROM `swimmer_performance`, `student` WHERE swimmer_performance.student_id=student.id and swim_id= '.$swim_id;






$result = mysqli_query($conn, $query);



$students = mysqli_fetch_assoc($result);
//check for submit
if(isset($_POST['submit'])){

    //get form data
    



    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);

    
    
    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    // $age = mysqli_real_escape_string($conn, $_POST['age']);
    $performance = mysqli_real_escape_string($conn, $_POST['performance']);
   

   


    //print_r($filename);

    
    $query = "UPDATE swimmer_performance SET performance ='$performance'
    WHERE swim_id = {$update_id} ";    

    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL.'performance.php');
    }else{
        echo 'ERROR '. mysqli_error($conn); 
    }



    //print_r($filename);
    
}





mysqli_free_result($result);



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
        <li class="active">Edit Member's Details</li>
      </ol>
    </section>

    <section class="content">
     
    <?php //echo $students['student_img']; ?>
     
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-md-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="container">
<?php //if($msg != ''): ?>
<!-- <div class="alert <?php //echo $msgClass; ?>"><?php// echo $msg; ?></div>  -->
<?php //endif; ?>
    <h1>Edit Swimmer Performance</h1>
   
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" ?>
    <div class="row">
    <div class="col-md-5">
    <h3>Performance Details</h3>
    
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" disabled class="form-control" value="<?php echo $students['name']; ?>">
        </div>
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" name="age" disabled class="form-control" value="<?php echo $students['age']; ?>">
        </div>
        <div class="form-group">
            <label for="">Performance</label>
            <input type="text" name="performance" class="form-control" value="<?php echo $students['performance']; ?>">
        </div>
        <input type="hidden" name="update_id" value="<?php echo $students['swim_id']; ?>">
        <input type="submit" name="submit" value="Submit" class="btn btn-success">
        
</div>
     </form>
    
</div>
          
          <!-- // (student_img, name, class, age, address, father_name, father_occupation, mother_name) 
    // VALUES('$destfile', '$name','$class', '$age', '$address', '$fat_name', '$fat_occu', '$mot_name')"; -->
   <!-- /.nav-tabs-custom -->
          <!-- /.box (chat box) -->

   

        </section>
        <!-- /.Left col -->
      
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
</div>
    </section>
    <!-- /.content -->
 

<?php require('includes/footer.php'); ?>