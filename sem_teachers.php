 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/coord_/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='sem_teachers';
	include 'includes/header.php';
	include 'includes/top.php';
	
?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
					Here, you can view/set the <strong>Subject Teachers</strong> for different subjects of branch/semester .
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
				<a href="view_teachers.php"><li class="box1">View Teachers</li></a>
				<a href="set_teachers.php"><li class="box1">Set Teachers</li></a>
			</ul>
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>