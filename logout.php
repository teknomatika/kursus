<?php session_start();
include '_db.php';
$db = new Database();
$db->connect();
$db->update('users',array('logged'=>'0'),"id='".$_SESSION['id']."'");
unset($_SESSION['nama']);
unset($_SESSION['id']);
unset($_SESSION['level']);
eksyen('Good bye!','index.php');