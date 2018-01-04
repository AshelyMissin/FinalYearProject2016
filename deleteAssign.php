<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
if(isset($_GET['id'])) {
	$event_id=$_GET['id'];
	$deletesql="DELETE FROM event WHERE event_ID='$event_id';";
	$deletequery=mysqli_query($conn, $deletesql);
	if($deletequery) {
		echo "<script type='text/javascript'>
		alert('Business assignment deleted.');
		history.go(-1);
		</script>";
		// header("Refresh:0; url=Events.php");
	} else {
		echo "<script type='text/javascript'>
		alert('Business assignment not deleted.');
		history.go(-1)
		</script>";
		// header("Refresh:0; url=Events.php");
	}
} else {
	echo "<script type='text/javascript'>
	alert('No event ID set! Please access this window from the Events page.');
	history.go(-1)
	</script>";
	// header("Refresh:0; url=Events.php");
}
?>