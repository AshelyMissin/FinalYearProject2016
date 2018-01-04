<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
$deleteBusiness=isset($_POST['deleteBusiness']) ? $_POST['deleteBusiness'] : '';
$deletesql="DELETE FROM business WHERE business_name='$deleteBusiness';";
$deletequery=mysqli_query($conn, $deletesql);
if($deletequery) {
	echo "<script type='text/javascript'>
	alert('Business deleted.');
	window.close();
	</script>";			
} else {
	echo "<script type='text/javascript'>
	alert('Business not deleted.');

	</script>";
	echo mysqli_error($conn);		
}
?>