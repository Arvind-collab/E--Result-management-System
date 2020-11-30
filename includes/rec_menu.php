<div class="vert">
	<ul class="vertbar">
		<li><a <?php if($here=='view'){echo 'class="here"';}?> href="access.php">Enrolled Students</a></li>
		<?php
			if(preg_match("/coord_/",$user_data['user_desc'])==true)
			{	?>
					<li><a <?php if($here=='create'){echo 'class="here"';}?> href="create_new.php">Create New</a></li>
				<?php
				}
		?>
		<?php   
			if(preg_match("/teach_/",$user_data['user_desc'])==true)
			{	?>
					<li><a <?php if($here=='result'){echo 'class="here"';}?> href="create_result.php">Edit Result</a></li>
				<?php
				}
		?>
		<li><a <?php if($here=='view_result'){echo 'class="here"';}?> href="view_result.php">View Result</a></li>
		<?php   
			if(preg_match("/coord_/",$user_data['user_desc'])==true)
			{	?>
					<li><a <?php if($here=='sem_subjects'){echo 'class="here"';}?> href="sem_subjects.php">Sem. Subjects</a></li>
				<?php
				}
		?>
		<?php   
			if(preg_match("/coord_/",$user_data['user_desc'])==true)
			{	?>
					<li><a <?php if($here=='sem_teachers'){echo 'class="here"';}?> href="sem_teachers.php">Sem. Teachers</a></li>
				<?php
				}
		?>
		<?php   
			if(preg_match("/admin/",$user_data['user_desc'])==true)
			{	?>
					<li><a <?php if($here=='clear'){echo 'class="here"';}?> href="clear.php">Delete Result</a></li>
				<?php
				}
		?>
		<?php   
			if(preg_match("/admin/",$user_data['user_desc'])==true)
			{	?>
					<li><a <?php if($here=='sem_coords'){echo 'class="here"';}?> href="sem_coords.php">Sem. coordinators</a></li>
				<?php
				}
		?>
		<li><a <?php if($here=='account'){echo 'class="here"';}?> href="account.php">My Account</a></li>
        <li><a <?php if($here=='logout'){echo 'class="here"';}?> href="logout.php">LogOut!</a></li>
	</ul>
</div>