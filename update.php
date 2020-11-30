<?php
    include "core/init.php";
	protect_page();
	$current='access';
	$here='account';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(empty($_POST)===false)
	{	$required_fields = array('username','first_name','email');
		foreach($_POST as $key=>$value)
		{	if(empty($value)&&in_array($key,$required_fields)===true)
			{	$errors[]='Fields marked with * are required';
				break 1;
				}
			}
		if(empty($errors)===true)
		{	if(user_exists($_POST['username'])===true&&$_POST['username']!==$user_data['username'])
				$errors[]='Sorry the username \''.$_POST['username'].'\' is already taken.';
			if(preg_match("/\\s/",$_POST['username'])==true)				
				$errors[]='your username must not contain any spaces...';
			if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false)
				$errors[]='A valid email address is required';
			else if(email_exists($_POST['email'])===true && $user_data['email']!==$_POST['email'])
				$errors[]='Sorry the email \''.$_POST['email'].'\' is already in use.';
				
		}
	}
?>
		<header><?php echo $user_data['first_name'];?></header>
		</div>
		
		<div class="wrapvert">
		<div class="wrapperinner">
		<div class="balancebar">		
			<h2>Update Details !</h2>
		
			<?php
				if(isset($_GET['success'])&&empty($_GET['success']))
				{	?>
						<div id="errors">
							<?php echo 'your details have been updated successfully...'; ?>
						</div>
					<?php
					}
				else
				{	if(empty($_POST)===false && empty($errors)===true)
					{	$update_data=array(
						'username'		=>$_POST['username'],
						'first_name'	=>$_POST['first_name'],
						'last_name'		=>$_POST['last_name'],
						'email'			=>$_POST['email'],
						'phone'			=>$_POST['phone']
						);
						update_user($update_data);
						header('Location:update.php?success');
						}
			if(empty($errors)===false)
			{	?>
					<div id="errors">
						<?php	echo output_errors($errors);?>
					</div>
				<?php
				}
		?>
			</div>	
						<form action="" method="post">
					<table class="tabular">
							<tr class="row1"></tr>
								<td class="colu1">
									Username* :
								</td>
								<td class="colu1">
									First name* : 
								</td>
							</tr>
						<tr class="row2"></tr>
								<td class="colu1">
										<input type="text" name="username" value="<?php echo $user_data['username']?>">
								</td>
								<td class="colu1">
									<input type="text" name="first_name" value="<?php echo $user_data['first_name']?>">
						
								</td>
							</tr>
						<tr class="row1"></tr>
								<td class="colu1">
									Last name : 
								</td>
								<td class="colu1">
									Email* :  
								</td>
							</tr>
							<tr class="row2"></tr>
								<td class="colu1">
										<input type="text" name="last_name" value="<?php echo $user_data['last_name']?>">
						
								</td>
								<td class="colu1">
										<input type="text" name="email" value="<?php echo $user_data['email']?>">
						
								</td>
							</tr>
							<tr class="row1"></tr>
								<td class="colu1">
									Contact Number : 
								</td>
								
							</tr>
							<tr class="row2"></tr>
								<td class="colu1">
										<input type="text" name="phone" value="<?php echo $user_data['phone']?>">
						
								</td>
								
							</tr>
					
					
					</table>
						<div  class="buttonshrink"><input type="submit" value="Update !"></div>
					</form>
				<?php
			}
			?>
					</div>
		
			</div>	
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>