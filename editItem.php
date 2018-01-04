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
if(isset($_GET['id'])) {
	$id=$_GET['id'];
	if(isset($_POST['submit'])) {
		$new_stock_name=$_POST['stock_name'];
		$new_stock_category=$_POST['stock_category'];
		$new_stock_description=$_POST['stock_description'];
		$new_chosenproject=$_POST['chosenproject'];
			$sql="SELECT project_ID, Project_Name from project WHERE Project_Name='$new_chosenproject'";
			$query=mysqli_query($conn, $sql);
			$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
			$project_number=$row['project_ID'];
		$new_donator_name=$_POST['donator_name'];
		$new_donation_allocation=$_POST['donation_allocation'];
		$sql1="
		UPDATE stock
		SET stock_name='$new_stock_name',stock_category='$new_stock_category',stock_description='$new_stock_description',project_ID='$project_number',donator_name='$new_donator_name',donation_allocation='$new_donation_allocation'
		WHERE stock_ID='$id'";
		$query1=mysqli_query($conn, $sql1);
		if($query1) {
				echo "<script type='text/javascript'>
				alert('Entry edited successfully!');
				window.close();
				</script>";
		} else {		
				echo (mysqli_error($conn));
				echo "<script type='text/javascript'>
				alert('Entry not edited successfully');
				window.close();
				</script>";				
		}
	}
	// Collects the current data entries for the ID sent across
	$sql2="
	SELECT stock.stock_name,stock.stock_category,stock.stock_description,project.Project_Name,stock.donator_name,stock.donation_allocation
	FROM stock
	INNER JOIN project
	ON stock.project_ID=project.project_ID
	WHERE stock_ID='$id'";
	$query2=mysqli_query($conn, $sql2);
	$current=mysqli_fetch_array($query2, MYSQLI_ASSOC);
	$current_stock_name=$current['stock_name'];
	$current_stock_category=$current['stock_category'];
	$current_stock_description=$current['stock_description'];
	$current_project=$current['Project_Name'];
	$current_donator_name=$current['donator_name'];
	$current_donation_allocation=$current['donation_allocation'];
?>
	<div class="container-fluid">
	<h1 style="text-align:center;">Edit Item</h1>
		<form name="" method="post" action="">
			<div class="panel-group" id="accordian">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse1">
							Edit Item Name:</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="stock_name" value="<?php echo $current_stock_name; ?>" placeholder="Enter stock name" required="required">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse2">
							Edit Item's Category:</a>
						</h4>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="stock_category" value="<?php echo $current_stock_category; ?>" placeholder="Enter the item's description" required="required">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse3">
							Edit Item's Description:</a>
						</h4>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="stock_description" value="<?php echo $current_stock_description; ?>" placeholder="Enter the item's description" required="required">
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
								if(mysqli_connect_errno($conn)) {
									echo "<script type='text/javascript'>
									alert('Unable to connect to database server.');
									</script>";
								} else {
									$sql = "SELECT Project_Name from project";
									$query = mysqli_query($conn, $sql);
									echo '<select class="form-control" name="chosenproject">';
									while($project = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
										echo "<option value='{$project['Project_Name']}' " . ($project['Project_Name']==$current_project ? 'selected' : '') . ">{$project['Project_Name']}</option>";
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
							Edit Donator's Name (Type Anon for Anonymous Donations):</a>
						</h4>
					</div>
					<div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="donator_name" value="<?php echo $current_donator_name; ?>" placeholder="Enter donator's name" required="required">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#collapse6">
							Edit Donation Allocation (Type TBD for No Current Allocation) :</a>
						</h4>
					</div>
					<div id="collapse6" class="panel-collapse collapse">
						<div class="panel-body">
							<input type="text" class="form-control" name="donation_allocation" value="<?php echo $current_donation_allocation; ?>" placeholder="Enter recipient's name">
						</div>
					</div>
				</div>
			</div>
			<!-- Centers insert button -->
			<div style="text-align:center;">
				<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="submit" value="Edit Entry">
			</div>
		</form>
		<?php
		}
		?>
	</div>
</body>
</html>