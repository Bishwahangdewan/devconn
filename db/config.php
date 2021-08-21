<?php
	$user = 'root';
	$password = 'thisismypassword54321';
	$dsn = 'mysql:host=localhost;port=3306;dbname=devconn';
	$pdo = new PDO($dsn , $user , $password);

	/*try{                 //try catch to check PDO To SQL Connection
		if($pdo){
			echo "DB Connected";
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}*/

	$pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
?>