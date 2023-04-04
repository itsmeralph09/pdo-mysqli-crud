<?php
				require_once('dbconnect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PDO Crud</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./style.css">
	<script src="./script.js "></script>
</head>
<body>
	<div class="container">
		<h2 class="text-center">PDO Crud</h2>
		<a class="btn btn-success mb-3" href="./create.php" role="button">Add Student</a>
		<a class="btn btn-secondary mb-3" href="../index.php" role="button">DASHBOARD</a>
		<table class="table table-hover bg-light table-striped table-bordered">
			<thead>
				<tr class="text-left">
					<th>Student ID</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Extension Name</th>
					<th>Middle Name</th>
					<th>Email</th>
					<th>Phone Number</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
			// Read all data sa database
			$sql = "SELECT * FROM tbl_student";
			$result = $pdo->query($sql);

			// Fetch and display all data sa database
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				echo "
				<tr>
					<td>{$row['student_id']}</td>
					<td>{$row['last_name']}</td>
					<td>{$row['first_name']}</td>
					<td>{$row['extension_name']}</td>
					<td>{$row['middle_name']}</td>
					<td>{$row['email']}</td>
					<td>{$row['phone_number']}</td>
					<td>{$row['address']}</td>
					<td>
						<a class='btn btn-primary btn-sm' href='./update.php?student_id={$row['student_id']}'>Update</a>
						<a onclick='conf()' class='btn btn-danger btn-sm' href='./delete.php?student_id={$row['student_id']}'>Delete</a>
					</td>
				</tr>";
            }
            $pdo = null; // close na ang connectin sa database
            ?>
            

            </tbody>
        </thead>
    </table>

</div>

</body>
</html>