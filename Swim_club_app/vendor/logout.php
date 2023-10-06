<?php require('config/db.php'); ?>
<?php require('config/config.php'); ?>
<?php

session_start();
session_destroy();
header('location:' .ROOT_URL.'');

?>