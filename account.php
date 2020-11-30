<?php
    include "core/init.php";
	protect_page();
	$current='access';
	$here='account';
	include 'includes/header.php';
	include 'includes/top.php';

?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
				Please have access to your registered Account. Here, you can <strong> Update </strong>your details , or even <strong>Delete</strong> your Account.
				</p>
			</header>
		</article> 
		<div class="wrapvert">
			<div class="echoedname">
				<h2>Hello, <?php echo $user_data['first_name'];?>!</h2>
			</div>
			<br/>		
			<ul class="user_menu">
				<a href="change_password.php"><li class="box1">Change Password</li></a>
				<?php
					if(preg_match("/admin/",$user_data['user_desc'])==true)
					{	?>
							<a href="change_admin.php"><li class="box1">Change Admin</li></a>
						<?php
						}
				?>
				<a href="update.php"><li class="box1">Update Details</li></a>
				<a href="delete.php"><li class="box1">Delete Account</li></a>
			</ul>
		</div>	
			
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>