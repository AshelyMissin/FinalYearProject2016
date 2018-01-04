<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
if(isset($_GET['id'])) {
	$event_id=$_GET['id'];
	$idsql="SELECT event_type FROM event_type WHERE event_type_ID='$event_id';";
	$idquery=mysqli_query($conn, $idsql);
	$idrow=mysqli_fetch_array($idquery, MYSQLI_ASSOC);
	$event_name=$idrow['event_type'];
} else {
	echo "<script type='text/javascript'>
	alert('No event ID set! Please access this window from the Events page.');
	window.close();
	</script>";
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Assign Business - Alice Charity Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="animated_favicon1.gif" rel="icon" type="image/gif">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure you want to delete this event?');
}
</script>
</head>
<?php
if (isset($_POST['assignSubmit']) == true) {
	$selectedBusiness=isset($_POST['businessName']) ? $_POST['businessName'] : '';
	$assignsql="INSERT INTO event (business_ID,event_type_ID) VALUES ('$selectedBusiness','$event_id');";
	$assignquery=mysqli_query($conn, $assignsql);
	if($assignquery) {
		echo "<script type='text/javascript'>
		alert('Business assigned successfully!');
		window.close();
		</script>";			
	} else {
		echo "<script type='text/javascript'>
		alert('Business not assigned.');
		window.close();
		</script>";
		echo ("Error description: " . mysqli_error($conn));		
	}
}
?>
<body>
<div class="container-fluid">
<h1>Assign a Business</h1>
<h4>Use the options below to assign a business to <b><?php echo $event_name; ?></b></h4>
	<div class="panel-group" id="accordian">
	<!-- Assign Business accordian -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#assignBusiness">
					<b>Assign Business</b></a>
				</h4>
			</div>
			<div id="assignBusiness" class="panel-collapse collapse in">
				<div class="panel-body">
					<form role="form" method="post" action="">					
						<div class="form-group">
							<label for="businessName">Business Name:</label>
							<select class="form-control" name="businessName" id="businessName">
								<option value="default" disabled selected>Select a Business...</option>
							<?php
								$businessSql="SELECT business_ID,business_name FROM business ORDER BY business_name ASC;";
								$businessQuery=mysqli_query($conn, $businessSql);
								while($businessRow=mysqli_fetch_array($businessQuery, MYSQLI_ASSOC)) {
									echo "<option value='{$businessRow['business_ID']}'>{$businessRow['business_name']}</option>";
								}
							?>
							</select>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="assignSubmit" value="Assign Business">
						</div>						
					</form>							
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>