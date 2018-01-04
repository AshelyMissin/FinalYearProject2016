<?php
$conn = mysqli_connect("127.0.0.1","root","","m026446e");
$selectedBusiness=isset($_POST['businessSelect']) ? $_POST['businessSelect'] : '';
$selectsql="SELECT * FROM business WHERE business_name='$selectedBusiness';";
$selectquery=mysqli_query($conn, $selectsql);
$selectrow=mysqli_fetch_array($selectquery, MYSQLI_ASSOC);
$business_ID=$selectrow['business_ID'];
$newBusinessName=isset($_POST['editBusinessName']) ? $_POST['editBusinessName'] : '';
$newBusinessContactName=isset($_POST['editBusinessContactName']) ? $_POST['editBusinessContactName'] : '';
$newAddress1=isset($_POST['editAddress1']) ? $_POST['editAddress1'] : '';
$newAddress2=isset($_POST['editAddress2']) ? $_POST['editAddress2'] : '';
$newCity=isset($_POST['editCity']) ? $_POST['editCity'] : '';
	$citysql="SELECT city_ID, city_name FROM city WHERE city_name='$newCity';";
	$cityquery=mysqli_query($conn, $citysql);
	$cityrow=mysqli_fetch_array($cityquery, MYSQLI_ASSOC);
	$city_ID=$cityrow['city_ID'];		
$newCounty=isset($_POST['editCounty']) ? $_POST['editCounty'] : '';
	$countysql="SELECT county_ID, county_name FROM county WHERE county_name='$newCounty';";
	$countyquery=mysqli_query($conn, $countysql);
	$countyrow=mysqli_fetch_array($countyquery, MYSQLI_ASSOC);
	$county_ID=$countyrow['county_ID'];		
$newPostcode=isset($_POST['editPostcode']) ? $_POST['editPostcode'] : '';
$newPhoneNumber=isset($_POST['editPhoneNumber']) ? $_POST['editPhoneNumber'] : '';
$newCoop=isset($_POST['editCoop']) ? $_POST['editCoop'] : '';
$newVolunteer=isset($_POST['editVolunteer']) ? $_POST['editVolunteer'] : '';
$editsql="
UPDATE business
SET business_name='$newBusinessName',business_contact_name='$newBusinessContactName',address_1='$newAddress1',address_2='$newAddress2',city_ID='$city_ID',county_ID='$county_ID',postcode='$newPostcode',contact_phone_number='$newPhoneNumber',cooperative='$newCoop',volunteer='$newVolunteer'
WHERE business_ID='$business_ID'
;";
$editquery=mysqli_query($conn, $editsql);
if($editquery) {
	echo "<script type='text/javascript'>
	alert('Edit successful');
	window.close();
	</script>";
} else {
	echo "<script type='text/javascript'>
	alert('Edit unsuccessful');
	</script>";											
	echo("Error description: " . mysqli_error($conn));		
}	
?>