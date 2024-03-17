<?php
session_start();

session_unset(); //session will first unset 
session_destroy(); // then destroy to avoid redirecting the pages without login

header("location: login.php");
exit;
?>