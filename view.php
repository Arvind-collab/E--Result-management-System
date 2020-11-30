 <?php
    include 'core/init.php';
	protect_page();
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
				Please have access to the Information of Students enrolled in NIT Srinagar currently. You can <strong>Modify</strong> and <strong>Read</strong> information regarding them .
				</p>
			</header>
		</article>
				<div class="wrapvert">
					<div class="innerwraphorz">
						<?php 
							if(isset($_GET['done'])===true&&empty($_GET['done'])===true)
							{	?>
									<div id="errors">
										<?php	echo 'admin rights has been transferred to set user\'s account...';?>
									</div>
								<?php
								}
							include 'search.php';
						?>
					</div>
		<?php
			GLOBAL $check;
			if($check!==1)	
			{	?>
					<div class="records">
						<img class="img2" src="students (2).jpg"/>
						<img class="img3" src="students (3).jpg"/>
					</div>
				<?php
				}
		?>	
			
	</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>