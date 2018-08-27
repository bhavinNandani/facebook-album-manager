<?php
	session_start();
	
	//include_once('connection.php');
	
	if(isset($_SESSION['access_token']) || isset($_SESSION['Google_Token'])) 
	{
	    
	  
			session_unset(); 
			session_destroy();
	
		
		header("location:index.php");
	}
	//header("location:index.php");
	?>
