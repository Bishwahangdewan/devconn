<?php include_once('./partials/header.php') ?>
<?php include_once('./db/config.php'); ?>

<?php
	$error = [];
	//GET PROFILE DATA FIRST
	$statement = $pdo->prepare('SELECT * FROM members where email=:email');
	$statement->bindValue(':email', $_SESSION['email']);
	$statement->execute();
	$profile = $statement->fetch(PDO::FETCH_ASSOC);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['username'])){
			//UPDATE
			$username = $_POST['username'];
			$profession = $_POST['profession'];
			$bio = $_POST['bio'];
			$address = $_POST['address'];
			$github = $_POST['github'];
			$education = $_POST['education'];
			$email = $profile['email'];

			$statement = $pdo->prepare("UPDATE members SET username=:username , profession=:profession , bio=:bio , address=:address , github=:github , education=:education  WHERE email = :email");

			$statement->bindValue(':username',$username);
			$statement->bindValue(':profession',$profession);
			$statement->bindValue(':bio',$bio);
			$statement->bindValue(':address',$address);
			$statement->bindValue(':github',$github);
			$statement->bindValue(':education',$education);
			$statement->bindValue(':email',$email);

			$statement->execute();

			header("Location:profile.php?status=1");

		}else{
			$error[] = "Please enter Username";
		}
	}
 ?>

 <!--Error Flash Message -->
<?php if(!empty($error)): ?>
	<div class="red lighten-3 alert-red"><?php echo $error[0]; ?></div>
<?php endif; ?>

<div class="container">
	<p class="fs-30 fw-9">Update Your Profile</p>
	<p class="fw-4 -mt10 mb-3">Update your profile and let people know more about yourself.</p>

	<form action="updateProfile.php" method="POST">
          <div class="input-field">
	          <input placeholder="Placeholder" name="username" id="username" type="text" name="username" class="validate" required value=<?php echo ucwords($profile['username']); ?> >
	          <label for="username">Username</label>
          </div><br>

          <div class="input-field">
	          <input placeholder="Placeholder" name="profession" id="profession" type="text" class="validate" value=<?php echo ucwords($profile['profession']); ?>>
	          <label for="profession">What's your Profession?</label>
          </div><br>

          <div class="input-field">
	        	<textarea id="bio" name="bio" class="materialize-textarea"><?php echo ucwords($profile['bio']); ?></textarea>
	          <label for="bio">Say Someting about yourself</label>
          </div><br>

           <div class="input-field">
	        	<input type="date" id="date" name="date">
	          <label for="date">When is your Birthday?</label>
          </div><br>

          <div class="input-field">
	        	<input type="text" id="address" name="address" value=<?php echo ucwords($profile['address']); ?>>
	          <label for="address">Where do you live?</label>
          </div><br>

           <div class="input-field">
	        	<input type="text" id="github" name="github" value=<?php echo ucwords($profile['github']); ?>>
	          <label for="github">Have Github?</label>
          </div><br>

           <div class="input-field">
	        	<input type="text" id="education" name="education" value=<?php echo ucwords($profile['education']); ?>>
	          <label for="education">Where do/did you study?</label>
          </div><br>

          <input type="submit" class="btn amber darken-4" value="Update">
	</form>
</div>

<?php include_once('./partials/footer.php') ?>
