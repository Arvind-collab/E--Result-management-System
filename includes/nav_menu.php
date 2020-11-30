<!-- Navigation bar      -->
<nav id="Nav">

	<ul class="Container">
		<?php
		if(logged_in() === false)
		{
			?>
				<li><a <?php if($current=='home'){echo 'class="current"';}?> href="index.php">Home </a></li>
			<?php
		}
		?>
		<?php
		if(logged_in() === true)
		{
			?>
				<li><a <?php if($current=='access'){echo 'class="current"';}?> href="access.php">Access </a></li>
			<?php
		}
		?>
		<li><a <?php if($current=='contacts'){echo 'class="current"';}?> href="contacts.php">Contacts </a></li>
		<?php 
		if(logged_in() === false)
		{
			?>
				<li><a <?php if($current=='login'){echo 'class="current"';}?> href="login.php">Login </a></li>
			<?php
		}
		?>
		<?php 
		if(logged_in() === false)
		{
			?>
			<li><a <?php if($current=='register'){echo 'class="current"';}?> href="register.php">Register </a></li>
		<?php
		}
		?>

	</ul>
</nav>
<!--End of navigation bar -->