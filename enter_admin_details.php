 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/admin/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='account';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(isset($_GET['user'])===false||empty($_GET['user'])===false)
	{	if($_GET['user']!==$user_data['first_name'])
			header('Location:access.php');
		}
		
	if(empty($_POST)===false)
	{	$required_fields=array('first_name','department');
		foreach($_POST as $key=>$value)
		{	if(empty($value)&&in_array($key,$required_fields)===true)
			{	$errors[]='Fields marked with * are required';
				break 1;
				}
			}
		if($_POST['first_name']===$user_data['first_name']&&$_POST['last_name']===$user_data['last_name']&&$_POST['department']===$user_data['department'])
			$errors[]='Currently admin\'s rights belong to this user only...';
		}
?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
					Please enter details of the new admin you want to transfer the rights of the website .
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<div class="balancebar">
				<h2>Enter new admin's details</h2>
				
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
						{	set_user($_POST['first_name'],$_POST['last_name'],$_POST['department'],'admin');
							header('Location:view.php?done');
							}
						else if(empty($errors)===false)
						{	?>
								<div id="errors">
									<?php	echo output_errors($errors);?>
								</div>
							<?php
							}
						?>
							<br/><br/>
							<form action="" method="post">
								<li>
									Enter first name of new admin*:<br/>
										<input type="text" name="first_name"><br/><br/>
								</li>
								<li>
									Enter last name of new admin:<br/>
										<input type="text" name="last_name"><br/><br/><br/>
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
								<input type="submit" value="Change Admin">
							</form>
							<br/><br/>
							<ul>
								<li><h2><div class="smallth"><em>Note </em>: If you are neither any semester coordinator nor faculty member.<br/>Then, this account will be deleted also...</div></h2></li>
								<li><h2><div class="smallth"><br/><br/><em>Warning </em>: This will withdraw all the admin's right from this account.<br/>The action is irreversible also...</div></h2></li>
							</ul>
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