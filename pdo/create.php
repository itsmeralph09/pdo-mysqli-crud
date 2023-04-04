<?php
require_once('dbconnect.php');

$last_name= "";
$first_name = "";
$extension_name = "";
$middle_name ="";
$email ="";
$phone_number ="";
$address ="";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $last_name = $_POST["last-name"];
    $first_name = $_POST["first-name"];
    $extension_name = $_POST["extension-name"];
    $middle_name = $_POST["middle-name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone-number"];
    $address = $_POST["address"];

    if (empty($last_name) || empty($first_name) || empty($email) || empty($phone_number) || empty($address)) {
        $errorMessage = "All fields are required";
    } else {
        try {
            $sql = "INSERT INTO tbl_student(last_name, first_name, extension_name, middle_name, email, phone_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
			$stmt->bindParam(1, $last_name);
			$stmt->bindParam(2, $first_name);
			$stmt->bindParam(3, $extension_name);
			$stmt->bindParam(4, $middle_name);
			$stmt->bindParam(5, $email);
			$stmt->bindParam(6, $phone_number);
			$stmt->bindParam(7, $address);
			$stmt->execute();

            $successMessage = "Data added correctly";
            header("Location: ./index.php");
            exit;
        } catch(PDOException $e) {
            $errorMessage = "Invalid query: " . $e->getMessage();
        }
    }
}
$pdo = null; // close na ang connection sa database
?>

<!DOCTYPE html> 
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Add Student</title>
</head>
<body>
    <div class="container my-5">
        <h2>New Student</h2>
        <?php if (!empty($errorMessage)) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form method="post">
					<div class="row mb-3">
						<label class="col-sm-3 col-form-label">Last Name</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="last-name" value="<?php echo $last_name; ?>">
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-form-label">First Name</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="first-name" value="<?php echo $first_name; ?>">
						</div>
					</div>
					<div class="row mb-3">
					<label class="col-sm-3 col-form-label">Extension Name</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="extension-name" value="<?php echo $extension_name; ?>">
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-sm-3 col-form-label">Middle Name</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="middle-name" value="<?php echo $middle_name; ?>">
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-sm-3 col-form-label">Email</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-sm-3 col-form-label">Phone Number</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="phone-number" value="<?php echo $phone_number; ?>">
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-sm-3 col-form-label">Address</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
						</div>
					</div>
		  			<?php

		  			if ( !empty($successMessage)) {
		  				
		  				echo "
		  			<div class='row mb-3'>
		  				<div class='offset-sm-3 col-sm-6'>
		  					<div class='alert alert-success alert-dismissible fade show' role='alert'>
								<strong>$successMessage</strong>
								<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
						
						</div>
				 	</div>
				</div>
		  				";
		  		}
		  		 ?>

		  			<div class="row mb-3">
		  				<div class="offset-sm-3 d-grid">
		  					<button type="submit" class="btn btn-primary">Submit</button>
		  				</div>
		  				<div class="col-sm-3 d-grid">
		  					<a class="btn btn-outline-secondary" href="./index.php" role="button">Cancel</a>

		  				</div>
		  			</div>
		  		</form>


		  </div>
	</body>
	</html>