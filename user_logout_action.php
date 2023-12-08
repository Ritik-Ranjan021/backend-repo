<?php
	session_start();

	session_unset();
   	session_destroy();
   	header("location:user_login.php?status=2"); //LOGOUT SUCCESS
   	exit();
?>