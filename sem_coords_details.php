 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/admin/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='sem_coords';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(isset($_GET['sem'])===true&&empty($_GET['sem'])===false)
	{	$sem=$_GET['sem'];
		$branch=$_GET['branch'];
		}
	if(empty($_POST)===false)
	{	$required_fields=array('first_name','department');
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
					Here, you can give the <strong>Semester Coordinators</strong> for different branches and semesters .
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<div class="balancebar">
				<h2>Enter Semester Coordinator's Details</h2>
				<?php
					if(empty($_POST)===false && empty($errors)===true)
					{	set_user($_POST['first_name'],$_POST['last_name'],$_POST['department'],'coord_'.$branch.'_'.$sem.'_');
						header('Location:sem_coords.php?success');
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