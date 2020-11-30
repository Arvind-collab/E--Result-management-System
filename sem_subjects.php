 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/coord_/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='sem_subjects';
	include 'includes/header.php';
	include 'includes/top.php';
	
?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
					Here, you can view/set the <strong>Subjects</strong> for your branch/semester .
					<br/>subject name must not contain any special characters
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<?php
				if(isset($_GET['success'])&&empty($_GET['success']))
				{	?>
						<div id="errors">
							<?php	echo 'Semester teacher for has been set successfully...' ;?>
						</div>
					<?php
					}
			?>
			<ul class="user_menu">
				<a href="view_subjects.php"><li class="box1">View Subjects</li></a>
				<a href="set_subjects.php"><li class="box1">Set Subjects</li></a>
			</ul>
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>