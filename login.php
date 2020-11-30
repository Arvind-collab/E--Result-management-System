<?php
	$current='login';
	include 'core/init.php';
	logged_in_redirect();
	include 'includes/header.php';
	include 'includes/top.php';
	
	
	
	if(empty($_POST)===false)
	{	$username=$_POST['username'];
		$password=$_POST['password'];
		if(empty($username)||empty($password))
			$errors[]='fields marked with * are required...';
		else if(user_exists($username)===false)											
			$errors[]='user does not exists... please register first...!!!';
		else if(user_active($username)===false)
			$errors[]='the account is not activated yet...<br/>please check your email to activate the account...';
		else
		{	if(strlen($password)>32)
			{	$errors[]='password entered is too long';
				}
			$login=login($username,$password);
			if($login===false)
				$errors[]='please enter correct username and password...';
			else
			{	$_SESSION['user_id']=$login;					
				header('Location: access.php');
				exit();
				}
			}
		}		
?>
		<header>Login!</header>
		</div>
		<?php
			if(empty($errors)===false)
			{	?>
				<div id="errors">
					<?php	echo output_errors($errors);?>
				</div>
			<?php
			}
		?>
		<section>
			<form method="post" action="login.php">
			<ul class="Row1">
				<li class="username">
						<input type="text" name="username" id="username" placeholder="User Name*"/>
				</li>
				<li class="password">
						<input type="password" name="password" id="password" placeholder="Password*"/>
				</li>
			
			</ul>
				
					<div class="login">
						<input type="submit" class="push2" value="Login"/>
					</div>
					<div class="register">
					<input type="button" onclick="location.href='register.php'" class="push2" value="Register?"/>
					</div>
			</form>
		</section>
	
	
<?php
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>