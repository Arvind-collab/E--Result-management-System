<?php
    include "core/init.php";
	protect_page();
	$current='access';
	$here='account';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(empty($_POST)===false)
	{	$required_fields = array('current_password','password','re_password');
		foreach($_POST as $key=>$value)
		{	if(empty($value)&&in_array($key,$required_fields)===true)
			{	$errors[]='Fields marked with * are required';
				break 1;
				}
			}
		if(empty($errors)===true)
		{	if(md5($_POST['current_password'])===$user_data['password'])
			{	if(trim($_POST['password'])!==trim($_POST['re_password']))	// trim removes any white space on the left & right os the actual string of exists
					$errors[]='your new passwords do not match';
				else if(strlen($_POST['password'])<6)
					$errors[]='your password must be atleast 6 characters..';
				}
			else
				$errors[]='your current password is incorrect...';
			}
		}
?>
		<header><?php echo $user_data['first_name'];?></header>
		</div>
		
		<div class="wrapvert">
			<div class="balancebar">
				<h2>Change Password</h2>
				<?php
					if(isset($_GET['success'])&&empty($_GET['success']))
					{	?>
							<div id="errors">
								<?php echo 'your passsword has been changed successfully...'; ?>
							</div>
						<?php
						}
					else
					{	if(empty($_POST)===false && empty($errors)===true)
						{	change_password($user_data['user_id'],$_POST['password']);
							header('Location:change_password.php?success');
							}
						if(empty($errors)===false)
						{	?>
							<div id="errors">
								<?php	echo output_errors($errors);?>
							</div>
							<?php
							}
						?>
							<br/><br/>
							<form action="" method="post">
								Current password*:<br/>
								<input type="password" name="current_password"><br/><br/>
								New password*:<br/>
								<input type="password" name="password"><br/><br/>
								Re enter New password*:<br/>
								<input type="password" name="re_password"><br/><br/>
								<input type="submit" value="Change Password">
							</form>
						<?php
						}
				?>
			</div>
		</div>	
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>