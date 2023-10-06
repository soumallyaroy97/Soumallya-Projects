<?php

require('config/db.php');
require('config/config.php');
// session_start();
// if(!isset($_SESSION['uid'])){
  
//    header('location: '.ROOT_URL.'index.php');
  
// }
$qry = 'SELECT * FROM user';

//get result

$result = mysqli_query($conn, $qry);

//fetch data

$admin = mysqli_fetch_all($result, MYSQLI_ASSOC);

//var_dump($student);
//free result

mysqli_free_result($result);

//close connection

mysqli_close($conn);


?>

<?php require('includes/header.php');?>
<?php require('includes/left-menu.php'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin's Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Admin's profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <!-- Profile Image --> <?php foreach($admin as $admins): ?>
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                            src="dist/img/user1-128x128.jpg" alt="User profile picture">
                            <h3 class="profile-username text-center">Alexander Pierce</h3>
                        

                        <ul class="list-group list-group-bordered">
                            <li class="list-group-item">
                                <b>Username : <?php echo $admins['username']; ?></b>
                            </li>
                            <li class="list-group-item">
                                <b>Role : <?php echo $admins['role']; ?></b>
                            </li>
                           
                        </ul>
                        

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <?php endforeach; ?>
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