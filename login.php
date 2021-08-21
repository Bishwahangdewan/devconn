<?php include_once('./partials/header.php') ?>
<?php include_once('./db/config.php'); ?>

<?php
	$msg = []; 
	$error=[];
	$email='';
	$password;

	if(isset($_GET['status'])){
		$msg[] = "Your Account has been created successfully.";
	};

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$email= '';
		$password= '';

		if(isset($_POST['email']) && isset($_POST['password'])){

			$email = $_POST['email'];
			$password = $_POST['password'];

			//Check if email exists
			$statement = $pdo->prepare("SELECT * FROM members WHERE email = :email");
			$statement->bindValue(':email',$email);
			$statement->execute();
			$user = $statement->fetch(PDO::FETCH_ASSOC);

			if($user){
				//email exists login user
				if($user['password'] == $password){
					//create session
					$_SESSION['email'] = $user['email'];

					header('Location:dashboard.php?status=You have been logged in');
				}else{
					$error[] = "The password does not match.Please re enter your password.";
				}

			}else{
				$error[] = "The Email you entered does not exist";
			}
		}
	}

?>

<!--Success Flash Message -->
<?php if(!empty($msg)): ?>
	<div class="green lighten-2 alert-red"><?php echo $msg[0]; ?></div>
<?php endif; ?>

<!--Error Flash Message -->
<?php if(!empty($error)): ?>
	<div class="red lighten-3 alert-red"><?php echo $error[0]; ?></div>
<?php endif; ?>


<div class="auth-container">
		<h3 class="fw-9 fs-20 center-align">Login to DevConn</h3>
		<p class="center-align">Login with your email and password. </p>
		<br />
		<form action="login.php" method="post">
			<div class="input-field">
				<label for="email">Email : </label>
				<input type="email" name="email" id="email" class="validate" placeholder="Enter Email" required value="<?php echo $email; ?>" />
			</div>
			<br />
			<div class="input-field">
				<label for="password">Password : </label>
				<input type="password" name="password" id="password" class="validate" placeholder="Enter Password" required/>
			</div>
			
			<input type="submit" class="btn amber darken-4" value="Login" />
		</form>

		<p class="center-align pt-40">Don't have an account?<a href="">SignUp Here</a></p>
</div>


<?php include_once('./partials/footer.php') ?>