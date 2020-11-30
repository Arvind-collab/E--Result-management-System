<?php
    include "core/init.php";
	if(logged_in() === true)
	{	header("Location:index.php");
		exit();
	}
	$current='register';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(empty($_POST)===false)
	{	$required_fields=array('username','department','first_name','email','password','re_password');
		foreach($_POST as $key=>$value)
		{	if(empty($value)&&in_array($key,$required_fields)===true)
			{	$errors[]='Fields marked with * are required';
				break 1;
				}
			}
		if(empty($errors)===true)
		{	$result=check_account($_POST['first_name'],$_POST['last_name'],$_POST['department']);
			if(mysqli_num_rows($result)==0)
				$errors[]='Sorry you are not authorized to register...<br/>Please contact your semester coordinator or IT department for authorization...';
			else
			{	$result=mysqli_fetch_assoc($result);
				if(empty($result['username'])===false)
					$errors[]='You have been registered already...';
				else
				{	if(user_exists($_POST['username'])===true)
						$errors[]='Sorry the username \''.$_POST['username'].'\' is already taken...';
		
					if(preg_match("/\\s/",$_POST['username'])==true)				
						$errors[]='your username must not contain any spaces...';
					
					if(strlen($_POST['password'])<6)
						$errors[]='your password must be atleast 6 characters';
					
					if($_POST['password']!==$_POST['re_password'])
						$errors[]='your passwords don\'t match...';
					
					if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false)
						$errors[]='A valid email address is required';
						
					if(email_exists($_POST['email'])===true)
						$errors[]='Sorry the email \''.$_POST['email'].'\' is already in use.';
					}
				}
			}
		}
	?>

	<header>Register!</header>
	</div>
	<?php
	if(isset($_GET['success'])&&empty($_GET['success']))
	{	?>
			<div id="errors">
				<?php echo "you have been registered successfully... <br/><br/>Please check your email to activate your account...!!!"; ?>
			</div>
		<?php
		}
	else	
	{	if(empty($_POST)===false&&empty($errors)===true)
		{	$register_data=array(
							'username'		=>  $_POST['username'],
							'department'	=>  $_POST['department'],
							'first_name'	=>  $_POST['first_name'],
							'last_name'		=>  $_POST['last_name'],
							'email'			=>  $_POST['email'],
							'phone'			=>  $_POST['phone'],
							'password'		=>  $_POST['password'],
							'email_code'	=>  md5($_POST['username']+microtime())
							);
			register_user($register_data);
			header('Location:register.php?success'); 
			exit();
			}
		else if(empty($errors)===false)
		{	?>
				<div id="errors">
					<?php	echo output_errors($errors);?>
				</div>
			<?php
			}
		?>
		<section>
			<form method="post" action=" ">
			<ul class="Row1">
				<li class="username">
						<input type="text" name="username" id="username" placeholder="User Name*"/>
				</li>
				<li class="Department">
						<select name="department">
							<option value="" class="list1">-- Select Department* --</option>	
							<option value="Information Technology" class="list1">Information Technology</option>
							<option value="Computer Science" class="list1">Computer Science</option>
							<option value="Electronics And Communication" class="list1">Electronics And Communication</option>
							<option value="Mechanical Engineering" class="list1">Mechanical Engineering</option>
							<option value="Metallurgy Engineering" class="list1">Metallurgy Engineering</option>
							<option value="Electrical Engineering" class="list1">Electrical Engineering</option>
							<option value="Civil Engineering" class="list1">Civil Engineering</option>
							<option value="Chemical Engineering" class="list1">Chemical Engineering</option>
							<option value="Mathematics Department" class="list1">Mathematics</option>
							<option value="Physics" class="list1">Physics</option>
						</select>
				</li>
			</ul>
			<ul class="Row2">
				<li class="first name">
						<input type="text" name="first_name" id="first_name" placeholder="First name*"/>
				</li>
				<li class="last name">
						<input type="text" name="last_name" id="last_name" placeholder="Last name"/>
				</li>
			</ul>
			<ul class="Row3">
				<li class="email">
						<input type="text" name="email" id="email" placeholder="Email*"/>
				</li>
				<li class="password">
						<input type="password" name="password" id="password" placeholder="Password*"/>
				</li>
			</ul>
			<ul class="Row4">
				<li class="phone">
						<input type="text" name="phone" id="phone" placeholder="Contact Number"/>
				</li>
				<li class="password">
						<input type="password" name="re_password" id="password" placeholder="Confirm Password*"/>
				</li>
			</ul>
					 <div class="register">
						<input type="submit" class="push2" value="Register"/>
					 </div>
					 <div class="login">
						<input type="button" onclick="location.href='login.php'" class="push2" value="Login?"/>
					 </div>
			</form>
		</section>
		
		<?php
		}
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>