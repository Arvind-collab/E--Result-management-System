<?php
	function grade($marks)
	{	if($marks>90&&$marks<=100)
			return 'A+';
		else if($marks>80&&$marks<=90)
			return 'A';
		else if($marks>70&&$marks<=80)
			return 'B+';
		else if($marks>60&&$marks<=70)
			return 'B';
		else if($marks>50&&$marks<=60)
			return 'C+';
		else if($marks>40&&$marks<=50)
			return 'C';
		else
			return 'F';
		}
	
	function get_result($sem,$branch,$subject,$exam)
	{	$sem=sanitize($sem);
		$branch=sanitize($branch);
		$subject=sanitize($subject);
		$exam=sanitize($exam);
		switch($sem)
		{	case 'I': $table='sem_1';	break;
			case 'II': $table='sem_2';	break;
			case 'III': $table='sem_3_'.$branch;	break;
			case 'IV': $table='sem_4_'.$branch;	break;
			case 'V': $table='sem_5_'.$branch;	break;
			case 'VI': $table='sem_6_'.$branch;	break;
			case 'VII': $table='sem_7_'.$branch;	break;
			case 'VIII': $table='sem_8_'.$branch;	break;
			}
		if($exam==='minor1'||$exam==='minor2'||$exam==='major'||$exam==='ca')
			$field='`'.$exam.'_'.$subject.'`';
		else if($exam==='total')
			$field='`minor1_'.$subject.'`,`minor2_'.$subject.'`,`major_'.$subject.'`,`ca_'.$subject.'`';
		$query=mysqli_query($GLOBALS['conn1'],"SELECT enroll,$field FROM `$table` WHERE branch='$branch'");
		return $query;
		}
	
	function add_marks($data,$branch,$exam,$sem,$subject)
	{	array_walk($data,'array_sanitize');
		$sem=sanitize($sem);
		$branch=sanitize($branch);
		$subject=sanitize($subject);
		$exam=sanitize($exam);
		
		switch($sem)
		{	case 'I'   : $table='sem_1';	break;
			case 'II'  : $table='sem_2';	break;
			case 'III' : $table='sem_3_'.$branch;	break;
			case 'IV'  : $table='sem_4_'.$branch;	break;
			case 'V'   : $table='sem_5_'.$branch;	break;
			case 'VI'  : $table='sem_6_'.$branch;	break;
			case 'VII' : $table='sem_7_'.$branch;	break;
			case 'VIII': $table='sem_8_'.$branch;	break;
			}
		$field=$exam.'_'.$subject;
		$enroll=array_keys($data);
		foreach($enroll as $x)
		{	mysqli_query($GLOBALS['conn1'],"UPDATE `$table` SET `$field`=$data[$x] WHERE enroll='$x' AND branch='$branch'");
			}
		}
	function marks_form($sem,$branch,$subject,$exam)
	{	$sem=sanitize($sem);
		$branch=sanitize($branch);
		$subject=sanitize($subject);
		$exam=sanitize($exam);
		
		switch($sem)
		{	case 'I': $table='sem_1';	break;
			case 'II': $table='sem_2';	break;
			case 'III': $table='sem_3_'.$branch;	break;
			case 'IV': $table='sem_4_'.$branch;	break;
			case 'V': $table='sem_5_'.$branch;	break;
			case 'VI': $table='sem_6_'.$branch;	break;
			case 'VII': $table='sem_7_'.$branch;	break;
			case 'VIII': $table='sem_8_'.$branch;	break;
			}
		$field=$exam.'_'.$subject;
		$query=mysqli_query($GLOBALS['conn1'],"SELECT enroll,$field FROM `$table` WHERE branch='$branch'");
		return $query;
		}
	function register_student($register_data)
	{	array_walk($register_data,'array_sanitize');
		if($register_data['sem']==='I'||$register_data['sem']==='II')
			$year='year_1';
		else if($register_data['sem']==='III'||$register_data['sem']==='IV')
			$year='year_2';
		else if($register_data['sem']==='V'||$register_data['sem']==='VI')
			$year='year_3';
		else if($register_data['sem']==='VII'||$register_data['sem']==='VIII')
			$year='year_4';
		$fields=implode(',',array_keys($register_data));
		$data='\''.implode('\',\'',$register_data).'\'';
		mysqli_query($GLOBALS['conn'],"INSERT INTO $year ($fields) VALUES ($data)");
		}
	function student_exists($enroll,$sem,$branch)
	{	$enroll=sanitize($enroll);
		$sem=sanitize($sem);
		$branch=sanitize($branch);
		if($sem==='I'||$sem==='II')
			$year='year_1';
		else if($sem==='III'||$sem==='IV')
			$year='year_2';
		else if($sem==='V'||$sem==='VI')
			$year='year_3';
		else if($sem==='VII'||$sem==='VIII')
			$year='year_4';
		$query=mysqli_query($GLOBALS['conn'],"SELECT * FROM $year WHERE enroll='$enroll' AND branch='$branch'");
		return (mysqli_num_rows($query)==1)?true:false;			
		}
	function student_email_exists($email,$sem)
	{	$email=sanitize($email);
		$sem=sanitize($sem);
		if($sem==='I'||$sem==='II')
			$year='year_1';
		else if($sem==='III'||$sem==='IV')
			$year='year_2';
		else if($sem==='V'||$sem==='VI')
			$year='year_3';
		else if($sem==='VII'||$sem==='VIII')
			$year='year_4';
		$query=mysqli_query($GLOBALS['conn'],"SELECT * FROM $year WHERE email='$email'");
		return (mysqli_num_rows($query)==1)?true:false;			
		}
	function search_by_name($name,$year,$branch)
	{	$name=sanitize($name);
		$year=sanitize($year);
		$branch=sanitize($branch);
		if($year==='I')
			$year='year_1';
		else if($year==='III')
			$year='year_2';
		else if($year==='V')
			$year='year_3';
		else if($year==='VII')
			$year='year_4';
		if(empty($name)===true)
		{	if(empty($branch)===false&&empty($year)===true)
				$query="SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_1 WHERE branch='$branch' 
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_2 WHERE branch='$branch' 
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_3 WHERE branch='$branch' 
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_4 WHERE branch='$branch' ORDER BY sem";
			else if(empty($branch)===false&&empty($year)===false)
				$query="SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM $year WHERE branch='$branch' ORDER BY enroll";
			}
		else if(empty($branch)===true)	
		{	if(empty($name)===false&&empty($year)===true)
				$query="SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_1 WHERE first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_2 WHERE first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_3 WHERE first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_4 WHERE first_name='$name' ORDER BY sem";
			else if(empty($name)===false&&empty($year)===false)
				$query="SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM $year WHERE first_name='$name' ORDER BY enroll";
			}
		else if(empty($year)===true)
		{	if(empty($name)===false&&empty($branch)===true)
				$query="SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_1 WHERE first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_2 WHERE first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_3 WHERE first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_4 WHERE first_name='$name' ORDER BY sem";
			else if(empty($name)===true&&empty($branch)===false)
				$query="SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_1 WHERE branch='$branch' 
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_2 WHERE branch='$branch'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_3 WHERE branch='$branch'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_4 WHERE branch='$branch' ORDER BY sem";
			else
				$query="SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_1 WHERE branch='$branch' AND first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_2 WHERE branch='$branch' AND first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_3 WHERE branch='$branch' AND first_name='$name'  
						UNION SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM year_4 WHERE branch='$branch' AND first_name='$name' ORDER BY sem";
			}
		else 
			$query="SELECT enroll,batch,first_name,last_name,email,phone,sem,branch FROM $year WHERE first_name='$name' AND branch='$branch' ORDER BY enroll";
			
		$result=mysqli_query($GLOBALS['conn'],$query);
		return $result;
		}
	function delete_user($user_id)
	{	mysqli_query($GLOBALS['conn'],"DELETE FROM users WHERE user_id=$user_id");
		}	
	function update_user($update_data)
	{	GLOBAL $user_data;
		array_walk($update_data,'array_sanitize');
		$update=array();
		foreach($update_data as $field=>$data)
		{	$update[]=$field.' = \''.$data.'\'';
			}
		mysqli_query($GLOBALS['conn'],'UPDATE users SET '.implode(',',$update).' WHERE user_id='.$user_data['user_id']);
		}	
	function activate($email,$email_code)
	{	$email= sanitize($email);
		$email_code=sanitize($email_code);
		
		$query=mysqli_query($GLOBALS['conn'],"SELECT * FROM users WHERE email='$email' AND email_code='$email_code' AND active=0");
		if(mysqli_num_rows($query)==1)
		{	mysqli_query($GLOBALS['conn'],"UPDATE users SET active=1 WHERE email='$email'");
			return true;
			}
		else
			return false;
		}
	function change_password($user_id,$password)
	{	$user_id=(int)$user_id;
		$password=md5($password);
		mysqli_query($GLOBALS['conn'],"UPDATE users SET password='$password' WHERE user_id=$user_id");
		}
	function register_user($register_data)
	{	array_walk($register_data,'array_sanitize');
		$register_data['password']=md5($register_data['password']);
		foreach($register_data as $field=>$data)
		{	$update[]=$field.' = \''.$data.'\'';
			}
		$query='UPDATE users SET '.implode(',',$update).' WHERE first_name=\''.$register_data['first_name'].'\' AND last_name=\''.$register_data['last_name'].'\' AND department=\''.$register_data['department'].'\'';
		mysqli_query($GLOBALS['conn'],$query);
		echo "Hello " . $register_data['first_name'] .
		",<br/><br/>you need to activate your account, so copy the link below to url tab:<br/><br/>
		http://localhost/e-access/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']."
		<br/><br/>-e-access";
		die();
		/*	email($register_data['email'],'activate your account',"
		Hello " . $register_data[first_name] .
		",<br/><br/>you need to activate your account, so use the link below:<br/><br/>
		http://localhost/e-access/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']."
		<br/><br/>-e-access
		");*/
		}

	function set_user($first_name,$last_name,$department,$desc)
	{	$first_name=sanitize($first_name);
		$last_name=sanitize($last_name);
		$department=sanitize($department);
		$desc=sanitize($desc);
		
		$result=mysqli_query($GLOBALS['conn'],'SELECT user_id,first_name,last_name,department,user_desc FROM users WHERE INSTR(user_desc,\''.$desc.'\')>0');
		while($x=mysqli_fetch_assoc($result))	
			if($x['first_name']!=='\''.$first_name.'\''&&$x['last_name']!=='\''.$last_name.'\''&&$x['department']!=='\''.$department.'\'')
				$value=$x;
		$detail=$value['user_desc'];
		$detail=explode(',',$detail);
		$new_desc=array();
		
		foreach($detail as $x)
			if($x!==$desc)
				$new_desc[]=$x;	
		$new_desc=implode(',',$new_desc);
		if(empty($new_desc)===true)
		{	delete_user($value['user_id']);
			//header('Location:index.php');
			}
		else
		{	mysqli_query($GLOBALS['conn'],'UPDATE users SET user_desc=\''.$new_desc.'\' WHERE user_id=\''.$value['user_id'].'\'');
			}
				
		$result=check_account($first_name,$last_name,$department);
		$result=mysqli_fetch_assoc($result);
		if(empty($result))
		{	$query="INSERT INTO users (first_name,last_name,department,user_desc) VALUES ('$first_name','$last_name','$department','$desc')";
		//	echo $query;
		//	exit();
			}
		else
		{	$value=array();
			$value[]=$result['user_desc'];
			$value[]=$desc;
			$value=implode(',',$value);
			$query="UPDATE users SET user_desc='$value' WHERE first_name='$first_name' AND last_name='$last_name' AND department='$department'";
			}
		mysqli_query($GLOBALS['conn'],$query);
		}
	function check_desc($desc)
	{	$desc=sanitize($desc);
		$query='SELECT first_name,last_name,department,user_desc FROM users WHERE INSTR(user_desc,\''.$desc.'\')>0';
		$result=mysqli_query($GLOBALS['conn'],$query);
		return $result;
		}
	function check_account($first_name,$last_name,$department)
	{	$first_name=sanitize($first_name);
		$last_name=sanitize($last_name);
		$department=sanitize($department);
		$query=mysqli_query($GLOBALS['conn'],"SELECT * FROM users WHERE first_name='$first_name' AND last_name='$last_name' AND department='$department'");
		return ($query);		
		}
	function user_data($user_id)
	{	$data=array();
		$user_id=(int)$user_id;
		$func_num_args=func_num_args();				
		$func_get_args=func_get_args();				
		if($func_num_args>1)
		{	unset($func_get_args[0]);
			$fields='`'.implode('`,`',$func_get_args).'`';
			$data=mysqli_fetch_assoc(mysqli_query($GLOBALS['conn'],"SELECT $fields FROM users WHERE user_id=$user_id"));
			return $data; 
			}
		}
	function logged_in()
	{	return (isset($_SESSION['user_id']))?true:false;
		}
	function user_exists($username)
	{	$username=sanitize($username);
		$query=mysqli_query($GLOBALS['conn'],"SELECT * FROM users WHERE username='$username'");
		return (mysqli_num_rows($query)==1)?true:false;			
		}
	function email_exists($email)
	{	$email=sanitize($email);
		$query=mysqli_query($GLOBALS['conn'],"SELECT * FROM users WHERE email='$email'");
		return (mysqli_num_rows($query)==1)?true:false;			
		}
	function user_active($username)
	{	$username=sanitize($username);
		$query=mysqli_query($GLOBALS['conn'],"SELECT * FROM users WHERE username='$username' AND active=1");		
		return (mysqli_num_rows($query)==1)?true:false;				
		}
	function user_id_from_username($username)
	{	$username=sanitize($username);
		$query=mysqli_query($GLOBALS['conn'],"SELECT user_id FROM users WHERE username='$username'");
		$row= mysqli_fetch_assoc($query);
		return $row['user_id'];
		}
	function login($username,$password)
	{	$user_id=user_id_from_username($username);
		$username=sanitize($username);
		$password=md5($password);
		$query=mysqli_query($GLOBALS['conn'],"SELECT * FROM users WHERE username ='$username' AND password='$password'"); 
		$rows=mysqli_num_rows($query);
		return ($rows==1)?($user_id):false;
		}
	?>