<?php
	session_start();
	if($_SESSION['level'] == '1') {
		echo "<script type='text/javascript'>
		alert('Unauthorised access.');
		window.close();
		</script>";
	}
?>
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
<script>
function checkDelete(){
    return confirm('Are you sure you want to delete this event?');
}
</script>
</head>
<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
$chosenproject=isset($_POST['chosenproject']) ? $_POST['chosenproject'] : '';
$sql="DELETE FROM project WHERE Project_Name='$chosenproject';";
if (isset($_POST['submit']) == true) {
	$query=mysqli_query($conn, $sql);
	if($query) {
		echo "<script type='text/javascript'>
		alert('Entry Deleted.');
		window.close();
		</script>";
	} else {
		echo("Error description: " . mysqli_error($conn));
		echo "<script type='text/javascript'>
		alert('Entry Not Deleted.');
		window.close();
		</script>";
	}
}
?>
<body>
	<div class="container-fluid">
	<h1 style="text-align:center; color:#FF00FF;">Delete Project</h1>
		<form name="register" method="post" action="">
			<?php
				if(mysqli_connect_errno($conn)) {
					echo "<script type='text/javascript'>
					alert('Unable to connect to database server.');
					</script>";
				} else {
					$sql = "SELECT Project_Name from project";
					$query = mysqli_query($conn, $sql);
					echo '<select class="form-control" name="chosenproject">';
					while($project = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
						echo "<option value='{$project['Project_Name']}'>{$project['Project_Name']}</option>";
						}
					echo '</select>';
				}
			?>
			<div style="text-align:center;">
				<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00FF; margin-top:10px;" name="submit" onClick="return checkDelete
				()" value="Delete Project">
			</div>
		</form>
	</div>
</body>
</html>