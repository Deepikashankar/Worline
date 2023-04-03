<?php 
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>STUDENT rEGISTRATION</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<?php 
	$error_message = "";$success_message = "";

	if(isset($_POST['btnsignup'])){
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$email = trim($_POST['email']);
		$gender = trim($_POST['gender']);
		$add1 = trim($_POST['add1']);
		$add2 = trim($_POST['add2']);
		$city = trim($_POST['city']);
		$state = trim($_POST['state']);
		$email = trim($_POST['email']);
		$pincode = trim($_POST['pincode']);
		$country = trim($_POST['country']);
		

		$isValid = true;

		if($fname == '' || $lname == '' || $email == '' || $add1 == '' || $add2 == ''|| $gender == '' || $city == '' || $state == '' || $pincode == '' || $country == ''){
			$isValid = false;
			$error_message = "Please fill all fields.";
		}

		if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  	$isValid = false;
		  	$error_message = "Invalid Email-ID.";
		}

		if($isValid){

			$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if($result->num_rows > 0){
				$isValid = false;
				$error_message = "Email-ID is already existed.";
			}
			
		}

		if($isValid){
			$insertSQL = "INSERT INTO users(fname,lname,email,add1,add2) values(?,?,?,?,?)";
			$stmt = $con->prepare($insertSQL);
			$stmt->bind_param("sssss",$fname,$lname,$email,$add1,$add2);
			$stmt->execute();
			$stmt->close();

			$success_message = "Account Registered successfully.";
		}
	}
	?>
</head>
<body>
	<div class='container'>
		<div class='row'>
			<div class='col-md-12'>
				<h2></h2>
			</div>

			<div class='col-md-6' >
					
				<form method='post' action=''>

					<h1>Register</h1>
					<?php 
	
					if(!empty($error_message)){
					?>
						<div class="alert alert-danger">
						  	<strong>Error!</strong> <?= $error_message ?>
						</div>

					<?php
					}
					?>
					<?php 
					if(!empty($success_message)){
					?>
						<div class="alert alert-success">
						  	<strong>Success!</strong> <?= $success_message ?>
						</div>

					<?php
					}
					?>

		
	
				
					<div class="form-group">
					    <label for="fname">First Name:</label>
					    <input type="text" class="form-control" name="fname" id="fname" required="required" maxlength="80">
					</div>
					<div class="form-group">
					    <label for="lname">Last Name:</label>
					    <input type="text" class="form-control" name="lname" id="lname" required="required" maxlength="80">
					</div>
					<div class="form-group">
					    <label for="email">Email address:</label>
					    <input type="email" class="form-control" name="email" id="email" required="required" maxlength="80">
					</div>
					<div class="form-group">
					    <label for="gender">Gender:</label>
					    <input type="text" class="form-control" name="gender" id="gender" required="required" maxlength="80">
					</div>
					<div class="form-group">
					    <label for="add1">Address Line 1</label>
					    <input type="text" class="form-control" name="add1" id="add1" required="required" maxlength="80">
					</div>
                    <div class="form-group">
					    <label for="add2">Address Line 2</label>
					    <input type="text" class="form-control" name="add2" id="add2" required="required" maxlength="80">
					</div>
                    <div class="form-group">
					    <label for="city">City</label>
					    <input type="text" class="form-control" name="city" id="city" required="required" maxlength="80">
					</div>
					<div class="form-group">
					    <label for="state">State Provison</label>
					    <input type="text" class="form-control" name="state" id="state" required="required" maxlength="80">
					</div>
					<div class="form-group">
					    <label for="pincode">Postal Code</label>
					    <input type="text" class="form-control" name="pincode" id="pincode" required="required" maxlength="80">
					</div>
					<div class="form-group">
					    <label for="country">Country</label>
					    <input type="text" class="form-control" name="country" id="country" required="required" maxlength="80">
					</div>
					<button type="submit" name="btnsignup" class="btn btn-default">Submit</button>
				</form>
			</div>
			
			
		</div>
	</div>
</body>
</html>