<?php
	protect_page();
	GLOBAL $here;
	if(empty($_POST)===false)
	{	if(empty($_POST['list'])===true||empty($_POST['branch'])===true||empty($_POST['exam'])===true)
			$errors[]='fields marked with * are necessary...';
		}
	
	if(empty($_POST)===false&&empty($errors)===true)
	{	$list=$_POST['list'];								
		$branch=$_POST['branch'];							
		$exam=$_POST['exam'];								
		if($_POST['list']==='I')
		{	$sem='sem_1';
			$year='year_1';
			}
		else if($_POST['list']==='II')
		{	$sem='sem_2';
			$year='year_1';
			}
		else if($_POST['list']==='III')
		{	$sem='sem_3_'.$branch;
			$year='year_2';
			}
		else if($_POST['list']==='IV')
		{	$sem='sem_4_'.$branch;
			$year='year_2';
			}
		else if($_POST['list']==='V')
		{	$sem='sem_5_'.$branch;
			$year='year_3';
			}
		else if($_POST['list']==='VI')
		{	$sem='sem_6_'.$branch;
			$year='year_3';
			}
		else if($_POST['list']==='VII')
		{	$sem='sem_7_'.$branch;
			$year='year_4';
			}
		else if($_POST['list']==='VIII')
		{	$sem='sem_8_'.$branch;
			$year='year_4';
			}
		$query='SELECT * FROM `'.$sem.'` WHERE branch=\''.$_POST['branch'].'\'';
		$result=mysqli_query($GLOBALS['conn1'],$query);
		if(mysqli_num_rows($result)==0)
		{	//$query='INSERT INTO result.'.$sem.'(enroll,branch) SELECT enroll,branch FROM e_access.'.$year.' WHERE branch=\''.$_POST['branch'].'\' AND sem=\''.$_POST['list'].'\' ORDER BY enroll';
			mysqli_query($GLOBALS['conn'],"INSERT INTO result.`$sem`(enroll,branch) SELECT enroll,branch FROM e_access.$year WHERE branch='$branch' AND sem='$list' ORDER BY enroll");
			}
		header('Location:subject.php?sem='.$list.'&branch='.$branch.'&exam='.$exam.'&here='.$here);
		}
	else
	{	if(empty($errors)===false)
		{	?>
			<div id="errors">
				<?php echo output_errors($errors);?>
			</div>
			<?php
			}
		?>		
		<form method="post" action="">
			<div class="rtshift">
				<select name="list" id="list">
					<option value="" class="list1">-- Select Semester* --</option>
					<option value="I" class="list1">SEMESTER I </option>
					<option value="II" class="list1">SEMESTER II</option>
					<option value="III" class="list1">SEMESTER III</option>
					<option value="IV" class="list1">SEMESTER IV</option>
					<option value="V" class="list1">SEMESTER V</option>
					<option value="VI" class="list1">SEMESTER VI</option>
					<option value="VII" class="list1">SEMESTER VII</option>
					<option value="VIII" class="list1">SEMESTER VIII</option>
				</select>
				<select name="branch" id="branch">
					<option value="" class="list1">-- Select Branch* --</option>
					<option value="Information Technology" class="list1">Information Technology</option>
					<option value="Computer Science" class="list1">Computer Science</option>
					<option value="Electronics And Communication" class="list1">Electronics And Communication</option>
					<option value="Mechanical Engineering" class="list1">Mechanical Engineering</option>
					<option value="Metallurgy Engineering" class="list1">Metallurgy Engineering</option>
					<option value="Electrical Engineering" class="list1">Electrical Engineering</option>
					<option value="Civil Engineering" class="list1">Civil Engineering</option>
					<option value="Chemical Engineering" class="list1">Chemical Engineering</option>
				</select><br/><br/><br/>
				<?php   if($here!=='clear')
						{	?>
							<select name="exam" id="exam">
								<option value="" class="list1">-- Marks for* --</option>
								<option value="minor1" class="list1">Minor 1</option>
								<option value="minor2" class="list1">Minor 2</option>
								<option value="major" class="list1">Major</option>
								<option value="ca" class="list1">Class Assessment</option>
								<?php	
									if($here==='view_result')
									{	?>
											<option value="total" class="list1">All</option>
										<?php
										}
								?>
							</select>
							<?php
							}
				?>
			</div>
			<input type="submit" value="Next">
		</form>
		<?php
		}
?>