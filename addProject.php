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
<?php
$conn=mysqli_connect("127.0.0.1","root","","m026446e");
?>
<body>
	<div class="container-fluid">
	<h1 style="text-align:center;">Add Project</h1>
		<form name="register" method="post" action="">
			<div class="panel-group" id="accordian">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse1">
							Insert New Project Name:</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="new_project" placeholder="Enter project name" required="required">
						</div>
					</div>
				</div>
			</div>
			<!-- Centers insert button -->
			<div style="text-align:center;">
				<input type="submit" class="btn btn-info" style="background-color:#FF00FF;" name="submit" value="Add Project">
			</div>
		</form>
	<?php
	if (isset($_POST['submit']) == true) {	
		$new_project=isset($_POST['new_project']) ? $_POST['new_project'] : '';
		$sql="INSERT INTO project (Project_Name) VALUES ('$new_project');";
		$query=mysqli_query($conn, $sql);
		if($query) {
			echo "<script type='text/javascript'>
			alert('Project added successfully!');
			</script>";
			header("Refresh:0; url=StockInventory.php");		
		} else {
			echo "<script type='text/javascript'>
			alert('Project not added.');
			</script>";
			header("Refresh:0; url=StockInventory.php");		
		}
	}
	?>
	</div>
</body>
</html>