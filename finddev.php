<?php include_once('./partials/header.php'); ?>
<?php include_once('./db/config.php'); ?>

<?php 
	$error=[];
	$msg=[];

	//get members data
	$statement = $pdo->prepare("SELECT username , email , profile_pic , profession FROM members WHERE email != :email LIMIT 10");
	$statement->bindValue(':email',$_SESSION['email']);
	$statement->execute();

	$devs = $statement->fetchAll(PDO::FETCH_ASSOC);

	//get all friends email
	$statement1 = $pdo->prepare("SELECT * FROM friends WHERE user=:email");
	$statement1->bindValue(':email',$_SESSION['email']);
	$statement1->execute();

	$friends = $statement1->fetchAll(PDO::FETCH_ASSOC);
	

	//filter relation
		$newarr = [];
		foreach ($devs as $key => $dev) {
			$count=0;
			foreach ($friends as $k => $friend) {
				if($dev['email'] == $friend['friend']){
					$count++;
				}
			}
			if($count == 0){
				$newarr[] = $dev;
			}
		}
		

	//Follow Check
	if(isset($_GET['email'])){

		$statement = $pdo->prepare("SELECT * FROM friends WHERE user=:user AND friend=:friend");
		$statement->bindValue(':user' , $_SESSION['email']);
		$statement->bindValue(':friend', $_GET['email']);
		$statement->execute();

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		if(empty($data)){
			//CREATE FRIEND RELATION
			$statement = $pdo->prepare("INSERT INTO friends (user,friend) VALUES (:user,:friend)");
			$statement->bindValue(':user' , $_SESSION['email']);
			$statement->bindValue(':friend', $_GET['email']);
			$statement->execute();

			$msg[] = "You followed this dev.";

		}else{
			$error[] = "You already follow this dev. ";
		}
	}
?>

 <!--Error Flash Message -->
<?php if(!empty($error)): ?>
	<div class="red lighten-3 alert-red"><?php echo $error[0]; ?></div>
<?php endif; ?>

<!--Success Flash Message -->
<?php if(!empty($msg)): ?>
	<div class="green lighten-2 alert-red"><?php echo $msg[0]; ?></div>
<?php endif; ?>

<div class="container pt-20">
	<div class="body-container">
		<p class="fw-9 fs-30">Find other Developers</p>
		<p class="fw-3 fs-14 pt-10">Meet other Devs and make friends with them.</p>

		<?php foreach ($newarr as $i => $dev): ?>
			<div class="body-container mt-10 flex">
				<div class="dev-img-container">
					<img src="./public/profilepics/<?php isset($dev['profile_pic'])? print($dev['profile_pic']):print('defaultprofilepic.png') ; ?>" alt="profilepic" />
				</div>
				<div class="content pl-20 pt-10">
					<div class="row">
						<div class="col s7">
							<p class="fw-7 fs-16"><?php echo $dev['username']; ?></p>
							<p class="fw-4 fs-14"><?php echo $dev['profession']; ?></p>
						</div>
						<div class="col s5 flex">
							<a href="finddev.php?email=<?php echo $dev['email']; ?>" class="btn-small light-blue darken-2"><i class="fas fa-user-plus white-text"></i> Follow</a>
							<a href="viewprofile.php?email=<?php echo $dev['email']; ?>" class="btn-small red lighten-1 ml-10"><i class="fas fa-user white-text"></i> View Profile</a>
						</div>
					</div>
					
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<?php include_once('./partials/footer.php') ?>