<?php

require('config/db.php');
require('config/config.php');
session_start();
if(!isset($_SESSION['uid'])){
  
   header('location: '.ROOT_URL.'index.php');
  
}
if(isset($_POST['delete'])){
  //get form data
  $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
  // $files = $_FILES['file'];
  // $name = mysqli_real_escape_string($conn, $_POST['name']);
  // $age = mysqli_real_escape_string($conn, $_POST['age']);
  // $address = mysqli_real_escape_string($conn, $_POST['address']);

  $filename = $files['name'];
  $fileerror = $files['error'];
  $filetmp = $files['tmp_name'];
 
  $fileext = explode('.',$filename);

  $filecheck = strtolower(end($fileext));

  $fileextstored = array('png', 'jpg', 'jpeg');

  if(in_array($filecheck,$fileextstored)){
      $destfile = 'assets/'.$filename;

      move_uploaded_file($filetmp,$destfile);
  }
  $query = "DELETE FROM student
  WHERE id = {$delete_id} ";
  ?>

<script>
alert(Your record is deleted!!);
</script>
<?php
  if(mysqli_query($conn, $query)){
      header('Location: '.ROOT_URL.'');
  }else{
      echo 'ERROR '. mysqli_error($conn); 
  }
}

if(isset($_GET['id']) && is_numeric($_GET['id'])){



//get id
$id = mysqli_real_escape_string($conn, $_GET['id']);

//create query
$query = 'SELECT * FROM student WHERE id= '.$id;

//$query = TRUE;



//get result

$result = mysqli_query($conn, $query);

//fetch data

$students = mysqli_fetch_assoc($result);

//var_dump($student);
//free result
// if (!empty['id'])
// {
// echo 'Variable is  NULL';
// }


mysqli_free_result($result);

//close connection

mysqli_close($conn);

}else{
  $students = null;
}


?>

<?php require('includes/header.php');?>
<?php require('includes/left-menu.php'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Member's Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Member's profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <?php if($students === NULL): ?>
  <p>No such member available</p>
  <?php else: ?>
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                            src="<?php echo $students['student_img']; ?>" alt="User profile picture">

                        <h3 class="profile-username text-center"><?php echo $students['name']; ?></h3>

                        <p class="text-muted text-center"><b>Class : </b><?php echo $students['class']; ?></p>

                        <ul class="list-group list-group-bordered">
                            <li class="list-group-item">
                                <b>Age : <?php echo $students['age']; ?></b>
                            </li>
                            <li class="list-group-item">
                                <b>Address : <?php echo $students['address']; ?></b>
                            </li>
                            <li class="list-group-item">
                                <b>Father's Name : <?php echo $students['father_name']; ?></b>
                            </li>
                            <li class="list-group-item">
                                <b>Father's Occupation : <?php echo $students['father_occupation']; ?></b>
                            </li>
                            <li class="list-group-item">
                                <b>Mother's Name : <?php echo $students['mother_name']; ?></b>
                            </li>
                        </ul>
                        <div class="col-md-6">
                            <a href="<?php echo ROOT_URL; ?>edit_student.php?id=<?php echo $students['id']; ?>"
                                class="btn btn-primary btn-block"><b>Edit</b></a>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                                <input type="hidden" name="delete_id" value="<?php echo $students['id']; ?>">
                                <input type="submit" name="delete" value="Delete"
                                    class="btn btn-outline-danger btn-block">
                            </form>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <?php endif; ?>
                <!-- About Me Box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>


<?php require('includes/footer.php'); ?>