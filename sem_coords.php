 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/admin/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='sem_coords';
	include 'includes/header.php';
	include 'includes/top.php';
	
?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
					Here, you can view/set the <strong>Semester Coordinators</strong> for different branches and semesters .
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<?php
				if(isset($_GET['success'])&&empty($_GET['success']))
				{	?>
						<div id="errors">
							<?php	echo 'Semester coordinator for has been set successfully...' ;?>
						</div>
					<?php
					}
			?>
			<ul class="user_menu">
				<a href="view_coords.php"><li class="box1">View coordinators</li></a>
				<a href="set_coords.php"><li class="box1">Set coordinators</li></a>
			</ul>
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>