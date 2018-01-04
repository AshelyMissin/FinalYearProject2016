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
<title>Edit Business - Alice Charity Management System</title>
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
</head>
<body>
<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
$selectedBusiness=isset($_POST['businessSelect']) ? $_POST['businessSelect'] : '';
$currentsql="
SELECT business.business_ID, business.business_name, business.business_contact_name, business.address_1, business.address_2, city.city_name, county.county_name, business.postcode, business.contact_phone_number, business.cooperative, business.volunteer
FROM business
INNER JOIN city ON business.city_ID=city.city_ID
INNER JOIN county ON business.county_ID=county.county_ID
WHERE business.business_name='$selectedBusiness'
;";
$currentquery=mysqli_query($conn, $currentsql);
$currentrow=mysqli_fetch_array($currentquery, MYSQLI_ASSOC);
$business_ID=$currentrow['business_ID'];
$currentBusinessName=$currentrow['business_name'];
$currentBusinessContactName=$currentrow['business_contact_name'];
$currentAddress1=$currentrow['address_1'];
$currentAddress2=$currentrow['address_2'];
$currentCity=$currentrow['city_name'];
$currentCounty=$currentrow['county_name'];
$currentPostcode=$currentrow['postcode'];
$currentPhoneNumber=$currentrow['contact_phone_number'];
$currentCoop=$currentrow['cooperative'];
$currentVolunteer=$currentrow['volunteer'];		
?>
<div class="container-fluid">
<h1>Edit Business</h1>
	<form name="" method="post" action="editBusiness2.php">		
		<div class="panel-group" id="accordian">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordian" href="#editBusiness">
						<b>Edit Business</b></a>
					</h4>
				</div>
				<div id="editBusiness" class="panel-collapse collapse in">
					<div class="panel-body">
						<div class="form-group">
							<input type="text" class="form-control hidden" name="businessSelect" placeholder="Enter business name" value="<?php echo $selectedBusiness; ?>" required="required">
						</div>					
						<div class="form-group">
							<label for="editBusinessName">Business Name:</label>
							<input type="text" class="form-control" name="editBusinessName" id="editBusinessName" placeholder="Enter business name" value="<?php echo $currentBusinessName; ?>" required="required">
						</div>
						<div class="form-group">
							<label for="editBusinessContactName">Business Contact Name:</label>
							<input type="text" class="form-control" name="editBusinessContactName" id="editBusinessContactName" placeholder="Enter business contact name" value="<?php echo $currentBusinessContactName; ?>"required="required">
						</div>
						<div class="form-group">
							<label for="editAddress1">Address 1:</label>
							<input type="text" class="form-control" name="editAddress1" id="editAddress1" placeholder="Enter first line of address" value="<?php echo $currentAddress1; ?>" required="required">
						</div>
						<div class="form-group">
							<label for="editAddress1">Address 2:</label>
							<input type="text" class="form-control" name="editAddress2" id="editAddress2" placeholder="Enter second line of address (optional)"  value="<?php echo $currentAddress2; ?>">
						</div>
						<div class="form-group">
							<label for="editCity">City:</label>
							<select class="form-control" name="editCity" id="editCity">
								<?php
									$citysql="SELECT city_name FROM city ORDER BY city_name ASC;";
									$cityquery=mysqli_query($conn, $citysql);
									while($cityselect=mysqli_fetch_array($cityquery, MYSQLI_ASSOC)) {
										echo "<option value='{$cityselect['city_name']}' " . ($cityselect['city_name']==$currentCity ? 'selected' : '') . ">{$cityselect['city_name']}</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="editCounty">County:</label>
							<select class="form-control" name="editCounty" id="editCounty">
								<?php
									$countysql="SELECT county_name FROM county;";
									$countyquery=mysqli_query($conn, $countysql);
									while($countyselect=mysqli_fetch_array($countyquery, MYSQLI_ASSOC)) {
										echo "<option value='{$countyselect['county_name']}' " . ($countyselect['city_name']==$currentCounty ? 'selected' : '') . ">{$countyselect['county_name']}</option>";
									}
								?>								
							</select>
						</div>
						<div class="form-group">
							<label for="editPostcode">Postcode:</label>
							<input type="text" class="form-control" name="editPostcode" id="editPostcode" placeholder="Enter business' postcode" value="<?php echo $currentPostcode; ?>"required="required">
						</div>
						<div class="form-group">
							<label for="editPhoneNumber">Contact Phone Number:</label>
							<input type="text" class="form-control" name="editPhoneNumber" id="editPhoneNumber" placeholder="Enter contact's phone number" value="<?php echo $currentPhoneNumber; ?>" required="required">
						</div>
						<div class="form-group">
							<label for="editCoop">Is the business helping with an event?</label>
							<div class="radio" id="editCoop">
								<label><input type="radio" name="editCoop" value="Yes" <?php if ($currentCoop == "Yes") { echo ' checked '; } else { echo ''; } ?>>Yes</label>
							</div>
							<div class="radio" id="editCoop">
								<label><input type="radio" name="editCoop" value="No" <?php if ($currentCoop == "No") { echo ' checked '; } else { echo ''; } ?>>No</label>
							</div>
						</div>
						<div class="form-group">
							<label for="editVolunteer">Are they volunteering or a paid service?</label>
							<div class="radio" id="editVolunteer">
								<label><input type="radio" name="editVolunteer" value="Y" <?php if ($currentVolunteer == "Y") { echo ' checked '; } else { echo ''; } ?>>Volunteer</label>
							</div>
							<div class="radio" id="volunteer">
								<label><input type="radio" name="editVolunteer" value="N" <?php if ($currentVolunteer == "N") { echo ' checked '; } else { echo ''; } ?>>Paid service</label>
							</div>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="btn btn-info" style="background-color:#FF00FF; border-color:#FF00BF;" name="submit" value="Edit Business">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php

?>
</div>
</body>
</html>