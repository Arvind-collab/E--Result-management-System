 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/admin/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='sem_coords';
	include 'includes/header.php';
?>
<script type="text/javascript">
	function check_sem()
	{	var sem=document.getElementById("sem").value;
		if(sem=='I'||sem=='II')
			document.getElementById("branch").style.visibility="hidden";
		else
			document.getElementById("branch").style.visibility="visible";
		}
</script>
<?php
	include 'includes/top.php';
	
	if(empty($_POST)===false)
	{	if(empty($_POST['sem'])===true)
			$errors[]='Please select a semester to set semester coordinator for...';
		else if($_POST['sem']!=='I'&&$_POST['sem']!=='II'&&empty($_POST['branch']))
			$errors[]='Please select the branch to set semester coordinator for...';
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
				<h2>Select semester to set coordinator for...</h2>
				<?php
					if(empty($_POST)===false && empty($errors)===true)
					{	if($_POST['sem']==='I'||$_POST['sem']==='II')
							$_POST['branch']='All';
						$value=check_desc('coord_'.$_POST['branch'].'_'.$_POST['sem'].'_');
						if(mysqli_num_rows($value)!==0)
						{	$value=mysqli_fetch_assoc($value);
							?>
							<div id="errors">
								<?php	
									echo $value['first_name'].' '.$value['last_name'].' of '.$value['department'].' department is already the semester coordinator for this semester<br/>';
									echo 'If you want to change this coordinator(<a href=\'sem_coords_details.php?branch='.$_POST['branch'].'&sem='.$_POST['sem'].'\'>Click Here</a>)';
								?>
							</div>
							<?php
							}
						else
							header('Location:sem_coords_details.php?sem='.$_POST['sem'].'&branch='.$_POST['branch']);
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
						<select name="sem" id="sem" onchange="check_sem()">
							<option value="" class="list1">-- For Semester* --</option>
							<option value="I" class="list1">Semester I</option>
							<option value="II" class="list1">Semester II</option>
							<option value="III" class="list1">Semester III</option>
							<option value="IV" class="list1">Semester IV</option>
							<option value="V" class="list1">Semester V</option>
							<option value="VI" class="list1">Semester VI</option>
							<option value="VII" class="list1">Semester VII</option>
							<option value="VIII" class="list1">Semester VIII</option>
						</select>
					</li><br/><br/>	
					<li>
						<select name="branch" id="branch">
							<option value="" class="list1">-- Select Branch* --</option>
							<option value="Information Technology" class="list1">Information Technology</option>
							<option value="Computer Science" class="list1">Computer Science</option>
							<option value="Electronics And Communication" class="list1">Electronics And Communication</option>
							<option value="Mechanical Engineering" class="list1">Mechanical Engineering</option>
							<option value="Metallurgy Engineering" class="list1">Metallurgy Engineering</option>
							<option value="Electrical Engineering" class="list1">Electrical Engineering</option>
							<option value="Civil Engineering" class="list1">Civil Engineering</option>
							<option value="Chemical Engineering" class="list1">Chemical Engineering</option>
						</select>
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