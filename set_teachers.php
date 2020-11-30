 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/coord_/",$user_data['user_desc'])==false)
		header('Location:access.php');
	
	$current='access';
	$here='sem_teachers';
	include 'includes/header.php';
?>

<script type="text/javascript">
	function check_sem()
	{	var sem=document.getElementById("sem").value;
		if(sem=='I'||sem=='II'||sem=='')
			document.getElementById("branch").style.visibility="hidden";
		else
			document.getElementById("branch").style.visibility="visible";
		var branch;
		if(sem=='I'||sem=='II')
			branch='All';
		else
			branch=document.getElementById("branch").value;
		}
</script>

<?php
	include 'includes/top.php';
		
	if(empty($here_sem[1])===true)
	{	if($here_sem[0]==='I'||$here_sem[0]==='II')
			$here_branch[0]='All';
		header('Location:sem_teach_details.php?sem='.$here_sem[0].'&branch='.$here_branch[0]);
		}
	if(empty($_POST)===false)
	{	if(empty($_POST['sem'])===true)
			$errors[]='Please select a semester to set teacher for...';
		else if($_POST['sem']!=='I'&&$_POST['sem']!=='II'&&$_POST['branch']==='')
			$errors[]='Please select the branch to set teacher for...';
		if($_POST['sem']==='I'||$_POST['sem']==='II')
			$_POST['branch']='All';
		}
?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
					Here, you can view/set the <strong>Subject Teachers</strong> for different subjects of your branch/semester .
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<div class="balancebar">
				<h2>Select subject to set coordinator for...</h2>
				<?php
					if(empty($_POST)===false && empty($errors)===true)
					{	header('Location:sem_teach_details.php?sem='.$_POST['sem'].'&branch='.$_POST['branch']);
						}
					if(empty($errors)===false)
					{	?>
							<div id="errors">
								<?php echo output_errors($errors);?>
							</div>
						<?php
						}
				?>
				<br/><br/><br/>
				<form action="" method="post">
					<select name="sem" id="sem" onclick="check_sem()">
						<option value="" class="list1">-- Select Semester* --</option>
						<?php
							foreach($here_sem as $x)
							{	?>
									<option value="<?php echo $x;?>" class="list1"><?php echo 'Semester '.$x;?></option>
								<?php
								}
						?>
					</select>
					<select name="branch" id="branch">
						<option value="" class="list1">-- Select Branch* --</option>
						<?php
							foreach($here_branch as $x)
							{	if($x!=='All')
								{	?>
										<option value="<?php echo $x;?>" class="list1"><?php echo $x;?></option>
									<?php
									}
								}
						?>
					</select>
					<input type="submit" value="next">
				</form>
			</div>
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>
