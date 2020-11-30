 <?php
    include 'core/init.php';
	logged_in_redirect();
	$current='access';
	$here='view';
	include 'includes/header.php';
	include 'includes/top.php';
?>
		<header>Access!</header>
		</div>
	<article id="About">
				<header>
				<p class="wrap1"> 
				Please have access to the Information of Students enrolled in NIT Srinagar currently. 
				You can <strong>Register</strong> , <strong>Modify</strong> and <strong>Read</strong> information regarding them .
				</p>
				</header>
				<div id="errors">
					<h2 style="text-align:center">you need to <a href='login.php'>log in</a> to access this page<h2>
				</div>	
<?php
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>