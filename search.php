<?php
	protect_page();
	
	if(empty($_POST)===false)
	{	if(empty($_POST['list'])===true&&empty($_POST['search'])===true&&empty($_POST['branch'])===true)
			$errors[]='Please select or enter the fields to search for...';
		else if(empty($_POST['list'])===false&&empty($_POST['search'])===true&&empty($_POST['branch'])===true)
			$errors[]='Please select branch or enter name to search in a year...';
		}
	
	if(!(isset($_GET['success'])&&empty($_GET['success'])))
	{	if(empty($_POST)===false && empty($errors)===true)		
		{	$result=search_by_name($_POST['search'],$_POST['list'],$_POST['branch']);
			}
		?>	
		<div class="innerwraphorz">
			<form method="post" action="">
				<div class="rtshift">
					<select name="list" id="list">
						<option value="" class="list1">-- Select Year* --</option>
						<option value="I" class="list1">YEAR I </option>
						<option value="II" class="list1">YEAR II</option>
						<option value="III" class="list1">YEAR III</option>
						<option value="IV" class="list1">YEAR IV</option>
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
				<input type="text" name="search" id="search" placeholder="Search By Name"/>
				<input type="image" img src="search.jpg" name="search" class="searchimg" alt="search"/>		
			</form>
			<?php
			if(empty($errors)===false)
			{	?>
				<div id="errors">
					<?php	echo output_errors($errors);?>
				</div>
				<?php
				}
		?>
			<?php
				if(empty($_POST)===false && empty($errors)===true)	
				{	if(mysqli_num_rows($result)==0)
					{	?>
							<div id="errors">
								<?php echo 'sorry... no result found for your search...'; ?>
							</div>
						<?php
						}
					else
					{	$check=1;
						?>
						<div class="rec_search">		
							<table>
								<caption>SEARCH RESULTS</caption>
								<tr>
									<th>S.no.</th>
									<th>Enroll. No.</th>
									<th>Batch</th>
									<th>First name</th>
									<th>Last name</th>
									<th>Email</th>
									<th>Contact</th>
									<th>Semester</th>
									<th>Branch</th>
								</tr>
								<tbody class="results">	
									<?php
									$i=0;
									while($row=mysqli_fetch_assoc($result))	
									{	$i+=1;
										?>
										<tr>
											<td>
											<?php echo $i.'.'; ?>
											</td>
											<td>
											<?php echo $row['enroll']; ?>
											</td>
											<td>
											<?php echo $row['batch']; ?>
											</td>
											<td>
											<?php echo $row['first_name']; ?>
											</td>
											<td>
											<?php echo $row['last_name']; ?>
											</td>
											<td>
											<?php echo $row['email']; ?>
											</td>
											<td>
											<?php echo $row['phone']; ?>
											</td>
											<td>
											<?php echo $row['sem']; ?>
											</td>
											<td>
											<?php echo $row['branch']; ?>
											</td>
										</tr>
										<?php
										}
									?>
								</tbody>
							</table>
						</div>	
						<?php
						}								
					}
				?>
			</div>
		<?php
	}
?>
		

		
