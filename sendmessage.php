<?php include_once('./db/config.php'); ?>

<?php
	session_start();

	$email;

	if(isset($_GET['email'])){
		$email = $_GET['email'];
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$message = $_POST['message'];
		$sender = $_SESSION['email'];
		$receiver = $email;

		$statement = $pdo->prepare("INSERT INTO messages (message , sender , receiver) values (:message,:sender,:receiver)");
		$statement->bindValue(':message',$message);
		$statement->bindValue(':sender',$sender);
		$statement->bindValue(':receiver',$receiver);
		$statement->execute();

		header("Location:viewmessage.php?email=".$email);
	}
 ?>