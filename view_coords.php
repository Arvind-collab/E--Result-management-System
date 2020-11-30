 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/admin/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$i=0;
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
					Here, you can view the <strong>Semester Coordinators</strong> for different branches and semesters .
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<?php
				$result=check_desc('coord_');
				if(mysqli_num_rows($result)===0)
				{	?>
						<div id="errors">
							<?php echo 'no semester coordinator has been set yet...';?>
						</div>
					<?php
					}
				else
				{	?>
					<table class="result">
						<caption>Semester Coordinators For Different Semesters</caption>
						<tr>
							<th>S.no</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Department</th>
							<th>Semester</th>
							<th>Branch(es)</th>
						</tr>
						<?php
						while($x=mysqli_fetch_assoc($result))
						{	$i+=1;
							$value=array();
							$branch=array();
							$sem=array();
							foreach(explode(',',$x['user_desc']) as $p)
								if(preg_match("/coord_/",$p)==true)
									$value[]=$p;
							foreach($value as $p)
							{	$p=substr($p,6);
								$b=substr($p,0,strpos($p,'_'));
								$val=substr($p,strlen($b)+1);
								$sem[]=substr($val,0,strpos($val,'_')).'  (<a href=\'sem_coords_details.php?branch='.$b.'&sem='.substr($val,0,strpos($val,'_')).'\'>Change</a>)';
								if($b==='sem')
									$branch[]='All';
								else 
									$branch[]=$b;
								}
							$branch=implode('<br/>',$branch);
							$sem=implode('<br/>',$sem);
							?>
							<tr>
								<td><?php echo $i.'.';?></td>
								<td><?php echo $x['first_name'];?></td>
								<td><?php echo $x['last_name'];?></td>
								<td><?php echo $x['department'];?></td>
								<td><?php echo $sem;?></td>
								<td><?php echo $branch;?></td>
							</tr>
							<?php
							}
							?>
						</table>
					<?php
					}
			?>
			
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>