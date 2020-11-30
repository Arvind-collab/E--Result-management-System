 <?php
    include 'core/init.php';
	protect_page();
	$current='access';
	$here='view_result';
	include 'includes/header.php';
	include 'includes/top.php';
	
	$i=0;
	$sem=$_GET['sem'];
	$branch=$_GET['branch'];
	$subject=$_GET['subject'];
	$exam=$_GET['exam'];
	$result=get_result($sem,$branch,$subject,$exam);
?>
	</div><br/><br/>
	<header>Result for <?php echo $branch.' '.$sem.' semester '.$subject; ?>!</header>
	<div class="wrapvert">
		<br/><br/>
		<table class="result">
			<tr>
				<th>S.no.</th>
				<th>Enroll. no.</th>
				<?php 
					if($exam==='total'||$exam==='minor1')
					{	?>
						<th>Minor 1<br/>(max=20)</th>
						<?php
						}
					if($exam==='total'||$exam==='minor2')
					{	?>
						<th>Minor 2<br/>(max=20)</th>
						<?php
						}	
					if($exam==='total'||$exam==='ca')
					{	?>
						<th>CA<br/>(max=10)</th>
						<?php
						}
					if($exam==='total'||$exam==='major')
					{	?>
						<th>Major<br/>(max=50)</th>
						<?php
						}
					if($exam==='total')
					{	?>
						<th>Total<br/>(max=100)</th>
						<th>Grade</th>
						<?php
						}
				?>
			</tr>
		<?php
			while($x=mysqli_fetch_assoc($result))
			{	$i+=1;
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $x['enroll'];?></td>
					<?php 
						if($exam==='total'||$exam==='minor1')
						{	?>
							<td><?php echo $x['minor1_'.$subject];?></td>
							<?php
							}
						if($exam==='total'||$exam==='minor2')
						{	?>
							<td><?php echo $x['minor2_'.$subject];?></td>
							<?php
							}	
						if($exam==='total'||$exam==='major')
						{	?>
							<td><?php echo $x['major_'.$subject];?></td>
							<?php
							}
						if($exam==='total'||$exam==='ca')
						{	?>
							<td><?php echo $x['ca_'.$subject];?></td>
							<?php
							}
						if($exam==='total')
						{	$tot=$x['minor1_'.$subject]+$x['minor2_'.$subject]+$x['major_'.$subject]+$x['ca_'.$subject];
							?>
							<td><?php echo $tot;?></td>
							<td><?php echo grade($tot);?></td>
							<?php
							}
					?>
				</tr>
				<?php
				}
			?>
		</table>
	</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>