<?php
	session_start();					
	//error_reporting(0);					
	require 'database/connect.php';
    require 'functions/general.php';
	require 'functions/users.php';
	
	if(logged_in()===true)
	{	$session_user_id=$_SESSION['user_id'];
		$user_data = user_data($session_user_id,'user_id','username','department','first_name','last_name','email','phone','password','user_desc');
		$value=array();
		$here_branch=array();
		$here_sem=array();
		if(preg_match("/coord_/",$user_data['user_desc'])==true)
		{	$desc=explode(',',$user_data['user_desc']);
			foreach($desc as $x)
			{	if(preg_match("/coord_/",$x)==true)
					$value[]=$x;
				}
			foreach($value as $x)
			{	$x=substr($x,6);
				$b=substr($x,0,strpos($x,'_'));
				$val=substr($x,strlen($b)+1);
				$here_sem[]=substr($val,0,strpos($val,'_'));
				if($b==='sem')
					$here_branch[]='All';
				else 
					$here_branch[]=$b;
				}
			}
		if(user_active($user_data['username'])===false)
		{	session_destroy();
			header('Location:index.php');
			exit();
			}
		}
	$errors = array();
	
?>
