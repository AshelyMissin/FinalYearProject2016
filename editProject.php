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
</head>
<body>
<?php
$conn=mysqli_connect("127.0.0.1","root","","m026446e");
$chosenproject=isset($_POST['chosenproject']) ? $_POST['chosenproject'] : '';
$project_name=isset($_POST['project_name']) ? $_POST['project_name'] : '';
$sql="UPDATE project
	  SET Project_Name='$project_name'
	  WHERE Project_Name='$chosenproject'";;
if (isset($_POST['submit']) == true) {
	$query=mysqli_query($conn, $sql);
	if($query) {
		echo "<script type='text/javascript'>
		alert('Project edited successfully!');
		window.close();
		</script>";		
	} else {
		echo "<script type='text/javascript'>
		alert('Project not edited.');
		window.close();
		</script>";	
	}
}
?>
	<div class="container-fluid">
	<h1 style="text-align:center;">Edit Project</h1>
		<form name="" method="post" action="">
			<div class="panel-group" id="accordian">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse4">
							Please select the project you would like to update:</a>
						</h4>
					</div>
					<div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
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
						</div>
					</div>
				</div>			
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse1">
							Edit Project:</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="project_name" value="" placeholder="Edit Project Name" required="required">
						</div>
					</div>
				</div>
			</div>
			<!-- Centers insert button -->
			<div style="text-align:center;">
				<input type="submit" class="btn btn-info" style="background-color:#FF00FF;" name="submit" value="Edit Project">
			</div>
		</form>
	</div>
</body>
</html>