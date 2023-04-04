<?php
require_once('dbconnect.php');

		$last_name = "";
		$first_name = "";
		$extension_name = "";
		$middle_name ="";
		$email ="";
		$phone_number ="";
		$address ="";


	$errorMessage = "";
	$successMessage ="";

	if ($_SERVER ['REQUEST_METHOD'] == 'GET'){
		//get method: show the data of the client

		if ( !isset ($_GET["student_id"])){
			header ("location: ./index.php");
			exit;
		}

		$student_id = $_GET["student_id"];
		// read the row of the selected client from the db table

		$sql = "SELECT * FROM tbl_student WHERE student_id=$student_id";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();

		if (!$row){
			header ("location: ./index.php");
			exit;
		}

			$last_name= $row["last_name"];
			$first_name = $row["first_name"];
			$extension_name = $row["extension_name"];
			$middle_name = $row["middle_name"];
			$email = $row["email"];
			$phone_number = $row["phone_number"];
			$address = $row["address"];

	}
	else{

		// Post method: update the data of the client

			$student_id = $_POST["student-id"];
			$last_name = $_POST["last-name"];
			$first_name = $_POST["first-name"];
			$extension_name = $_POST["extension-name"];
			$middle_name = $_POST["middle-name"];
			$email = $_POST["email"];
			$phone_number = $_POST["phone-number"];
			$address = $_POST["address"];


		do{
			if ( empty($student_id) || empty($last_name) || empty($first_name) || empty($email) || empty($phone_number) || empty($address)){

				$errorMessage = "All the fields are required";
				break;
			}

			$sql = "UPDATE tbl_student ". "SET last_name='$last_name', first_name='$first_name', extension_name='$extension_name', middle_name='$middle_name', email='$email', phone_number='$phone_number', address='$address'". "WHERE student_id = $student_id";
			$result = $connection->query($sql);

			if (!$result){
				$errorMessage = "Invalid Query: ".$connection->error;
				break;
			}

			$successMessage = "Student updated successfully";
			// close na ang db connection
			$connection->close();

			header("location: ./index.php");
			exit;
		}
		while (true);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<meta name ="viewport" content ="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href = "./css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./style.css">
	<title>Edit Student</title>
</head>
<body>
	<div class = "container my-5">
		<h2>Edit Student</h2>

		<?php
		if (!empty($errorMessage)){
			echo"

			<div class = 'alert alert-warning alert-dismissible fade show' role='alert'>
			<strong>$errorMessage</strong>
			<button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label='Close'</button>
			</div>
			";	
		}

		?>

		<form method = "post">
			<input type="hidden" name="student-id" value="<?php echo $student_id; ?>">
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Last Name</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "last-name" value= "<?php echo $last_name; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>First Name</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "first-name" value= "<?php echo $first_name; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Extension Name</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "extension-name" value= "<?php echo $extension_name; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Middle Name</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "middle-name" value= "<?php echo $middle_name; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Email</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "email" value= "<?php echo $email; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Phone Number</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "phone-number" value= "<?php echo $phone_number; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Address</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "address" value= "<?php echo $address; ?>">
				</div>
			</div>


			<?php

			if (!empty($successMessage)){
				echo"
				<div class = 'row mb-3'>
					<div class ='offset-sm-3 col-sm-6'>
						<div class='alert alert-success alert-dismissable fade show' role='alert'>
					<strong>$successMessage</strong>
					<button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label</button>
						</div>
					</div>
				</div>

				";
			}
			?>

			<div class = "row mb-3">
				<div class="offset-sm-3 d-grid">
					<button type ="submit" class ="btn btn-primary">Submit</button>
				</div>
				<div class = "col-sm-3 d-grid">
					<a class="btn btn-outline-secondary" href ="./index.php" role="button">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>