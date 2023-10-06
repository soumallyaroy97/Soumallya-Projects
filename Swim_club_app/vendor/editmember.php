<?php
require('config/config.php');
require('config/db.php');
session_start();
if(!isset($_SESSION['uid'])){
  
   header('location: '.ROOT_URL.'index.php');
  
}
$id = mysqli_real_escape_string($conn, $_GET['id']);


$query = 'SELECT * FROM student WHERE id= '.$id;






$result = mysqli_query($conn, $query);



$students = mysqli_fetch_assoc($result);
//check for submit
if(isset($_POST['submit'])){

    //get form data
    if($_FILES['file']['tmp_name'] == '') {
            $image = $students['student_img'];
      }
      else{
        $files = $_FILES['file'];
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
        $image = $destfile;
      }



    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);

    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $files = $_FILES['file'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email= mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $filename = $files['name'];
    $fileerror = $files['error'];
    $filetmp = $files['tmp_name'];


   


    //print_r($filename);

    
    $query = "UPDATE student SET student_img='$image', name='$name', age='$age', address='$address', email='$email', phone='$phone'
    WHERE id = {$update_id} ";    

    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL.'member_list.php');
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
    <h1>Edit Swimmer</h1>
   
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" ?>
    <div class="row">
    <div class="col-md-5">
    <h3>Swimmer's Details</h3>
    <div class="form-group">
            <label for="file">Update Picture</label><br>
            <input type="file" name="file" id="file"><br>
            <img width="50px" src="<?php echo $students['student_img']; ?>" alt="">
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $students['name']; ?>">
        </div>
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" name="age" class="form-control" value="<?php echo $students['age']; ?>">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $students['address']; ?>">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $students['email']; ?>">
        </div>
        <div class="form-group">
            <label for="">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $students['phone']; ?>">
    </div>
</div>
    <div class="col-md-5">
    <h3>Parent's Details</h3>
    <div class="form-group">
            <label for="">Father's name</label>
            <input type="text" disabled name="father_name" class="form-control" value="<?php echo $students['father_name']; ?>" required="require">
        </div>
     
       
        <input type="hidden" name="update_id" value="<?php echo $students['id']; ?>">
        <input type="submit" name="submit" value="Submit" class="btn btn-success">
    </form>
    </div>
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