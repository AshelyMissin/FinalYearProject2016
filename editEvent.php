<?php
	session_start();
	if($_SESSION['level'] == '1') {
		echo "<script type='text/javascript'>
		alert('Unauthorised access.');
		window.close();
		</script>";
	}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Edit Business - Alice Charity Management System</title>
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
</head>
<body>
<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
$selectedevent=isset($_POST['selected']) ? $_POST['selected'] : '';
$currentsql="
SELECT *
FROM event_type
INNER JOIN employee ON event_type.employee_ID=employee.employee_ID
WHERE event_type='$selectedevent'
;";
$currentquery=mysqli_query($conn, $currentsql);
if($currentquery) {
	$currentrow=mysqli_fetch_array($currentquery, MYSQLI_ASSOC);
	$currentEventType=$currentrow['event_type'];
	$currentManager=$currentrow['employee_name'];
}
?>
<div class="container-fluid">
<h1>Edit Event</h1>
	<form name="" method="post" action="editEvent2.php">		
		<div class="panel-group" id="accordian">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordian" href="#editEvent">
						<b>Edit Event</b></a>
					</h4>
				</div>
				<div id="editEvent" class="panel-collapse collapse in">
					<div class="panel-body">
						<div class="form-group">
							<input type="text" class="form-control hidden" name="selectedEvent" placeholder="Enter event name" value="<?php echo $selectedevent; ?>">
						</div>					
						<div class="form-group">
							<label for="editEvent">Edit this Event Name:</label>
							<input type="text" class="form-control" name="editEvent" id="editEvent" placeholder="Enter event name"  value="<?php echo $selectedevent; ?>">
						</div>
						<div class="form-group">
							<label for="editManager">Change the Event Manager:</label>
							<select class="form-control" name="editManager" id="editManager">
							<?php
								$managersql="SELECT * FROM employee ORDER BY employee_name ASC";
								$managerquery=mysqli_query($conn, $managersql);
								while($managerResult=mysqli_fetch_array($managerquery, MYSQLI_ASSOC)) {
									echo "<option value='{$managerResult['employee_ID']}' " . ($managerResult['employee_name']==$currentManager ? 'selected' : '') . ">{$managerResult['employee_name']}</option>";
								}
							?>
							</select>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="submit" value="Edit Event">
						</div>						
</div>
</body>
</html>