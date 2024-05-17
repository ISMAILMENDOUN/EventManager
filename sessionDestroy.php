<?php
if($_GET['var']=="d"){
session_start();

session_destroy();
header('Location:index.php');
}
?>