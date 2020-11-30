<?php
	include 'core/init.php';  
	logged_in_redirect();
	include 'includes/header.php';
	include 'includes/top.php';
	?>
	<header>Activate!</header>
	</div>
<?php
	if(isset($_GET['success'])===true && empty($_GET['success'])===true)
	{	?>
			<div id="errors">
				<?php echo 'your account has been activated successfully....<br/>
					please ';?><a href="login.php">login</a><?php echo ' to continue...'; ?>
			</div>
		<?php
		}
	else if(isset($_GET['email'],$_GET['email_code'])===true)
	{	$email=trim($_GET['email']);
		$email_code=trim($_GET['email_code']);
		if(email_exists($email)===false)
			$errors[]='sorry, we couldn\'t find the email address ,right now!!!<br/>please try again later or you have to register again...
						<br/><br/>sorry for the inconvinence....';
		else if(activate($email,$email_code)===false)
			$errors[]='we have problems activating your account...<br/>please try again later or you have to register again...
						<br/><br/>sorry for the inconvinence....';
		if(empty($errors)===false)
		{	?>
			<div id="errors">
				<?php	echo output_errors($errors);?>
			</div>
			<?php
			}
		else
		{	header('Location:activate.php?success');
			exit();
			}
		}
	else 
	{	header('Location:index.php');
		exit();
		}
	
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>	