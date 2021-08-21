<?php include_once('./partials/header.php'); ?>

<?php include_once('./db/config.php'); ?>

<?php 

	$statement = $pdo->prepare("SELECT friends.friend, members.username ,members.email , members.profession , members.profile_pic FROM friends INNER JOIN members ON friends.friend = members.email WHERE friends.user=:user");

	$statement->bindValue(':user',$_SESSION['email']);
	$statement->execute();

	$devs = $statement->fetchall(PDO::FETCH_ASSOC);

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
		<p class="fw-9 fs-30">Your Messages : </p>
		<p class="fw-3 fs-14 pt-10">Chat with your friends.</p>

		<?php foreach ($devs as $i => $dev): ?>
			<div class="body-container mt-10 flex">
				<div class="dev-img-container">
					<img src="./public/profilepics/<?php isset($dev['profile_pic'])? print($dev['profile_pic']):print('defaultprofilepic.png') ; ?>" alt="profilepic" />
				</div>
				<div class="content pl-20 pt-10">
					<div class="row">
						<div class="col s8">
							<p class="fw-7 fs-16"><?php echo $dev['username']; ?></p>
							<p class="fw-4 fs-14"><?php echo $dev['profession']; ?></p>
						</div>
						<div class="col s4 flex">
							<a href="viewmessage.php?email=<?php echo $dev['email']; ?>" class="btn-small amber darken-2 ml-10"><i class="fas fa-envelope white-text"></i> View Messages</a>
						</div>
					</div>
					
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<?php include_once('./partials/footer.php'); ?>