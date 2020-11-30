<?php
	include 'core/init.php';
	protect_page();
	$current='access';
	$here='result';
	include 'includes/header.php';
	include 'includes/top.php';
	
	GLOBAL $sem,$branch,$exam,$subject;
	
	if(isset($_GET['success'])===false||empty($_GET['success'])===false)
	{	$sem=$_GET['sem'];
		$branch=$_GET['branch'];
		$exam=$_GET['exam'];
		$subject=$_GET['subject'];
		
		if($exam==='minor1'||$exam==='minor2')
			$max=20;
		else if($exam==='major')
			$max=50;
		else
			$max=10;
		}

	if(empty($_POST)===false)
	{	$data=array();
		foreach($_POST as $key=>$value)
		{	if($value==="")
			{	$errors[]='please fill the marks for all students correctly...';
				break 1;
				}
			$data[$key]=$value;
			}
		}
	
		?>
	</div><br/><br/>
	<header>Result for <?php echo $branch.' '.$sem.' semester for '.$subject; ?>!</header><br/><br/><br/>
	<div class="wrapvert">
		<div class="innerwraphorz">
			<?php
				$query=marks_form($sem,$branch,$subject,$exam);
				if(isset($_GET['success'])&&empty($_GET['success']))
				{	?>
						<div id="errors">
							<?php echo "student's marks has been added successfully...!!!"; ?>
						</div>
					<?php
					}
				else	
				{	if(empty($_POST)===false&&empty($errors)===true)
					{	add_marks($data,$branch,$exam,$sem,$subject);
						header('Location:enter_marks.php?success'); 
						exit();
						}
					else if(empty($errors)===false)
					{	?>
							<div id="errors">
								<?php	echo output_errors($errors);?>
							</div>
						<?php
						}
					?>
					<br/><br/>
					<form action="" method="post">
						<table>
							<tr>
								<th>S.no</th>
								<th>Enroll.no.</th>
								<th>Marks(max=<?php echo $max;?>)</th>
							</tr>
							<?php
								$i=0;
								while($row=mysqli_fetch_assoc($query))
								{	$i+=1;
									?>
										<tr>
											<td><?php echo $i.'.';?></td>
											<td><?php echo $row['enroll'];?></td>
											<td><input type="number" step="any" min="0" max="<?php echo $max; ?>" name="<?php echo $row['enroll'];?>" value="<?php echo $row[$exam.'_'.$subject];?>"></td>
										</tr>
									<?php
									}
							?>
				
							</table>
							<input type="submit" value="Add record"><br/><br/>
							<input type="reset" value="Reset all">
						</form>
					<?php
					}
			?>
		</div>
	</div>
<?php	
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>