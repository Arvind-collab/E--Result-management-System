<?php
	function email($to,$subject,$body)
	{	mail($to,$subject,$body,'FROM:register&login@gamil.org');
		}
	function logged_in_redirect()
	{	if(logged_in()===true)
		{	header('Location:view.php');
			exit();
			}
		}
	function protect_page()
	{	if(logged_in()===false)
		{	header('Location:protected.php');
			exit();
			}
		}
	function array_sanitize(&$item)
	{	$item=htmlentities(strip_tags(mysql_real_escape_string($item)));			// strip_tags() removes html/php tags from data
		}																			// to sanitize it to prevent a sort of sql injection 
	function sanitize($data)
	{	return htmlentities(strip_tags(mysqli_real_escape_string($GLOBALS['conn'],$data)));
		}
	function output_errors($errors)
	{	return '<ul><li>'.implode('</li><li>',$errors).'</li></ul>';
		}
	function branch_subjects($sem,$branch)
	{	$subjects=array();
		switch($sem)
		{	case 'I' 	:  $subjects=array("Humanities","Physics","Chemistry","Maths","Engineering Drawing","Computer");	
							break;
			case 'II' 	:  $subjects=array("Humanities","Physics","Chemistry","Maths","Machine Drawing","C Programming","E Mech");
							break;
			case 'III' 	:  {	switch($branch)
								{	case "Information Technology" :	$subjects=array("IWD","EDC","S and S","Discrete Structures","OOPS","Basic Electrical");
																	break;
									case "Computer Science" : $subjects=array("IWD","EDC","S and S","Discrete Structures","OOPS","Basic Electrical");
																break;
									case "Electronics And Communication" :	$subjects=array("","","","","","");
																			break;
									case "Mechanical Engineering" :	$subjects=array("Fluid Mechanics","Fundamental Dynamics","Maths","Engineering Thermodynamics","Mechanics of Material 1","Manufacturing Technology");
																	break;
									case "Metallurgy Engineering" : $subjects=array("","","","","","");
																	break;
									case "Electrical Engineering" : $subjects=array("Basic Electrical","Maths","Physics","Electronics 1","Network Analysis","Material Sciences","Mechanical Engineering");
																	break;
									case "Civil Engineering" :	$subjects=array("Fluid Mechanics","Maths","Humanities","Surveying 1","Structure Analysis 1","Basic Electrical");
																break;
									case "Chemical Engineering" :	$subjects=array("","","","","","");
																break;
									}
									break;
								}
			case 'IV' 	:  {	switch($branch)
								{	case "Information Technology" :	$subjects=array("Software Engineering","DELD","Control Systems","Data Structures","Communication Systems","Maths");
																	break;
									case "Computer Science" :	$subjects=array("Humanities","DELD","Control Systems","Data Structures","Communication Systems","Maths");
																	break;
									case "Electronics And Communication" : $subjects=array("","","","","","");
																			break;									
									case "Mechanical Engineering" :	$subjects=array("Material Sciences","Theory of Mechanics","CAM","Applied Thermodynamics","Mechanics of Material II","Basic Electrical");
																	break;
									case "Metallurgy Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Electrical Engineering" : $subjects=array("Electrical Machines 1","Maths","Control Systems 1","Electronics 2","Hydraulics","Electrical Measurements","Non Conventional");
																	break;
									case "Civil Engineering" :	$subjects=array("Fluid Mechanics","Maths","BDC","Surveying 2","Structure Analysis 2","Geo tech Engineering");
																	break;
									case "Chemical Engineering" :	$subjects=array("","","","","","");
																	break;
									}
									break;
								}
			case 'V'    :  {	switch($branch)
								{	case "Information Technology" :	$subjects=array("","","","","","");
																	break;
									case "Computer Science" :	$subjects=array("","","","","","");
																break;
									case "Electronics And Communication" :	$subjects=array("","","","","","");
																			break;
									case "Mechanical Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Metallurgy Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Electrical Engineering" : $subjects=array("","","","","","");
																	break;
									case "Civil Engineering" :	$subjects=array("","","","","","");
																break;
									case "Chemical Engineering" :	$subjects=array("","","","","","");
																	break;
									}
									break;
								}
			case 'VI'   :  {	switch($branch)
								{	case "Information Technology" :	$subjects=array("","","","","","");
																	break;
									case "Computer Science" :	$subjects=array("","","","","","");
																	break;
									case "Electronics And Communication" :	$subjects=array("","","","","","");
																	break;
									case "Mechanical Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Metallurgy Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Electrical Engineering" : $subjects=array("","","","","","");
																	break;
									case "Civil Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Chemical Engineering" :	$subjects=array("","","","","","");
																	break;
									}
									break;
								}
			case 'VII'  :  {	switch($branch)
								{	case "Information Technology" :	$subjects=array("","","","","","");
																	break;
									case "Computer Science" :	$subjects=array("","","","","","");
																	break;
									case "Electronics And Communication" :	$subjects=array("","","","","","");
																	break;
									case "Mechanical Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Metallurgy Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Electrical Engineering" :$subjects=array("","","","","","");
																	break;
									case "Civil Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Chemical Engineering" :	$subjects=array("","","","","","");
																	break;
									}
									break;
								}
			case 'VIII' :  {	switch($branch)
								{	case "Information Technology" :	$subjects=array("","","","","","");
																	break;
									case "Computer Science" :	$subjects=array("","","","","","");
																	break;
									case "Electronics And Communication" :	$subjects=array("","","","","","");
																	break;
									case "Mechanical Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Metallurgy Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Electrical Engineering" : $subjects=array("","","","","","");
																	break;
									case "Civil Engineering" :	$subjects=array("","","","","","");
																	break;
									case "Chemical Engineering" :	$subjects=array("","","","","","");
																	break;
									}
									break;
								}
			}
		return $subjects;
		}
?>