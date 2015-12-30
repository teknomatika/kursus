<?php session_start();
include '_db.php';
unset($_SESSION['username']);
unset($_SESSION['userid']);
unset($_SESSION['level']);
eksyen('Good bye!','index.php');