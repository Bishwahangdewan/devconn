<?php include_once('./db/config.php'); ?>

<?php
//like post
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$postid = $_GET['id'];
		$email = $_GET['liked_by'];

		$statement = $pdo->prepare('SELECT * FROM likes WHERE post = :id  AND liked_by = :liked');
		$statement->bindValue(':id' , $postid);
		$statement->bindValue(':liked',$email);
		$statement->execute();

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

		if(empty($data)){
			//add like
				$statement = $pdo->prepare('INSERT INTO likes (post_like , post , liked_by) values (:post_like , :post , :liked_by)');
				$statement->bindValue(':post_like' , TRUE);
				$statement->bindValue(':post',$postid);
				$statement->bindValue(':liked_by',$email);
				$statement->execute();

				$statement1 = $pdo->prepare('SELECT likes FROM posts WHERE id = :postid');
				$statement1->bindValue(':postid' , $postid);
				$statement1->execute();

				$likes = $statement1->fetchAll(PDO::FETCH_ASSOC);
				
				$newlike = $likes[0]['likes'] + 1;
				echo $newlike;

				$statement2 = $pdo->prepare('UPDATE posts SET likes = :newlike WHERE id = :postid');
				$statement2->bindValue(':newlike',$newlike);
				$statement2->bindValue(':postid' , $postid);
				$statement2->execute();

				header('Location:dashboard.php?status=You liked this post');

		}else{
			//don't like
			header('Location:dashboard.php?status=You have already liked this post');
		}
	}

?>