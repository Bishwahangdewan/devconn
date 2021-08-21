<?php include_once('./partials/header.php'); ?>
<?php include_once('./db/config.php'); ?>

<?php
	$msg=[];
	$error = [];

	$statement = $pdo->prepare('SELECT posts.caption, posts.post_pic, posts.posted_by , posts.created_at , posts.likes , members.username , members.profile_pic FROM posts INNER JOIN members ON members.email = posts.posted_by WHERE posts.posted_by = :email');
	$statement->bindValue(':email',$_SESSION['email']);
	$statement->execute();

	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

	if(isset($_GET['status'])){
		$msg[] = "Your Profile has been updated successfully";
	} 

	//fetch user data
	$statement = $pdo->prepare("SELECT * FROM members WHERE email=:email ");
	$statement->bindValue(':email',$_SESSION['email']);
	$statement->execute();

	$user = $statement->fetch(PDO::FETCH_ASSOC);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(empty($_FILES['profile-pic']['name'])){
			$error[] = "Please upload a photo";
		}else{
			//move uploaded file to a folder
			$filename=date("s") . $_FILES['profile-pic']['name'];
			$saveto = "public/profilepics/". $filename;
			move_uploaded_file($_FILES['profile-pic']['tmp_name'],$saveto);

			//delete prev profile pic
			$delfile = $user['profile_pic'];
			$delpath = './public/profilepics/'.$delfile;  
			unlink($delpath);

				//update profile_pic
				$statement=$pdo->prepare("UPDATE members SET profile_pic = :profile WHERE email=:email");
				$statement->bindValue(':profile',$filename);
				$statement->bindValue(':email',$_SESSION['email']);
				$statement->execute();

				header("Location:profile.php?status=2");
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

<div class="row mt-20">
	<div class="container white p-10 border-silver">
		<div class="row mt-20">
			<div class="col s5">
				<div class="profile-image-container mt-10">
					<img src="./public/profilepics/<?php empty($user['profile_pic'])? print('defaultprofilepic.png') : print($user['profile_pic']); ?>" alt="profile-pic">
				</div>
				<form action="profile.php" method="POST" enctype="multipart/form-data">
						<div class="file-field input-field">
      						<div class="btn-small waves-effect light-blue darken-2">
       							 <span class="white-text"><i class="fas fa-user-edit white-text"></i> Upload ProfilePic</span>
       							 <input type="file" name="profile-pic">
      						</div>

      						<div class="file-path-wrapper">
		        				<input class="file-path validate" type="text">
		      				</div>
  
    					<input type="submit" class="btn-small light-blue darken-2 mt-10" value="Change" name="submit">
					</div>
				</form>
			</div>
			<div class="col s7">
				<p class="fw-7 fs-30 pt-30"><?php echo $user['username'];?></p>
				<p class="fw-7 fs-16 pt-10"><?php echo $user['profession'];?></p>
				<p class="fw-4 fs-14 pt-10"><?php echo $user['bio'];?></p></div>
			</div>
		<br>
		<hr />

		<div class="row pt-20">
			<div class="col s4">
				<p class="fw-9 fs-20">About <?php echo $user['username'];?></p>
				<p class="fw-4 fs-14"><i class="fas fa-birthday-cake pr-10 pt-20 pb-10"></i> 14 January 2000</p>
				<p class="fw-4 fs-14"><i class="fas fa-map-marker-alt pr-10 pb-10"></i> <?php echo $user['address'];?></p>
				<p class="fw-4 fs-14"><i class="fab fa-github pr-10 pb-10"></i> <?php echo $user['github'];?></p>
				<p class="fw-4 fs-14"><i class="fas fa-user-graduate pr-10 pb-10"></i> <?php echo $user['education'];?></p>
				<a href="updateProfile.php" class="btn-small amber darken-4 mt-10"><i class="fas fa-user-edit white-text pr-10"></i> Edit Profile</a>
			</div>

			<div class="col s8">
				<?php foreach($posts as $key => $post): ?>
				<?php if(empty($post['post_pic'])): ?>
						<div class="dash-container white">
					<div class="post-top">
						<div class="post-profile-img-container">
							<img src="./public/profilepics/<?php echo $post['profile_pic'];?>" alt="profile-pic">
						</div>
						<p class="fw-9 fs-16 pl-10 mt-15"><?php echo $post['username'] ?></p>
					</div>
					<div class="post-body">
						<div class="post-caption mt-20">
							<p class="fw-4"><?php echo $post['caption']; ?>
						</div>
					</div>
					
					<div class="post-buttons mt-20 mb-10">
						<button class="btn-small red lighten-1"><i class="fas fa-thumbs-up white-text"></i> <?php echo $post['likes']; ?> Likes</button>
					</div>
				</div>
					<?php else: ?>
					<div class="dash-container white">
					<div class="post-top">
						<div class="post-profile-img-container">
							<img src="./public/profilepics/<?php echo $post['profile_pic'];?>" alt="profile-pic" alt="profile-pic">
						</div>
						<p class="fw-9 fs-16 pl-10 mt-10"><?php echo $post['username'] ?></p>
					</div>
					<div class="post-body mt-10">
						<div class="post-body-img-container">
							<img src="./public/posts/<?php echo $post['post_pic'];?>" alt="post_pic">
						</div>
						<div class="post-caption mt-10">
							<p class="fw-4"><b><?php echo $post['username'] ?> : </b> <?php echo $post['caption'] ?></p>
						</div>
					</div>
					
					<div class="post-buttons mt-10">
						<button class="btn-small red lighten-1"><i class="fas fa-thumbs-up white-text"></i> <?php echo $post['likes'] ?> Likes</button>
					</div>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
			
		</div>
	</div>
</div>

<?php include_once('./partials/footer.php'); ?>