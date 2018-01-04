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
	<div class="container-fluid">
	<h1 style="text-align:center;">Insert Item</h1>
		<form name="register" method="post" action="addItem.php">
			<div class="panel-group" id="accordian">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse1">
							Insert Item Name:</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="stock_name" placeholder="Enter stock name" required="required">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse2">
							Insert Item's Category:</a>
						</h4>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="stock_category" placeholder="Enter the item's description" required="required">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse3">
							Insert Item's Description:</a>
						</h4>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="stock_description" placeholder="Enter the item's description" required="required">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse4">
							Project:</a>
						</h4>
					</div>
					<div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
							<?php
								$conn = mysqli_connect("127.0.0.1","root","","m026446e");
								if(mysqli_connect_errno($conn)) {
									echo "<script type='text/javascript'>
									alert('Unable to connect to database server.');
									</script>";
								} else {
									$sql = "SELECT Project_Name from project";
									$query = mysqli_query($conn, $sql);
									echo '<select class="form-control" name="chosenproject">';
									echo "<option value='default'>Project Select...</option>";
									while($project = mysqli_fetch_assoc($query)) {
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
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse5">
							Donator's Name (Type Anon for Anonymous Donations):</a>
						</h4>
					</div>
					<div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="donator_name" placeholder="Enter donator's name" required="required">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse6">
							Donation Allocation:</a>
						</h4>
					</div>
					<div id="collapse6" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="donation_allocation" placeholder="Enter recipient's name">
						</div>
					</div>
				</div>
			</div>
			<!-- Centers insert button -->
			<div style="text-align:center;">
				<input type="submit" class="btn btn-info" style="background-color:#FF00FF;" name="submit" value="Insert Entry">
			</div>
		</form>
	<?php
	$stock_name=isset($_POST['stock_name']) ? $_POST['stock_name'] : '';
	$stock_category=isset($_POST['stock_category']) ? $_POST['stock_category'] : '';
	$stock_description=isset($_POST['stock_description']) ? $_POST['stock_description'] : '';
	$chosenproject=isset($_POST['chosenproject']) ? $_POST['chosenproject'] : '';
	$donator_name=isset($_POST['donator_name']) ? $_POST['donator_name'] : '';
	$donation_allocation=isset($_POST['donation_allocation']) ? $_POST['donation_allocation'] : '';
	$projectquery="SELECT stock.project_ID,project.Project_Name
						   FROM stock
						   INNER JOIN project
						   ON stock.project_ID=project.project_ID
						   WHERE project.Project_Name='".$chosenproject."'";
	if (isset($_POST['submit']) == true) {
		if (($_POST['chosenproject']) == "default") {
			echo "Please select a project.";
			unset($_POST['chosenproject']);
			die;
		} else {
			$result = mysqli_query($conn,$projectquery);
			if (!$query) {
				echo "<script type='text/javascript'>
				alert('Unable to connect to database server.');
				</script>";
			} else {
				$projectsqli=(mysqli_fetch_assoc($result));
				$project_number=$projectsqli["project_ID"];
				echo $project_number;
				$dataquery="INSERT INTO stock 
							VALUES (NULL,'$stock_name','$stock_category','$stock_description','$project_number','$donator_name','$donation_allocation')";
					if (!mysqli_query($conn,$dataquery)) {
						echo "<script type='text/javascript'>
						alert('Insert failed.');
						window.close();
						</script>";
					} else {
						echo "<script type='text/javascript'>
						alert('Item added successfully!');
						window.close();
						</script>";
					}
				}
			}
		}
	?>
	</div>
</body>
</html>