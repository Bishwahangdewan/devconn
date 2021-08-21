<?php 
	//logout user by destroying session 
	session_start();
	$_SESSION = [];
	setcookie(session_name(),'',time() - 2592000 , '/');
	session_destroy();

	header('Location:index.php?status=1');
?>