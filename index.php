<?php
    include "core/init.php";
	logged_in_redirect();
	$current='home';
	include 'includes/header.php';
	include 'includes/nav_menu.php';
	
?>
<div class="logo"><img src="logo.jpg" alt="logo"></div>
<div class="image1"><img src="image1.jpg" alt="image1"></div>
<?php
		include 'includes/base_wrapper.php';
?>
			<article id="About">
				<header>
				<h2>Welcome to NITSRI <em>E-access</em> Database System!</h2>
				<hr>
				<p>This is an E-Register facility where Faculty members currently working in NITSRI can store/ access the information of Students enrolled in the college and other important details about them. <br>
				<div class="Get_started"><a href="access.php">Get Access</a></div>
				
				<br><br>
				<div class="General">You can also visit the college Website <a href="http://nitsri.net">here</a></div>
				</p>
				</header>
			</article>
	</div>
<!--End of Inner_wrapper1 -->
</div>
<!-- End of base wrapper  -->
<?php
	include 'includes/footer.php';
?>