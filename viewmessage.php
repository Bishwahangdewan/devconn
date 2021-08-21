<?php include_once('./partials/header.php'); ?>

<?php include_once('./db/config.php'); ?>
		
<?php 

	$email = [];
	$messages = [];
		
	if(isset($_GET['email'])){
		$email = $_GET['email'];
	}

	$statement = $pdo->prepare("SELECT members.username, members.email , messages.message , messages.created_at FROM messages INNER JOIN members ON messages.sender = members.email WHERE messages.sender = :email AND messages.receiver = :email1 OR messages.sender= :email2 AND messages.receiver = :email3 ORDER BY messages.created_at");
	$statement->bindValue(':email' , $_SESSION['email']);
	$statement->bindValue(':email1' , $email);
	$statement->bindValue(':email2' , $email);
	$statement->bindValue(':email3' , $_SESSION['email']);
	$statement->execute();

	$messages = $statement->fetchAll(PDO::FETCH_ASSOC);

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
		<p class="fw-9 fs-30 mb-10 pb-30">Your Messages : </p>

		<div class="pt-10 border-silver p-10 mb-2 mt-10 pb-2">	
			<?php foreach($messages as $key => $message): ?>
				<?php if($message['email'] == $_SESSION['email']): ?>
					<p class="fw-9 pb-20 text-right"><?php echo "You"; ?> : <span class="fw-4 amber lighten-4 p-10 br-10"><?php echo $message['message']; ?></span></p>

				<?php else: ?>
					<p class="fw-9 pb-20"><?php echo $message['username']; ?> : <span class="fw-4 light-blue lighten-5 p-10 br-10"><?php echo $message['message']; ?></span></p>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>

		<form method="post" action="sendmessage.php?email=<?php echo $email ; ?>" class="border-silver p-10 block">
			<div class="input-field col s12">
          		<textarea id="textarea1" class="materialize-textarea" name="message"></textarea>
          		<label for="textarea1">Say Something</label>
        	</div>

        	<input type="submit" class="btn-small" value="Send Message" />
		</form>
	</div>
</div>

<?php include_once('./partials/footer.php'); ?>