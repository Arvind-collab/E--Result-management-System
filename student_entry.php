<?php
	protect_page();
	if(empty($_POST)===false)
	{	$required_fields=array('enroll','batch','first_name','email','sem','branch');
		foreach($_POST as $key=>$value)
		{	if(empty($value)&&in_array($key,$required_fields)===true)
			{	$errors[]='Fields marked with * are required';
				break 1;
				}
			}
		if(empty($errors)===true)
		{	if(preg_match("/\A\d\d-\d\d\z/",$_POST['enroll'])==false)
				$errors[]='enrollment must be of the form \'enroll-year\' as for \'it-01-13\' must enter \'01-13\' only...';
			else if(preg_match("/\A\d\d\d\d\z/",$_POST['batch'])==false)
				$errors[]='batch must corresponds with the year of admission...';
			else if($_POST['batch']>date('Y')||(2*(date('Y')-$_POST['batch'])+1)>8)
				$errors[]='invalid batch entered...';
			if(($_POST['enroll'][3]!==$_POST['batch'][2])||($_POST['enroll'][4]!==$_POST['batch'][3]))
				$errors[]='enroll does not corresponds with batch...';
			if(student_exists($_POST['enroll'],$_POST['sem'],$_POST['branch'])===true)
					$errors[]='Sorry the student\'s record with enroll \''.$_POST['branch'].'-'.$_POST['enroll'].'\' already exists...';
			if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false)
				$errors[]='A valid email address is required';
			if(student_email_exists($_POST['email'],$_POST['sem'])===true)
				$errors[]='Sorry the email \''.$_POST['email'].'\' already exists...';
			if(empty($here_sem)===false)
			{	$temp=0;
				foreach($here_sem as $x)
					if($x===$_POST['sem'])
						$temp=1;
				if($here_branch!=='All'&&empty($here_branch)===false)
				{	foreach($here_branch as $x)
						if($x===$_POST['branch'])
							$temp=1;
					}
				if($temp===0)
					$errors[]='You don\'t have permission to enter details for this semester/branch...';
				}
			}
		}
		
	if(isset($_GET['success'])&&empty($_GET['success']))
	{	?>
			<div id="errors">
				<?php echo "student's details has been added successfully...!!!"; ?>
			</div>
		<?php
		}
	else	
	{	if(empty($_POST)===false&&empty($errors)===true)
		{	$register_data=array(
							'enroll'		=>  $_POST['enroll'],
							'batch'			=>  $_POST['batch'],
							'first_name'	=>  $_POST['first_name'],
							'last_name'		=>  $_POST['last_name'],
							'email'			=>  $_POST['email'],
							'phone'			=>  $_POST['phone'],
							'sem'			=>  $_POST['sem'],
							'branch'		=>  $_POST['branch']
							);
			register_student($register_data);
			header('Location:create_new.php?success'); 
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
		<!--	<div class="enroll">	-->
			<section>
				<div class="form2">
					<form method="post" action="">
						<ul class="Row1">
							<li class="susername">
								<input type="text" name="enroll" id="susername" placeholder="Enrollment*<as 01-13>"/>
							</li>
							<li class="sbatch">
								<input type="text" name="batch" id="sbatch" placeholder="Batch*" onchange="set_sem()"/>
							</li>
						</ul>
						<ul class="Row2">
							<li class="sfirst name ">
								<input type="text" name="first_name" id="sfirst_name" placeholder="First name*"/>
							</li>
							<li class="slast name">
								<input type="text" name="last_name" id="slast_name" placeholder="Last name"/>
							</li>
						</ul>
						<ul class="Row3">
							<li class="semail">
								<input type="text" name="email" id="semail" placeholder="Email*"/>
							</li>
							<li class="sphone">
								<input type="text" name="phone" id="sphone" placeholder="Contact"/>
							</li>
						</ul>
						<ul class="Row4">
							<li class="ssemester">
								<select name="sem" id="ssemester">
									<option value="" class="list1">-- Select Semester* --</option>
									<option value="I" class="list1">Semester I</option>
									<option value="II" class="list1">Semester II</option>
									<option value="III" class="list1">Semester III</option>
									<option value="IV" class="list1">Semester IV</option>
									<option value="V" class="list1">Semester V</option>
									<option value="VI" class="list1">Semester VI</option>
									<option value="VII" class="list1">Semester VII</option>
									<option value="VIII" class="list1">Semester VIII</option>
								</select>
							</li>		
							<li class="sbranch">
								<select name="branch" id="sbranch">
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
							</li>
							
						</ul>
						<div class="register">
							<input type="submit" name="student_entry" id="sadd" value="Add!"/>
						</div>
					</form>
				</div>		
			</section>
	<!--		</div>-->
			<?php
			}		
		?>
			
	