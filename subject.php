 <?php
    include 'core/init.php';
	protect_page();
	$current='access';
	include 'includes/header.php';
	include 'includes/top.php';
	if(isset($_GET['sem'])&&isset($_GET['branch'])&&isset($_GET['exam'])&&isset($_GET['here']))
	{	$sem=$_GET['sem'];
		$branch=$_GET['branch'];
		$exam=$_GET['exam'];
		$here=$_GET['here'];
		}
	$branch_subject=branch_subjects($sem,$branch);
	
	if(empty($_POST)===false&&empty($_POST['subject'])===true)
		$errors[]='please select your subject...';

?>	
		<header>Access!</header>
		</div>
		<article id="About">
			<header>
				<p class="wrap1"> 
					Here you can <strong>Create</strong> the result for your branch.
				</p>
			</header>
		</article>
			<div class="wrapvert">
				<div class="innerwraphorz">
					<?php
						if(empty($_POST)===false&&empty($errors)===true)
						{	if($here==='result')
								header('Location:enter_marks.php?sem='.$_GET['sem'].'&branch='.$_GET['branch'].'&exam='.$_GET['exam'].'&subject='.$_POST['subject']);
							else if($here==='view_result')
								header('Location:result.php?sem='.$_GET['sem'].'&branch='.$_GET['branch'].'&exam='.$_GET['exam'].'&subject='.$_POST['subject']);
							}
						else if(empty($errors)===false)
						{	?>
							<div id="errors">
								<?php echo output_errors($errors); ?>
							</div>
							<?php
							}
					?>
					<form action="" method="post">
						<div class="rtshift">
							<select name="subject" id="subject">
								<option value="" class="list1">-- Select Subject* --</option>
									<?php
										foreach($branch_subject as $x)
										{	?>
												<option value="<?php echo $x; ?>" class="list1"><?php echo $x;?></option>
											<?php
											}
									?>
							</select>
						</div>
						<input type="submit" value="<?php if($exam===0)echo 'Get Result'; else echo 'Enter Marks'; ?>">
					</form>
				</div>
			</div>

<?php
	include 'includes/rec_menu.php';
	include 'includes/bottom.php';
	include 'includes/footer.php';
?>