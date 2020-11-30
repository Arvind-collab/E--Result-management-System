 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/coord_/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='sem_teachers';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(isset($_GET['sem'])===true&&empty($_GET['sem'])===false)
	{	$sem=$_GET['sem'];
		$branch=$_GET['branch'];
		}
	$branch_subject=branch_subjects($sem,$branch);
	if(empty($_POST)===false)
	{	$required_fields=array('subject','first_name','department');
		foreach($_POST as $key=>$value)
		{	if(empty($value)&&in_array($key,$required_fields)===true)
			{	$errors[]='Fields marked with * are required';
				break 1;
				}
			}
		}
?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
					Here, you can set the <strong>Subject Teachers</strong> for different subjects of your branch/semester .
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<div class="balancebar">
				<?php
					if($branch!=='All')
					{	?>
							<h2>Enter Teacher's Details for <?php echo $branch.' '.$sem;?> Semester</h2>	
						<?php
						}
					else
					{	?>
							<h2>Enter Teacher's Details for <?php echo $sem;?> Semester</h2>	
						<?php
						}	
				?>
				<?php
					if(empty($_POST)===false && empty($errors)===true)
					{	if(isset($_GET['subject'])===false)
						{	$value=check_desc('teach_'.$branch.'_'.$sem.'_'.$_POST['subject']);
							
							if(mysqli_num_rows($value)!==0)
							{	$value=mysqli_fetch_assoc($value);
								?>
								<div id="errors">
									<?php	
										echo $value['first_name'].' '.$value['last_name'].' of '.$value['department'].' department is already the teacher for this subject<br/>';
										echo 'If you want to change this teacher(<a href=\'sem_teach_details.php?branch='.$branch.'&sem='.$sem.'&subject='.$_POST['subject'].'\'>Click Here</a>)';
									?>
								</div>
								<?php
								}
							else
							{	set_user($_POST['first_name'],$_POST['last_name'],$_POST['department'],'teach_'.$branch.'_'.$sem.'_'.$_POST['subject'].'_');
								header('Location:sem_teachers.php?success');
								}
							}
						else
						{	set_user($_POST['first_name'],$_POST['last_name'],$_POST['department'],'teach_'.$branch.'_'.$sem.'_'.$_POST['subject'].'_');
							header('Location:sem_teachers.php?success');
							}
						}
					if(empty($errors)===false)
					{	?>
						<div id="errors">
							<?php	echo output_errors($errors);?>
						</div>
						<?php
						}
				?>
				<br/><br/><br/>
				<form action="" method="post">
					<li>
						<?php	
							if(isset($_GET['subject'])===true)
							{	?>
									<input type="text" name="subject" value="<?php echo $_GET['subject'];?>" readonly><br/><br/>
								<?php
								}
							else
							{	?>
									<select name="subject">
										<option value="" class="list1">-- Select Subject* --</option>
											<?php
												foreach($branch_subject as $x)
												{	?>
														<option value="<?php echo $x; ?>" class="list1"><?php echo $x;?></option>
													<?php
													}
											?>
									</select><br/><br/>
								<?php
								}
						?>
					</li>
					<li>
						<input type="text" name="first_name" placeholder="First name*"><br/><br/>
					</li>
					<li>
						<input type="text" name="last_name" placeholder="Last name"><br/><br/>
					</li>
					<li>
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
						</select><br/><br/>
					</li>
					<input type="submit" value="Next">
				</form>
			</div>
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>