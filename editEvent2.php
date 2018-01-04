<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
$selectedEvent=isset($_POST['selectedEvent']) ? $_POST['selectedEvent'] : '';
	$selectsql="SELECT * FROM event_type WHERE event_type='$selectedEvent';";
	$selectquery=mysqli_query($conn, $selectsql);
	$selectrow=mysqli_fetch_array($selectquery, MYSQLI_ASSOC);
	$event_ID=$selectrow['event_type_ID'];
$newEvent=isset($_POST['editEvent']) ? $_POST['editEvent'] : '';
$newManager=isset($_POST['editManager']) ? $_POST['editManager'] : '';
$editsql="
UPDATE event_type
SET event_type='$newEvent',employee_ID='$newManager'
WHERE event_type_ID='$event_ID'
;";
$editquery=mysqli_query($conn, $editsql);
if($editquery) {
	echo "<script type='text/javascript'>
	alert('Edit successful');
	window.close();
	</script>";	
} else {
	echo "<script type='text/javascript'>
	alert('Edit unsuccessful');
	</script>";											
	echo("Error description: " . mysqli_error($conn));		
}
?>