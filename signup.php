<?php include_once('./partials/header.php') ?>
<?php include_once('./db/config.php') ?>

<?php 
	$error = [];

	//USER SIGNUP CLICK CHECK
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		//check for all the inputs
		if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpassword'])){

			//destroy session if exists
			if(isset($_SESSION['user'])){
				destroySession();
			}

			$username = strtolower($_POST['username']);
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirmpassword = $_POST['confirmpassword'];

			//PASSWORD CHECK
			if($password == $confirmpassword){

				//CHECK IF USER ALREADY CREATED
				$statement = $pdo->prepare("SELECT * FROM members where email = :email");
				$statement->bindValue(':email' , $email);
				$statement->execute();
				$user = $statement->fetch(PDO::FETCH_ASSOC);

				if($user){
					$error[] = "A user with this email already exists";
				}else{

					//CREATE USER
					$statement = $pdo->prepare("INSERT INTO members (username , email , password) values (:username , :email , :password)");

					$statement->bindValue(':username',$username);
					$statement->bindValue(':email',$email);
					$statement->bindValue(':password',$password);
					$statement->execute();

					header('Location:login.php?status=1');
				}

			}else{
				$error[] = 'passwords do not match';
			}


		}else{
			$error[] = "Please fill in all Fields";
		}
	}
?>

<?php if(!empty($error)): ?>
	<div class="red lighten-3 alert-red"><?php echo $error[0]; ?></div>
<?php endif; ?>


<div class="auth-container">
		<h3 class="fw-9 fs-20 center-align">SignUp to DevConn</h3>
		<p class="center-align">Welcome to DevConn. Please fill the following fields. </p>
		<br />
		<form action="signup.php" method="post">
			<div class="input-field">
				<label for="username">Username : </label>
				<input type="text" name="username" id="username" class="validate" placeholder="Enter Username" required />
			</div>
			<br />
			<div class="input-field">
				<label for="email">Email : </label>
				<input type="email" name="email" id="email" class="validate" placeholder="Enter Email" required />
			</div>
			<br />
			<div class="input-field">
				<label for="password">Password : </label>
				<input type="password" name="password" id="password" class="validate" placeholder="Enter Password" required/>
			</div>
			<br />
			<div class="input-field">
				<label for="confirmpassword">Confirm Password : </label>
				<input type="password" name="confirmpassword" id="confirmpassword" class="validate" placeholder="Enter Confirm Password"required/>
			</div>
			<br />
			<input type="submit" class="btn amber darken-4" value="Sign Up" />
		</form>

		<p class="center-align pt-40">Already have an account?<a href="">Login Here</a></p>
</div>

<?php include('./partials/footer.php') ?>