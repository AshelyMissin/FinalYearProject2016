<?php
	session_start();
	if(isset($_SESSION['level']) == True) {	
		unset($_SESSION['level']);
		session_destroy();
	}
	echo "<script type='text/javascript'>
		alert('You have logged out successfully.');
	</script>";
	header('Refresh: 0;url=Login.php');
?>