<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Modify Business - Alice Charity Management System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure you want to delete this event?');
}
</script>
</head>
<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
// Add Business PHP
if (isset($_POST['addSubmit']) == true) {
	$newBusinessName=isset($_POST['businessName']) ? $_POST['businessName'] : '';
	$newBusinessContactName=isset($_POST['businessContactName']) ? $_POST['businessContactName'] : '';
	$newAddress1=isset($_POST['address1']) ? $_POST['address1'] : '';
	$newAddress2=isset($_POST['address2']) ? $_POST['address2'] : '';
	$newCity=isset($_POST['city']) ? $_POST['city'] : '';
		$citysql="SELECT city_ID, city_name FROM city WHERE city_name='$newCity';";
		$cityquery=mysqli_query($conn, $citysql);
		$cityrow=mysqli_fetch_array($cityquery, MYSQLI_ASSOC);
		$city_ID=$cityrow['city_ID'];
	$newCounty=isset($_POST['county']) ? $_POST['county'] : '';
		$countysql="SELECT county_ID, county_name FROM county WHERE county_name='$newCounty';";
		$countyquery=mysqli_query($conn, $countysql);
		$countyrow=mysqli_fetch_array($countyquery, MYSQLI_ASSOC);
		$county_ID=$countyrow['county_ID'];	
	$newPostcode=isset($_POST['postcode']) ? $_POST['postcode'] : '';
	$newPhoneNumber=isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '';
	$newCoop=isset($_POST['coop']) ? $_POST['coop'] : '';
	$newVolunteer=isset($_POST['volunteer']) ? $_POST['volunteer'] : '';
	$addsql="INSERT INTO business (business_name, business_contact_name, address_1, address_2, city_ID, county_ID, postcode, contact_phone_number, cooperative, volunteer) VALUES ('$newBusinessName', '$newBusinessContactName', '$newAddress1', '$newAddress2', '$city_ID', '$county_ID', '$newPostcode', '$newPhoneNumber', '$newCoop', '$newVolunteer');";
	$addquery=mysqli_query($conn, $addsql);
	if($addquery) {
		echo "<script type='text/javascript'>
		alert('Business added successfully!');
		window.close();
		</script>";		
	} else {
		echo "<script type='text/javascript'>
		alert('Business not added.');
		window.close();
		</script>";
		echo ("Error description: " . mysqli_error($conn));		
	}		
}
?>
<body>
<div class="container-fluid">
<h1>Modify Businesses</h1>
<h4>Add, edit or delete businesses using the options below.</h4>
	<div class="panel-group" id="accordian">
	<!-- Add Business accordian -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#addBusiness">
					<b>Add Business</b></a>
				</h4>
			</div>
			<div id="addBusiness" class="panel-collapse collapse">
				<div class="panel-body">
					<form role="form" method="post" action="">
						<div class="form-group">
							<label for="businessName">Business Name:</label>
							<input type="text" class="form-control" name="businessName" id="businessName" placeholder="Enter business name" required="required">
						</div>
						<div class="form-group">
							<label for="businessContactName">Business Contact Name:</label>
							<input type="text" class="form-control" name="businessContactName" id="businessContactName" placeholder="Enter business contact name" required="required">
						</div>
						<div class="form-group">
							<label for="address1">Address 1:</label>
							<input type="text" class="form-control" name="address1" id="address1" placeholder="Enter first line of address" required="required">
						</div>
						<div class="form-group">
							<label for="address1">Address 2:</label>
							<input type="text" class="form-control" name="address2" id="address2" placeholder="Enter second line of address (optional)">
						</div>
						<div class="form-group">
							<label for="city">City:</label>
							<select class="form-control" name="city" id="city">
								<option value="default" disabled selected>Select a City...</option>
								<?php
									$cityselectsql="SELECT city_name FROM city ORDER BY city_name ASC;";
									$cityselectquery=mysqli_query($conn, $cityselectsql);
									while($cityselect=mysqli_fetch_array($cityselectquery, MYSQLI_ASSOC)) {
										echo "<option value='{$cityselect['city_name']}'>{$cityselect['city_name']}</option>";
									}
								?>									
							</select>
						</div>
						<div class="form-group">
							<label for="county">County:</label>
							<select class="form-control" name="county" id="county">
							<option value="default" disabled selected>Select a County...</option>
								<?php
									$countyselectsql="SELECT county_name FROM county ORDER BY county_name ASC;";
									$countyselectquery=mysqli_query($conn, $countyselectsql);
									while($countyselect=mysqli_fetch_array($countyselectquery, MYSQLI_ASSOC)) {
										echo "<option value='{$countyselect['county_name']}'>{$countyselect['county_name']}</option>";
									}
								?>							
							</select>
						</div>
						<div class="form-group">
							<label for="postcode">Postcode:</label>
							<input type="text" class="form-control" name="postcode" id="postcode" placeholder="Enter business' postcode" required="required">
						</div>
						<div class="form-group">
							<label for="phoneNumber">Contact Phone Number:</label>
							<input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Enter contact's phone number" required="required">
						</div>
						<div class="form-group">
							<label for="coop">Is the business helping with an event?</label>
							<div class="radio" id="coop">
								<label><input type="radio" name="coop" value="Yes">Yes</label>
							</div>
							<div class="radio" id="coop">
								<label><input type="radio" name="coop" value="No">No</label>
							</div>
						</div>
						<div class="form-group">
							<label for="volunteer">Are they volunteering or a paid service?</label>
							<div class="radio" id="volunteer">
								<label><input type="radio" name="volunteer" value="Y">Volunteer</label>
							</div>
							<div class="radio" id="volunteer">
								<label><input type="radio" name="volunteer" value="N">Paid service</label>
							</div>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="addSubmit" value="Add Business">
						</div>
					</form>
				</div>
			</div>
		</div>
	<!-- Edit Business accordian -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#editBusiness">
					<b>Edit Business</b></a>
				</h4>
			</div>
			<div id="editBusiness" class="panel-collapse collapse">
				<div class="panel-body">
					<form role="form" method="post" action="editBusiness.php">
						<div class="form-group">
							<label for="businessSelect">Select Business to Edit:</label>
							<select class="form-control" name="businessSelect" id="businessSelect">
								<option value="default" disabled selected>Select a Business...</option>
								<?php
									$selectsql="SELECT * FROM business";
									$selectquery=mysqli_query($conn, $selectsql);
									while($rowselect=mysqli_fetch_array($selectquery, MYSQLI_ASSOC)) {
										echo "<option value='{$rowselect['business_name']}'>{$rowselect['business_name']}</option>";
									}						
								?>
							</select>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="editSelectSubmit" value="Edit this Business">
						</div>													
					</form>
				</div>
			</div>			
		</div>
	<!-- Delete Business accordian -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#deleteBusiness">
					<b>Delete Business</b></a>
				</h4>
			</div>
			<div id="deleteBusiness" class="panel-collapse collapse">
				<div class="panel-body">
					<form role="form" method="post" action="deleteBusiness.php">
						<div class="form-group">
							<label for="deleteBusiness">Select Business:</label>
							<select class="form-control" name="deleteBusiness" id="deleteBusiness">
							<option value="default" disabled selected>Select a Business...</option>
							<?php
								$selectsql="SELECT * FROM business";
								$selectquery=mysqli_query($conn, $selectsql);
								while($rowselect=mysqli_fetch_array($selectquery, MYSQLI_ASSOC)) {
									echo "<option value='{$rowselect['business_name']}'>{$rowselect['business_name']}</option>";
								}						
							?>								
							</select>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#D9534F; border-color:red;" onClick="return checkDelete()" name="submit" value="Delete Business">
						</div>						
					</form>
				</div>
			</div>
		</div>
	</div>		
</div>
</body>
</html>