<?php
require_once('dbconnect.php');

if (isset($_GET["student_id"])){

	$student_id =$_GET["student_id"];

	$sql = "DELETE FROM tbl_student WHERE student_id=$student_id";
	$connection->query($sql);

}

// close na ang db connection
$connection->close();


header("location: ./index.php");
exit;

?>