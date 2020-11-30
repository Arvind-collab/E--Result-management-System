<?php
	include "core/init.php";
	protect_page();
	
	if(preg_match("/coord_/",$user_data['user_desc'])==false)
		header('Location:access.php');
	$current='access';
	$here='create';
	include 'includes/header.php';
?>
<script type="text/javascript">
	function set_sem()
	{	var batch,sem;
		var time=new Date()
		var month=time.getMonth()+1
		var year=time.getFullYear()
		batch=document.getElementById("sbatch").value;
		var diff=year-batch;
		if(diff>=0&&diff<5)
		{	if(month<7)
				sem=2*diff;
			else
				sem=2*diff+1;
			if(sem>8)
				sem=0;
			}
		document.getElementById("ssemester").selectedIndex=sem;
		}
</script>
<?php
	include 'includes/top.php';
?>
		<header>Access!</header>
		</div>
			<article id="About">
				<header>
				<p class="wrap1"> 
				Please have access to the Information of Students enrolled in NIT Srinagar currently. You can <strong>Register</strong> and <strong>Modify</strong> <!--and <strong>Read</strong>--> information regarding them .
				</p>
				</header>
			</article>
				<div class="wrapvert">
					<div class="innerwraphorz">
						<?php
							if(isset($_POST['student_entry'])===false)	
								include 'search.php';
							GLOBAL $check;
							if($check!==1&&isset($_POST['search'])===false)
								include 'student_entry.php';
							else if($check!==1&&isset($_POST['student_entry'])===false)	
							{	?>
									<div class="records">
										<img class="img2" src="students (2).jpg"/>
										<img class="img3" src="students (3).jpg"/>
									</div>
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