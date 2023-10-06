
<?php require('config/db.php'); ?>
<?php require('config/config.php'); ?>
<?php
session_start();
if(!isset($_SESSION['uid'])){
  
   header('location: '.ROOT_URL.'index.php');
  
}
?>
<?php
if(isset($_POST['submit'])){
    //get form data
    //check for required fields


    $files = $_FILES['file'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email= mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);

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

    if( ($_FILES['file']["error"] == 4) || ($_POST['name'] == "") || ($_POST['age'] == "") || ($_POST['address'] == "") || ($_POST['email'] == "") ||($_POST['phone'] == "")){

        echo "<small>Fill all the fields..</small><br>";
        }else{
            $query = "INSERT INTO student(student_img, name, age, address, father_name, email, phone) VALUES('$destfile', '$name', '$age', '$address', '$father_name', '$email', '$phone')";
        
        
        if(mysqli_query($conn, $query)){
            header('Location: '.ROOT_URL.'member_list.php');
        }else{
            echo 'ERROR '. mysqli_error($conn); 
        }
        }

// else{
    
//     $msg = 'Please Fill in all tha fields';
//     $msgClass = 'alert-danger';
// }
    //print_r($filename);
   

    

    //print_r($filename);
    
}
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
        <li class="active">Add A New Member</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     

     
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-md-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="container">
<?php //if($msg != ''): ?>
<!-- <div class="alert <?php //echo $msgClass; ?>"><?php// echo $msg; ?></div>  -->
<?php //endif; ?>
    <h1>Add Member</h1>
    <div class="col-md-10">
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" ?>
    <div class="row box-body box-profile">
    <div class="col-md-6">
   
    <div class="form-group">
            <label for="file">Add Picture</label><br>
            <input type="file" name="file" id="file" required="require">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Member Name" data-rule-required="true"
                                                    data-msg-required="Please Member Name" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="">Age</label>
            <input type="text" name="age" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" name="address" class="form-control">
        </div>
       
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
    <h3>Parent's Details</h3>
    <div class="form-group">
            <label for="">Father's Name</label>
            <input type="text" name="father_name" class="form-control" required="require">
        </div>
       
    </div>
        
       
        
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-success">
    </form>
    </div>
</div>
          <!-- /.nav-tabs-custom -->

   
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