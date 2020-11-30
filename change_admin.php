 <?php
    include 'core/init.php';
	protect_page();

	if(preg_match("/admin/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='account';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(empty($_POST)===false)
	{	$required_fields = array('password','re_password');
		foreach($_POST as $key=>$value)
		{	if(empty($value)&&in_array($key,$required_fields)===true)
			{	$errors[]='Please enter your current password...';
				break 1;
				}
			}
		if(empty($errors)===true)
		{	if($_POST['password']!==$_POST['re_password'])
				$errors[]='your passwords do not match...';
			else if(md5($_POST['password'])!==$user_data['password'])
				$errors[]='your have entered an incorrect password...';
			}
		}
?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
				Here, you can give the <strong>Admin Rights</strong> for this website to someone else .
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<div class="balancebar">
			<h2>Change Admin</h2>
			<?php
				if(isset($_GET['success'])===false||empty($_GET['success'])===false)
				{	if(empty($_POST)===false && empty($errors)===true)
					{	header('Location:enter_admin_details.php?user='.$user_data['first_name']);
						}
					if(empty($errors)===false)
					{	?>
							<div id="errors">
								<?php	echo output_errors($errors); ?>
							</div>
						<?php
						}
						?>
							<br/><br/>
							<form action="" method="post">
								Enter password*:<br/>
									<input type="password" name="password"><br/><br/>
								Re enter password*:<br/>
									<input type="password" name="re_password"><br/><br/>
								<input type="submit" value="Continue">
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