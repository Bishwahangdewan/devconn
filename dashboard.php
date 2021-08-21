<?php include_once('./partials/header.php') ?>
<?php include_once('./db/config.php'); ?>

<?php 
	$msg=[];
	$error=[];
	if(isset($_GET['status'])){
		$msg[] = $_GET['status'];
	}

	$statement = $pdo->prepare('SELECT posts.id , posts.caption, posts.post_pic, posts.posted_by , posts.created_at , posts.likes , members.username , members.profile_pic FROM posts INNER JOIN members ON members.email = posts.posted_by ORDER BY created_at DESC');
	$statement->execute();

	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">

<!--Success Flash Message -->
<?php if(!empty($msg)): ?>
	<div class="green lighten-2 alert-front"><?php echo $msg[0]; ?></div>
<?php endif; ?>

<!--Error Flash Message -->
<?php if(!empty($error)): ?>
	<div class="red lighten-3 alert-red"><?php echo $error[0]; ?></div>
<?php endif; ?>

	<div class="row">
		<div class="col s7">
			<div class="dash-container p-20 white">
				<p class="fs-20 fw-9 pb-20 pt-10">Post your story</p>
				<p class="-mt10">Tell us about your day.</p>
				<form action="post.php" method="POST" enctype="multipart/form-data">
					<div class="input-field">
						<div class="file-field input-field">
      						<div class="btn-small waves-effect light-blue darken-2">
       							 <span class="white-text">Choose File</span>
       							 <input type="file" name="post_image">
      						</div>
     					 <div class="file-path-wrapper">
        					<input class="file-path validate" type="text" name="post_image">
      					 </div>
    				</div>
					</div>
					<div class="input-field">
						<label for="caption">Add a Caption:</label>
						<textarea id="caption" name="caption" class="materialize-textarea"></textarea>
					</div>
					
					<input type="submit" value="Post" class="btn amber darken-4 mb-3"/>
				</form>
			</div>

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
					
					<div class="post-buttons mt-20 mb-10 flex">
						<button class="btn-small red lighten-1 mr-10"><i class="fas fa-thumbs-up white-text"></i> <?php echo $post['likes']; ?> Likes</button>
						<form method="POST" action="likepost.php?like=TRUE&id=<?php echo $post['id'] ?>&liked_by=<?php echo $_SESSION['email']; ?>" >
							<input type="submit" value="like" class="btn-small light-blue darken-2" />
						</form>
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
					
					<div class="post-buttons mt-10 flex ">
						<button class="btn-small red lighten-1 mr-10"><i class="fas fa-thumbs-up white-text"></i> <?php echo $post['likes'] ?> Likes</button>
						<form method="POST" action="likepost.php?like=TRUE&id=<?php echo $post['id'] ?>&liked_by=<?php echo $_SESSION['email']; ?>" >
							<input type="submit" value="like" class="btn-small light-blue darken-2" />
						</form>
					</div>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="col s5 fixed">
			<div class="dash-container p-20 white">
				<p class="fs-20 fw-9 pt-10 pb-10">Update Your Profile</p>
				<p class="fs-14 pb-10">Add your personal information so that people can know more about you.</p>
				<a href="updateProfile.php" class="btn-small amber darken-4 mb-3">Edit Profile</a>
			</div>


			<div class="dash-container p-20 white">
				<p class="fs-20 fw-9 pt-10 pb-10">Connect with Devs</p>
				<p class="fs-14 -mt10 pb-10">Connect with other developers.</p>
				<a href="finddev.php" class="btn-small amber darken-4 mb-3">More</a>
			</div>
		</div>
	</div>

</div>


<?php include_once('./partials/footer.php') ?>