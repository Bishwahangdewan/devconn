<?php include_once('./db/config.php'); ?>

<?php
session_start();
//post
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(empty($_POST['post_pic']) && empty($_POST['caption'])){
			header('Location:dashboard.php?status=Upload image or a photo');
		}else{
			//post or caption
			if(empty($_FILES['post_image']['name'])){
				//caption	
				$caption = $_POST['caption'];

				$statement = $pdo->prepare('INSERT INTO posts (caption,post_pic,likes,posted_by) values (:caption,:post_pic,:likes,:posted_by)');
				$statement->bindValue(':caption',$caption);
				$statement->bindValue(':post_pic','');
				$statement->bindValue(':likes',0);
				$statement->bindValue(':posted_by',$_SESSION['email']);
				$statement->execute();

				header('Location:dashboard.php?status= Your status has been posted');
			}else{
				//image is there
				$filename = Date('s') . $_FILES['post_image']['name'];
				$destination = './public/posts/'.$filename;
				move_uploaded_file($_FILES['post_image']['tmp_name'], $destination);

				$caption = $_POST['caption'];

				$statement = $pdo->prepare('INSERT INTO posts (caption,post_pic,likes,posted_by) values (
					:caption,:post_pic,:likes,:posted_by)');

				$statement->bindValue(':caption' , $caption);
				$statement->bindValue(':post_pic' , $filename);
				$statement->bindValue(':likes' , 0);
				$statement->bindValue(':posted_by' , $_SESSION['email']);
				$statement->execute();

				header('Location:dashboard.php?status= Your posted has been posted');
				
			};
		}
	}
	?>