<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/gif" href="animated_favicon1.gif" >
	<!-- Links to Bootstrap stylesheets -->
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
<body>
<div class="container">
	<div class="col-md-12">
		<h1 style="font-family:Verdana, Geneva, sans-serif; color:#FF00BF; text-align:center;"><b>Alice Charity Database Management System<br>Login Page<br><br><br></b></h1>
		<h3 style="font-family:Verdana, Geneva, sans-serif; color:#FF00BF;"><b>Log in using the boxes below:</b></h3>
		<!-- Login form -->
		<form role="form" action="Login.php" method="post">
			<!-- E-mail text box -->
			<div class="form-group">
				<label for="email" style="color:#FF00BF;">E-mail Address/Username:</label>
				<input type="text" class="form-control" name="email" id="email" style="border:solid;" required><br>
			</div>
			<!-- Password text box -->
			<div class="form-group">
				<label for="pwd" style="color:#FF00BF;">Password:</label>
				<input type="password" class="form-control" name="password" id="pwd" style="border:solid;" required><br>
			</div>
		<input type="submit" class="btn btn-default" style="color:white; background-color:#FF00BF;" name="submit">
		</form>
		
		<?php
function LogIn() {
		// Database Connection
		$conn = mysqli_connect("127.0.0.1","root","","m026446e");
		//Grabs entered data from form
		$email = $_POST["email"];
		$password = $_POST["password"];
		// SQL Injection protection
		$email = stripslashes($email);
		$password = stripslashes($password);
		$email = mysqli_real_escape_string($conn, $email);
		$password = mysqli_real_escape_string($conn, $password);

		$sql="SELECT * FROM users WHERE email='$email'";
		$result=mysqli_query($conn, $sql);
		// Counts to attempt to find matching rows
		$count=mysqli_num_rows($result);
		// If there is a match
	if($count==1) {
		$row = mysqli_fetch_array($result);
		if (password_verify($password, $row['hashed_password'])) {
			session_start();
			$_SESSION['level'] = $row['level'];
			header('Refresh: 0;url=StockInventory.php');
		} else {
		// If no matches found
			session_destroy();
			echo "<script type='text/javascript'>
				alert('Wrong email or password! Please try again!');
			</script>";
		}
	}
}
		// Code only triggers when submit is pressed.
		if(isset($_POST['submit']) == true) {
			LogIn();
		} else {
			die;
		}
		?>
	</div>
</div>
</body>
</html>