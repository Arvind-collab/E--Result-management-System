<?php
    include "core/init.php";
	protect_page();
	$current='access';
	$here='account';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(empty($_POST)===false)
	{	$required_fields = array('password','re_password');
		foreach($_POST as $key=>$value)
		{	if(empty($value)&&in_array($key,$required_fields)===true)
			{	$errors[]='Fields marked with * are required';
				break 1;
				}
			}
		if(empty($errors)===true)
		{	if((md5($_POST['password'])!==$user_data['password'])||(md5($_POST['re_password'])!==$user_data['password']))
				$errors[]='your password is incorrect...';
			}
		}
?>
		<header><?php echo $user_data['first_name'];?></header>
		</div>
		
		<div class="wrapvert">
		<div class="balancebar2">
			
			<h2>Delete Account !</h2>
			<?php
				if(isset($_GET['success'])&&empty($_GET['success']))
				{	?>
						<div id="errors">
							<?php echo 'your account has been deleted successfully...'; ?>
						</div>	
					<?php	
					}
				else
				{	if(empty($_POST)===false && empty($errors)===true)
					{	if(preg_match("/admin/",$user_data['user_desc'])==true)
						{	?>
								<div id="errors">
									<?php	echo 'NOTE : Please transfer admin rights to some other user\'s account first...';?>
								</div>
							<?php
						}
						else	
						{	delete_user($user_data['user_id']);
							header('Location:delete.php?success');
							}
						}
					else if(empty($errors)===false)
					{	?>
							<div id="errors">
								<?php	echo output_errors($errors);?>
							</div>
						<?php
						}
					?>	
					<br/><br/><br/>
					<form action="" method="post">
						<input type="password" name="password" placeholder="Enter Password*"><br/><br/>
						<input type="password" name="re_password" placeholder="Re Enter Password*"><br/><br/>
						<input type="submit" value="Delete Account">
					</form>
					<br/><br/>
					<ul>
						<li><h2><div class="smallth"><em>Warning ! </em>: &nbsp; This action is irreversible...</div></h2></li>
					</ul>
					<?php
				}
			?></div>
			</div>	
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>