 <?php
    include 'core/init.php';
	protect_page();
	$current='access';
	$here='result';
	include 'includes/header.php';
	include 'includes/top.php';
?>	

		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
				Here you can <strong>Create</strong> the result for your branch.
				</p>
			</header>
		</article>
			<div class="wrapvert">
					<div class="innerwraphorz">
						<?php
							include 'details.php';
						?>
					</div>
			</div>

<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>