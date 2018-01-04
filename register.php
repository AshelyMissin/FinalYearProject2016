<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<style>
/* Customisation of bootstrap's navbar colour palette */
	body {
		background-image: url("Alice_Background.png")!important;
		background-size:contain;
		background-position:center;
		background-repeat:no-repeat;
	}
	.col-md-12 {
		width:50%;
		position: absolute;
		top:40%;
		left:50%;
		transform: translate(-50%,-50%);
	}
	.navbar-font-color {
		color:white!important;
	}
	a:hover {
		background-color:black!important;
	}
	a:active {
		background-color:#FF00BF!important;
	}
	.dropdown {
		display:inline-block!important;
	}
	.table {
		background-color:#FF00BF!important;
		border-color:none!important;
		vertical-align:top!important;
	}
	.table th, td {
		color:white!important;
		border-color:none!important;
		text-align:center!important;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<?php
// Variables declared
$conn = mysqli_connect("127.0.0.1", "root", "");
$db="m026446e";
$db_select = mysqli_select_db($conn, $db);
if (!$db_select) {
	die ('Cannot connect to database: ' . mysql_error());
}
?>
<body>
<div class="container">
	<div class="col-md-12">
		<h1 style="font-family:Verdana, Geneva, sans-serif; color:#FF00BF; text-align:center;"><b>Alice Charity Database Management System<br>Registration Page<br><br><br></b></h1>
		<h3 style="font-family:Verdana, Geneva, sans-serif; color:#FF00BF;"><b>Register using the form below:</b></h3>
		<form role="form" action="register.php" method="POST">
		<!-- E-mail text box -->
			<div class="form-group">
				<label for="email" style="color:#FF00BF;">E-mail Address/Username:</label>
				<input type="text" class="form-control" placeholder="Please enter your E-mail Address or Username..." name="email" id="email" style="border:solid;" required>
			</div>
		<!-- Password text box -->
			<div class="form-group">
				<label for="pwd" style="color:#FF00BF;">Password:</label>
				<input type="password" class="form-control" placeholder="Please enter your password..." name="password" id="pwd" style="border:solid; " required><br>
			</div>
		<!-- Level of access radio buttons -->
			<label for="optradio" style="color:#FF00BF;">Level of access (1 = Volunteer, 2 = Employee):</label>
			<label class="radio-inline" style="color:#FF00BF; text-decoration:underline;"><input type="radio" name="level" value="1"><b>1</b></label>
			<label class="radio-inline" style="color:#FF00BF; text-decoration:underline;"><input type="radio" name="level" value = "2"><b>2</b></label><br><br>
			<button type="submit" class="btn btn-default" name="submit" style="color:white; background-color:#FF00BF;">Register</button>
				<?php
				if ($result = mysqli_query($conn, "SELECT DATABASE()")) {
					$row = mysqli_fetch_row($result);
					printf("Default database is %s.\n", $row[0]);
					mysqli_free_result($result);
					}
					if (isset($_POST['submit']) == true) {
						session_start();
						// Grabs entered parameters
							$email=($_POST['email']);
							$password=($_POST['password']);
							$level=($_POST['level']);
						
						// SQL Injection protection
						$email = stripslashes($email);
						$email = mysqli_real_escape_string($conn, $email);
						$password = stripslashes($password);
						$password = mysqli_real_escape_string($conn, $password);
						
						//Password Hasing
						$hashed_password=password_hash($password, PASSWORD_BCRYPT);
						
						// Stores login details
						$registersql = "INSERT INTO users ". "(email, hashed_password, level) VALUES ('$email','$hashed_password','$level');";
						if (mysqli_query($conn, $registersql)) {
							echo "<script type='text/javascript'>
								alert('New record created successfully! Sending you to the login screen...');
							</script>";
							header('Refresh: 0;url=Login.php');
						} else {
							echo "Error: " . $registersql . "<br>" . mysqli_error($conn);
						}
					}
				?>
		</form>
	</div>
</div>
</body>
</html>