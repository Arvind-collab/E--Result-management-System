 <?php
    include 'core/init.php';
	protect_page();
	
	if(preg_match("/coord_/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$i=0;
	$check=0;
	$current='access';
	$here='sem_teachers';
	include 'includes/header.php';
	include 'includes/top.php';
	
	$now_branch=array();
	$now_sem=$here_sem;
	foreach($here_branch as $p)
	{	if($p==='All')
			$now_branch[]='';
		else
			$now_branch[]=$p;
		}
	$val=array();
	foreach($here_sem as $k=>$value)
	{	if($here_branch[$k]==='All')
			$check=1;
		$val[]='teach_'.$here_branch[$k].'_'.$here_sem[$k].'_';
		$now_branch[$k]=$now_branch[$k].' '.$now_sem[$k];
		}
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
			<table class="result">	
				<caption>Teachers For <?php echo implode(' , ',$now_branch);?> Semester/es</caption>
				<tr>
					<th>S.no</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Department</th>
					<th>Semester(es)</th>
					<th>Branch(es)</th>
					<th>Subject(es)</th>
				</tr>
			<?php
				foreach($val as $m)
				{	$result=check_desc($m);
					if(mysqli_num_rows($result)!==0)
					{	while($x=mysqli_fetch_assoc($result))
						{	$i+=1;
							$value=array();
							$branch=array();
							$sem=array();
							$subject=array();
							foreach(explode(',',$x['user_desc']) as $p)
								if(preg_match("/teach_/",$p)==true)
									$value[]=$p;
							foreach($value as $p)
							{	$p=substr($p,6);
								$b=substr($p,0,strpos($p,'_'));
								$val=substr($p,strlen($b)+1);
								$s=substr($val,0,strpos($val,'_'));
								$val=substr($val,strlen($s)+1);
								if(in_array($s,$here_sem)===true)
								{	$sem[]=$s;
									$branch[]=$b;
									$subject[]=substr($val,0,strpos($val,'_')).'  (<a href=\'sem_teach_details.php?branch='.$b.'&sem='.$s.'&subject='.substr($val,0,strpos($val,'_')).'\'>Change</a>)';
									}
								}
							$branch=implode('<br/>',$branch);
							$sem=implode('<br/>',$sem);
							$subject=implode('<br/>',$subject);
							?>
							<tr>
								<td><?php echo $i.'.';?></td>
								<td><?php echo $x['first_name'];?></td>
									<td><?php echo $x['last_name'];?></td>
									<td><?php echo $x['department'];?></td>
									<td><?php echo $sem;?></td>
									<td><?php echo $branch;?></td>
									<td><?php echo $subject;?></td>
								</tr>
							<?php
							}
						}
					}
			?>
			</table>			
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>