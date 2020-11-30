 <?php
    include 'core/init.php';
	protect_page();
	$current='access';
	$here='clear';
	include 'includes/header.php';
	include 'includes/top.php';
	
	if(preg_match("/admin/",$user_data['user_desc'])==false)
		header('Location:access.php');
?>
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
				Here you can <strong>Delete</strong> all the result records for your semester in one go...
				</p>
			</header>
		</article>
		<div class="wrapvert">
			<div class="innerwraphorz">
				<?php
					if(isset($_GET['success'])&&empty($_GET['success']))
					{	?>
							<div id="errors">
								<?php echo 'result record for semester '.$_GET['list'].' '.$_GET['branch'].' has been deleted successfully...'; ?>
							</div>
						<?php
						}
					else
					{	if(empty($_POST)===false&&empty($errors)===true)
						{	$list=$_POST['list'];								
							$branch=$_POST['branch'];							
							switch($_POST['list'])
							{	case 'I' : $table='sem_1'; break;
								case 'II' : $table='sem_2'; break;
								case 'III' : $table='sem_3_'.$branch; break;
								case 'IV' : $table='sem_4_'.$branch; break;
								case 'V' : $table='sem_5_'.$branch; break;
								case 'VI' : $table='sem_6_'.$branch; break;
								case 'VII' : $table='sem_7_'.$branch; break;
								case 'VIII' : $table='sem_8_'.$branch; break;
								}
							$count=mysqli_query($GLOBALS['conn1'],"SELECT COUNT(*) FROM `$table` WHERE 1");
							$c=mysqli_fetch_array($count);
							if($c[0]==0)
							{	?>
									<div id="errors">
										<?php echo 'No records exists for this branch and semester....';?>
									</div>
								<?php
								}
							else
							{	mysqli_query($GLOBALS['conn1'],"TRUNCATE TABLE `$table`");
								header('Location:clear.php?list='.$list.'&branch='.$branch.'&success');
								}
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
									</select>
								</div>
								<input type="submit" value="Next">
							</form>
							<?php
							}
						}
				?>
			</div>
		</div>
<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>