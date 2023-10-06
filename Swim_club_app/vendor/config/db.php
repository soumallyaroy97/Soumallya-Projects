<?php

//create connection
// $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn = mysqli_connect('localhost', 'root', 'password', 'student');

//check connection

if(mysqli_connect_errno()){
  //connection failed
  
  echo 'Failed to connect to MYSQL '. mysqli_connect_errno();
}



?>