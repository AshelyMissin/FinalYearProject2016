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

</style>
</head>
<body>
<?php
if(isset($_GET['id'])) {
	$conn = mysqli_connect("127.0.0.1","root","","m026446e");
	$stock_ID=$_GET['id'];
	$sql="DELETE from stock where stock_ID='$stock_ID'";
	$query=mysqli_query($conn, $sql);
	if($query) {
		echo "<script type='text/javascript'>
		alert('Entry deleted.');
		window.close();
		</script>";
	} else {
		echo "<script type='text/javascript'>
		alert('Entry not deleted.');
		window.close();
		</script>";
	}
} else {
	echo "<script type='text/javascript'>
	alert('Stock ID not set!');
	window.close();
	</script>";
}
?>
</body>
</html>