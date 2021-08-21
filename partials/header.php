<?php
	session_start();

	//check for user session
	if(isset($_SESSION['email'])){
		$isLoggedIn = TRUE;
	}else{
		$isLoggedIn = FALSE;
	}
 ?>

 <style><?php include_once('./style/styles.css') ?></style>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DevConn</title>

	 <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Google Fonts Link -->
    <link rel="stylesheet" href="https://fonts.google.com/share?selection.family=Roboto:wght@100;300;400;500;700;900">

    <!-- Font-Awesome Kits -->
    <script src="https://kit.fontawesome.com/b9615f4769.js" crossorigin="anonymous"></script>

</head>
<body>

	<div class="navbar-fixed ">
    <nav>
      <div class="nav-wrapper grey darken-4">
      	<div class="container">
        <a href="#!" class="fw-9 fs-20">DevConn</a>
        <ul class="right hide-on-med-and-down">
         
         	<?php if($isLoggedIn): ?>
         		<li><a href="dashboard.php" class="fs-14 fw-3">Feed</a></li>
         		<li><a href="profile.php" class="fs-14 fw-3">Profile</a></li>
         		<li><a href="devfriends.php" class="fs-14 fw-3">Dev Friends</a></li>
         		<li><a href="finddev.php" class="fs-14 fw-3">Find Devs</a></li>
         		<li><a href="message.php" class="fs-14 fw-3">Messages</a></li>
         		<li><a href="logout.php" class="fs-14 fw-3">Logout</a></li>
         	<?php else: ?>
         		<li><a href="signup.php" class="fs-14 fw-3">Signup</a></li>
         		<li><a href="login.php" class="fs-14 fw-3">Login</a></li>
         	<?php endif; ?>
        </ul>
    </div>
      </div>
    </nav>
  </div>