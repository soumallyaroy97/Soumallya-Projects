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
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Member's Details</li>
      </ol>
    </section>
    <section class="content">
<h1 class="text-primary text-center">Members</h1>


<?php //if(empty($students)): ?>
<!-- <p>No such student available</p> -->
<?php //else: ?>
<?php if($students === NULL): ?>
<p>No such member available</p>
<?php else: ?>

  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Member image</th>
      <th scope="col">name</th>
      <th scope="col">age</th>
      <th scope="col">address</th>
      <th scope="col">Father Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <?php if($students['age']<18 && $_SESSION['uid']==3 || $_SESSION['uid']==1) { ?>
      <th scope="col">Edit Member details</th>
      <th scope="col">Delete Member</th>
      <?php  } ?>
    </tr>
  </thead>
  <tbody>
  

    <tr>
   
      <th scope="row"><?php echo $students['id']; ?></th>
      <td><img width="50px" src="<?php echo $students['student_img']; ?>" alt=""></td>
      <td><?php echo $students['name']; ?></td>
      <td><?php echo $students['age']; ?></td>
      <td><?php echo $students['address']; ?></td>
      <td><?php echo $students['father_name']; ?></td>
      <td><?php echo $students['email']; ?></td>
      <td><?php echo $students['phone']; ?></td>
      <td><a class="btn btn-primary" <?php if($students['age']<18 && $_SESSION['uid']==2) { ?> style="display: none;" <?php  } ?> href="<?php echo ROOT_URL; ?>editmember.php?id=<?php echo $students['id']; ?>">Edit</a></td>
      <td><form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <input type="hidden" name="delete_id" value="<?php echo $students['id']; ?>">
      <input type="submit" name="delete" <?php if($students['age']<18 && $_SESSION['uid']==2) { ?> style="display: none;" <?php  } ?> value="Delete" class="btn btn-outline-danger">
      </form></td>
      
    </tr>

  </tbody>
</table>
</table>
<?php endif; ?>

</div>


<?php require('includes/footer.php'); ?>