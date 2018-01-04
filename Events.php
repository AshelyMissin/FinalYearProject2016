<?php
session_start();
if(isset($_SESSION['level']) == false)
{	header("Location: Login.php");
	//phpinfo();
}
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
if(isset($_GET['id'])) {
	$event_id=$_GET['id'];
	$eventsql=
	"SELECT *
	FROM event_type
	INNER JOIN employee ON event_type.employee_ID=employee.employee_ID
	WHERE event_type_ID='$event_id'
	;";
	$eventquery=mysqli_query($conn, $eventsql);
	$event_type=mysqli_fetch_array($eventquery, MYSQLI_ASSOC);
	$event=$event_type['event_type'];
	$eventManager=$event_type['employee_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $event; ?> - Management System</title>
<link rel="icon" type="image/gif" href="animated_favicon1.gif">
<!-- Links to Bootstrap stylesheets -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
	html, body {
		background: url(Alice_Background.png) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		o-background-size: cover;
		background-size: contain;
		height:100%;
	}
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
	.green {
		background-color:#5CB85C;
	}
	.red {
		background-color:#D9534F;
	}
</style>
<script>
function checkDelete(){
    return confirm('Are you sure you want to delete this event?');
}
</script>
</head>
<body>
<div class="row">
	<div class="container" style="font-family:Verdana, Geneva, sans-serif; text-align:center;">
	<h1 style="color:#FF00FF;"><b>Alice Charity Management System</b></h1>
		<nav class="navbar navbar-inverse" style="background-color:#FF00FF; border:none; display:inline-block; float:none;" role="navigation">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="StockInventory.php" class="navbar-font-color"><b>Stock Inventory</b></a></li>
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
									while($eventnav = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
										echo "<li><a style='color:white;' href='Events.php?id=".$eventnav['event_type_ID']."' value='{$eventnav['event_type']}'>{$eventnav['event_type']}</a></li>";
									}
								}
							?>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="Logout.php" class="navbar-font-color" style="margin-left:25px; margin-right:10px;"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="col-md-12" style="font-family:Verdana, Geneva, sans-serif; text-align:center; margin:0 auto;">
		<h3 style="color:#FF00FF; margin-top:-1px;"><b><u><?php echo $event; ?></u></b></h3>
		<h3 style="color:#FF00FF; margin-top:-1px;"><u>Managed by:</u> <button type="button" class="btn btn-primary btn-lg" style="background:transparent; border-color:#FF00FF; color:#FF00FF; cursor: default;"><u><b><?php echo $eventManager; ?></b></u></button></h3>
		</br>
		<h4 style="color:#FF00FF;"><b>Use the text box below to filter for the information required:</b></h4>
		<div class="input-group" style="width:25%; margin:0 auto; margin-bottom:10px; border:solid; border-color:#FF00FF;">
			<span class="input-group-addon" style="color:#FF00BF;">Filter</span>
			<input id="filter" type="text" class="form-control" placeholder="Type here...">
		</div>
	<!-- Insert New Entry Button -->
		<div class="container-fluid" style="margin-bottom:10px;">
			<li class="dropdown">
				<button class="btn btn-primary dropdown-toggle" style="background-color:#FF00FF; border-color:#FF00BF; color:white;" data-toggle="dropdown"><b>Modify:      </b><span class="caret"></span></button>
				<ul class="dropdown-menu" style="background-color:#FF00FF;">
					<li><a style="color:white;" target="popup" onclick="window.open('modifyBusiness.php','popup','width=400,height=475'); return false;">Businesses</a></li>
					<li><a style="color:white;" target="popup" onclick="window.open('modifyEvent.php','popup','width=400,height=475'); return false;">Events</a></li>
				</ul>
			</li>
			<button type="button" class="btn btn-primary" style="background-color:#FF00FF; border-color:#FF00BF; color:white;" target="popup" onclick="window.open('assignBusiness.php?id=<?php echo $event_id; ?>','popup','width=400,height=475'); return false;"><b><u>Assign a Business</b></u></button>
		</div>
		<table class="table table-bordered" style="width:70%; margin:0 auto;">
			<thead>
			<tr>
				<th>Business Name</th>
				<th>Business Contact Name</th>
				<th>Business Contact Number</th>
				<th colspan="3">Modify Table</th>
			</tr>
			</thead>
			<tbody class="searchable">
				<?php
				 // Grabs data from DB to be displayed in table.
				 // CHANGE TO EVENT TABLE
					$sql="
					SELECT * 
					FROM event
					INNER JOIN business ON event.business_ID=business.business_ID					
					INNER JOIN event_type ON event.event_type_ID=event_type.event_type_ID
					WHERE event.event_type_ID='$event_id'
					ORDER BY business_name ASC
					;";
					$result=mysqli_query($conn, $sql);
					if (!$result) {
						echo (mysqli_error($conn));
						die;
					} else {
						while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							// Sets current cooperative value for each row.
							$coopsql="SELECT cooperative FROM business WHERE business_ID='".$row['business_ID']."';";
							$coopquery=mysqli_query($conn, $coopsql);
							$coopresult=mysqli_fetch_assoc($coopquery);
							$current_coop=$coopresult['cooperative'];					
							// Changes colour of table row based on cooperative value, remains orginal colour if no value was set when record was created.
							if ($current_coop == 'Yes') {
								$friend="background-color:#5CB85C;";
							} else if ($current_coop == 'No') {
								$friend="background-color:#D9534F;";
							} else {
								$friend="background-color:#FF00FF;";
							}
							echo '<tr style="'.$friend.'">';
							echo '<td>'.$row['business_name'].'</td>';
							echo '<td>'.$row['business_contact_name'].'</td>';
							echo '<td>'.$row['contact_phone_number'].'</td>';
							echo '<td>';
							?>
							<button type="button" class="btn btn-primary btn-sm" style="color:white;" href="editAssign.php?id=<?php echo $row['event_ID']; ?>" target="popup" onclick="window.open('editAssign.php?id=<?php echo $row['event_ID']; ?>','popup','width=400,height=400'); return false;"><b><u>Edit Entry</u></b></button>
							<?php
							echo '</td>';
							echo '<td>';
							?>
							<button type="button" class="btn btn-primary btn-sm" id="delete" style="color:white;" onclick="window.location.href='deleteAssign.php?id=<?php echo $row['event_ID']; ?>'"><b><u>Delete Entry</u></b></button>
							<?php
							echo '</td>';
							echo '<td>';
							?>
							<button type="button" class="btn btn-primary btn-sm" style="color:white;" href="assignCoop.php?id=<?php echo $row['business_ID']; ?>" target="popup" onclick="window.open('assignCoop.php?id=<?php echo $row['business_ID']; ?>','popup','width=400,height=150'); return false;"><b><u>Friend?</u></b></button>
							<?php
							echo '</td>';
							/* echo '<td>
									<form method="post" action="">
										<li class="dropdown">
											<button type="button" class="dropdown toggle btn btn-primary btn-sm" data-toggle="dropdown"><b><u>Friend?          </u></b><span class="caret"></span></button>
											<ul class="dropdown-menu" style="background-color:#FF00FF; color:white; text-align:center;">
												<li>Currently:<b>'.$current_coop.'';
												echo '</b></li>
												<li>
													<div class="radio">
														<label><input type="radio" name="co-op" onclick="javascript: submit()" value="Yes">Yes</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="co-op" onclick="javascript: submit()" value="No">No</label>
													</div>
												</li>
											</ul>
										</li>
									</form>
								</td>';	*/			
							echo '</tr>';
						}
					}				
					?>
			</tbody>
		</table>
	</div>	
</div>
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
	}(jQuery));
	
	$('#delete').click(function(){
		return confirm("Are You sure you want to delete this record?");
	 });	
});
</script>
</body>
</html>