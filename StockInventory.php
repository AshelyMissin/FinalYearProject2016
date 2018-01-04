<?php
session_start();
if(isset($_SESSION['level']) == false) {
	header("Location: Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Stock Inventory - Alice Charity Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/gif" href="animated_favicon1.gif">
<!-- Links to Bootstrap stylesheets -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<style>
	html, body {
		background: url(Alice_Background.png) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		o-background-size: cover;
		background-size: contain;
		height:100%;
	}
	/* html, body { 
		background: url(Alice_Background.png) no-repeat; 
		background-size: contain;
		background-position:center;
	} */
/* Customisation of bootstrap's navbar colour palette */
	.navbar-font-color {
		color:white!important;
	}
	a:hover {
		background-color:#FF00BF!important;
	}
	a:active {
		background-color:#FF00BF!important;
	}
	.dropdown {
		display:inline-block!important;
	}
	.row-centered {
		text-align:center!important;
	}
	.navbar	 .navbar-nav {
		display: inline-block;
		float: none;
		vertical-align: top;			
	}
	.navbar-fixed-bottom {
		float:none;
		margin:0 auto;
		display:table;
		table-layout:fixed;
	}
	.table {
		background-color:#FF00FF!important;
		border-color:none!important;
		vertical-align:top!important;
	}
	.table th, td {
		color:white!important;
		border-color:none!important;
		text-align:center!important;
	}
</style>
<script>	
</script>
</head>
<?php 
/* Variables declared */
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
?>
<body>
<div class="row">
	<div class="container" style="font-family:Verdana, Geneva, sans-serif; text-align:center;">
	<h1 style="color:#FF00FF;"><b>Alice Charity Management System</b></h1>
		<nav class="navbar navbar-inverse" style="background-color:#FF00FF; border:none; display:inline-block; float:none;" role="navigation">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" style="color:white;" data-toggle="dropdown"><b>Projects</b><span class="caret"></span></a>
						<ul class="dropdown-menu" style="background-color:#FF00FF;">
							<li><a style="color:white;" target="popup" onclick="window.open('addProject.php','popup','width=400,height=475'); return false;">Add Project</a></li>
							<li><a target="popup" onclick="window.open('editProject.php','popup','width=400,height=475'); return false;" style="color:white;">Edit Project</a></li>
							<li><a target="popup" onclick="window.open('deleteProject.php','popup','width=400,height=475'); return false;" style="color:white;">Delete Project</a></li>
							<?php
							/* $projectsql = "SELECT Project_Name from project";
							$query=mysqli_query($conn, $projectsql);
							while($project=mysqli_fetch_array($query)) {
								echo "<li><a href='#' style='color:white;'>{$project['Project_Name']}</a></li>";
							} */
							?>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" style="color:white;" data-toggle="dropdown"><b>Events</b><span class="caret"></span></a>
						<ul class="dropdown-menu" style="background-color:#FF00FF;">
							<?php
								if(mysqli_connect_errno($conn)) {
									echo "<script type='text/javascript'>
									alert('Unable to connect to database server.');
									</script>";
								} else {
									$sql = "SELECT event_type_ID, event_type from event_type";
									$query = mysqli_query($conn, $sql);
									while($event = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
										echo "<li><a style='color:white;' href='Events.php?id=".$event['event_type_ID']."' value='{$event['event_type']}'>{$event['event_type']}</a></li>";
									}
								}
							?>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="logout.php" class="navbar-font-color" style="margin-left:25px; margin-right:10px;"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<!-- Table Filtering Box -->
	<div class="col-md-12" style="font-family:Verdana, Geneva, sans-serif; text-align:center; margin:0 auto;">
		<h4 style="color:#FF00FF;"><b>Use the text box below to filter an item or name of your choice:</b></h4>
		<div class="input-group" style="width:25%; margin:0 auto; margin-bottom:10px; border:solid; border-color:#FF00FF;">
			<span class="input-group-addon" style="color:#FF00BF;">Filter</span>
			<input id="filter" type="text" class="form-control" placeholder="Type here...">
		</div>
	<!-- Insert New Entry Button -->
		<div class="container-fluid" style="margin-bottom:10px;">
			<button type="button" class="btn btn-primary" style="background-color:#FF00FF; border-color:#FF00BF;" target="popup" onclick="window.open('addItem.php','popup','width=400,height=475'); return false;"><b>Insert New Item</b></button>
			<button type="button" class="btn btn-primary" id="refresh" style="background-color:#FF00FF; border-color:#FF00BF;">Refresh Database</button>
		</div>
		<table class="table table-bordered" id="myTable" style="width:80%; margin:0 auto;">
			<thead>
			<tr>
				<th>Stock Name</th>
				<th>Stock Category</th>
				<th>Stock Description</th>
				<th>Project Name</th>
				<th>Donator Name</th>
				<th>Recipient Name</th>
				<th colspan="2">Modify Table</th>
			</tr>
			</thead>
			<tbody class="searchable">
				<?php
				// Grabs data from DB to be displayed in table.
					$sql="SELECT stock.stock_ID, stock.stock_name, stock.stock_category, stock.stock_description, project.Project_Name, stock.donator_name, stock.donation_allocation FROM stock INNER JOIN project ON stock.project_ID=project.project_ID";
					$result=mysqli_query($conn, $sql);
					if (!$result) {
						echo (mysqli_error($conn));
						die;
					} else {
						while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							echo '<tr>';
							echo '<td>'.$row['stock_name'].'</td>';
							echo '<td>'.$row['stock_category'].'</td>';
							echo '<td class="small">'.$row['stock_description'].'</td>';
							echo '<td>'.$row['Project_Name'].'</td>';
							if ($_SESSION["level"] == '2') {
								echo '<td>'.$row['donator_name'].'</td>';
							} else {
								echo '<td>-</td>';
							}
							if ($_SESSION["level"] == "2") {
								echo '<td>'.$row['donation_allocation'].'</td>';
							} else {
								echo '<td>-</td>';
							}
							echo "<td>";
							?>
							<button type="button" class="btn btn-primary btn-sm" href="editItem.php?id=<?php echo $row['stock_ID']; ?>" target="popup" onclick="window.open('editItem.php?id=<?php echo $row['stock_ID']; ?>','popup','width=400,height=400'); return false;">Edit<br>Entry</button>
							<?php
							echo "</td>";
							echo "<td>";
							?>
							<button type="button" class="btn btn-primary btn-sm" href="
							deleteItem.php?id=<?php echo $row['stock_ID']; ?>" target="popup" onclick="window.open('deleteItem.php?id=<?php echo $row['stock_ID']; ?>','popup','width=400,height=400'); return false;">Delete<br>Entry</button>
							<?php
							echo "</td>";
							echo "</tr>";
						}
					}
					?>
			</tbody>
		</table>		
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
// Filtering System for table
$(document).ready(function () {
	(function ($) {
		$('#filter').keyup(function () {
		var rex = new RegExp($(this).val(), 'i');
		$('.searchable tr').hide();
		$('.searchable tr').filter(function () {
			return rex.test($(this).text());
		}).show();
	})
$("a.delete").click(function(e){
	if(!confirm('Are you sure you want to delete this record?')){
		e.preventDefault();
		return false;
	}
	return true;
});
}(jQuery));
});
</script>
</body>
</html>