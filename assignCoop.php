<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
if(isset($_GET['id'])) {
	$business_id=$_GET['id'];
} else {
	echo "<script type='text/javascript'>
	alert('No event ID set! Please access this window from the Events page.');
	window.close();
	</script>";
}
if (isset($_POST['coopSubmit']) == true) {
	$coop=$_POST['coopSubmit'];							
	$coopupdate="UPDATE business SET cooperative='$coop' WHERE business_ID='$business_id';";
	$coopquery=mysqli_query($conn, $coopupdate);
	if($coopquery) {
		echo "<script type='text/javascript'>
		alert('Edit successful!');
		window.close();
		</script>";	
	} else {
		echo "<script type='text/javascript'>
		alert('Edit unsuccessful');
		window.close();
		</script>";											
		echo("Error description: " . mysqli_error($conn));													
	}		
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assign Event Assistance - Management System</title>
<link rel="icon" type="image/gif" href="animated_favicon1.gif">
<!-- Links to Bootstrap stylesheets -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
	h1, h4 {
		color:#FF00FF!important;
		text-align:center;
	}
</style>
<body>
<div class="container-fluid">
<h4>Will this business be assisting at this event?</h4>
</br>
<form role="form" method="post" action="">
	<div style="text-align:center;">
		<label class="radio-inline" style="color:#FF00FF; font-size:24px;"><input type="radio" name="coopSubmit" value="Yes" onclick="submit();"><b>Yes</b></label>
		<label class="radio-inline" style="color:#FF00FF; font-size:24px;"><input type="radio" name="coopSubmit" value="No" onclick="submit();"><b>No</b></label>
	</div>
</form>
</div>
</body>
</html>