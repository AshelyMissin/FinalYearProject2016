<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link >
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
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
// Add Event PHP
if (isset($_POST['addSubmit']) == true) {
	$newevent=isset($_POST['eventName']) ? $_POST['eventName'] : '';
	$newmanager=isset($_POST['newmanager']) ? $_POST['newmanager'] : '';
	$addsql="INSERT INTO event_type (event_type,employee_ID) VALUES ('$newevent','$newmanager');";
	$addquery=mysqli_query($conn, $addsql);
	if($addquery) {
		echo "<script type='text/javascript'>
		alert('Event added!');
		window.close();
		</script>";			
	} else {
		echo "<script type='text/javascript'>
		alert('Event not added');
		window.close();
		</script>";
		echo mysqli_error($conn);
	}
}
// Delete Event PHP
if (isset($_POST['deleteSubmit']) == true) {
	$deleteEvent=$_POST['deleteEvent'];
	$deletesql="DELETE FROM event_type WHERE event_type='$deleteEvent';";
	$deletequery=mysqli_query($conn, $deletesql);
	if($deletequery) {
		echo "<script type='text/javascript'>
		alert('Event deleted.');
		window.close();
		</script>";			
	} else {
		echo "<script type='text/javascript'>
		alert('Event not deleted.');
		window.close();
		</script>";
		echo mysqli_error($conn);		
	}
}
?>
<body>
<div class="container-fluid">
<h1>Modify Event</h1>
<h4>Add, edit or delete events using the dropdowns below:</h4>
	<div class="panel-group" id="accordian">
	<!-- Add Event accordian -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#addType">
					<b>Add Event</b></a>
				</h4>
			</div>
			<div id="addType" class="panel-collapse collapse">
				<div class="panel-body">
					<form role="form" method="post" action="">
						<div class="form-group">
							<label for="eventName" style="color:#FF00FF;">Event Name:</label>
							<input type="text" class="form-control" name="eventName" id="eventName" placeholder="Enter event name" required="required">
						</div>
						<div class="form-group">
							<label for="addManager" style="color:#FF00FF;">Choose the Event Manager:</label>
							<select class="form-control" name="newmanager" id="addManager">
								<option value="default" disabled selected>Select an event manager</option>
							<?php
								$managersql="SELECT * FROM employee ORDER BY employee_name ASC";
								$managerquery=mysqli_query($conn, $managersql);
								while($managerResult=mysqli_fetch_array($managerquery, MYSQLI_ASSOC)) {
									echo "<option value='{$managerResult['employee_ID']}'>{$managerResult['employee_name']}</option>";
								}
							?>
							</select>
						</div>						
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="addSubmit" value="Add Event">
						</div>
					</form>
				</div>
			</div>
		</div>
	<!-- Edit Event accordian -->		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#editBusiness">
					<b>Edit Event</b></a>
				</h4>
			</div>
			<div id="editBusiness" class="panel-collapse collapse">
				<div class="panel-body">
					<form role="form" method="post" action="editEvent.php">
						<div class="form-group">
							<label for="selectEvent" style="color:#FF00FF;">Event Name:</label>
							<select class="form-control" name="selected" id="selectEvent" placeholder="Choose an event to remove">
								<option value="default" disabled selected>Select an event</option>
							<?php
								$eventsql="SELECT * FROM event_type ORDER BY event_type ASC";
								$eventquery=mysqli_query($conn, $eventsql);
								while($result=mysqli_fetch_array($eventquery, MYSQLI_ASSOC)) {
									echo "<option value='{$result['event_type']}'>{$result['event_type']}</option>";
								}
							?>
							</select>
						</div>							
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="submit" value="Edit Event">
						</div>
					</form>
				</div>
			</div>
		</div>
	<!-- Delete Event accordian -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#deleteBusiness">
					<b>Delete Event</b></a>
				</h4>
			</div>
			<div id="deleteBusiness" class="panel-collapse collapse">
				<div class="panel-body">
					<form role="form" method="post" action="">
						<div class="form-group">
							<label for="deleteEvent" style="color:#FF00FF;">Event Name:</label>
							<select class="form-control" name="deleteEvent" placeholder="Choose an event to remove">
								<option value="default" disabled selected>Select an event</option>
							<?php
								$eventsql="SELECT * FROM event_type";
								$eventquery=mysqli_query($conn, $eventsql);
								while($result=mysqli_fetch_array($eventquery, MYSQLI_ASSOC)) {
									echo "<option value='{$result['event_type']}'>{$result['event_type']}</option>";
								}
							?>
							</select>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info delete" style="background-color:#D9534F; border-color:red;" onClick="return checkDelete()" name="deleteSubmit" value="Delete Event">
						</div>
					</form>
				</div>
			</div>
		</div>		
	</div>
</div>
</body>
</html>