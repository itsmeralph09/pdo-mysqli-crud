<?php
require_once('dbconnect.php');


if (isset($_GET["student_id"])){

	$student_id =$_GET["student_id"];

	$sql = "DELETE FROM tbl_student WHERE student_id=?";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(1, $student_id);
	$stmt->execute();

}

$pdo = null; // close na ang connection sa database

header("location: ./index.php");
exit;


?>