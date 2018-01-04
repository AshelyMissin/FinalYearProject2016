<?php
	session_start();
	if($_SESSION['level'] == '1') {
		echo "<script type='text/javascript'>
		alert('Unauthorised access.');
		window.close();
		</script>";
	}
?>
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
if (isset($_POST['editSubmit']) == true) {
	$coop=$_POST['editSubmit'];							
	$editsql="UPDATE business SET cooperative='$coop' WHERE business_ID='$business_id';";
	$editquery=mysqli_query($conn, $editupdate);
	if($editquery) {
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
$currentsql=
"
SELECT event.event_ID, business.business_name, event_type.event_type, employee.employee_name
FROM event
INNER JOIN business ON event.business_ID=business.business_ID
INNER JOIN event_type ON event.event_type_ID=event_type_ID=event_type_ID
INNER JOIN employee ON event.employee_ID=employee.employee_ID
WHERE event_ID='$event_id'
;";
$currentquery=mysqli_query($conn, $currentsql);
if ($currentquery) {
	$row=mysqli_fetch_array($currentquery, MYSQLI_ASSOC);
	$currentbusiness=$row['business_name'];
	$currentevent=$row['event_type'];
	$currentmanager=$row['employee_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Assigned Business - Management System</title>
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
	<div class="panel-group" id="accordian">
	<!-- Edit Assigned Business accordian -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#editAssignedBusiness">
					<b>Edit Assigned Business</b></a>
				</h4>
			</div>
			<div id="editAssignedBusiness" class="panel-collapse collapse in">
				<div class="panel-body">
					<form role="form" method="post" action="">					
						<div class="form-group">
							<label for="businessName">Business Name:</label>
							<select class="form-control" name="businessName" id="businessName">
							<?php
								$businessSql="SELECT business_ID,business_name FROM business ORDER BY business_name ASC;";
								$businessQuery=mysqli_query($conn, $businessSql);
								while($businessRow=mysqli_fetch_array($businessQuery, MYSQLI_ASSOC)) {
									echo "<option value='{$businessRow['business_ID']}' " . ($businessRow['business_name']==$currentbusiness ? 'selected' : '') . ">{$businessRow['business_name']}</option>";
								}
							?>
							</select>
						</div>
						<div class="form-group">
							<label for="assignedEvent">Change the assigned event:</label>
							<select class="form-control" name="assignedEvent" id="assignedEvent">
								<?php
									$eventsql="SELECT event_type_ID,event_type FROM event_type ORDER BY event_type ASC;";
									$eventquery=mysqli_query($conn, $eventsql);
									while($eventRow=mysqli_fetch_array($eventquery)) {
										echo "<option value='{$eventRow['event_type_ID']}' " . ($eventRow['event_type']==$event_name ? 'selected' : '') . ">{$eventRow['event_type']}</option>";									
									}
								?>
							</select>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="editSubmit" value="Assign Business">
						</div>						
					</form>							
				</div>
			</div>
		</div>
	</div>

</div>
</body>
</html>