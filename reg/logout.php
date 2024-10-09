<?php	
	@session_start();

	@session_unset();
	@session_destroy();
	//header("Location: home.php");
?>	

<meta http-equiv="Refresh" content="0;url=<?php echo 'http://158.140.190.252/sims/reg/sign' ?>" />