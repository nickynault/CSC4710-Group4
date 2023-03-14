<?php
// add_task.php

// Database connection
$servername = "localhost";
$username = "id20153491_testingthis";
$password = "i]8[EBlzQ[!4!u5s";
$database = "id20153491_test";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$task_desc = $_POST['task_desc'];
$due_date = $_POST['due_date'];
$task_category = $_POST['task_category'];
$priority = $_POST['priority'];
$status = isset($_POST['status']) ? 'active' : 'completed';

// SQL query to insert new task
$sql = "INSERT INTO tasks (task_desc, due_date, task_category, priority, task_status) VALUES ('$task_desc', '$due_date', '$task_category', $priority, '$status')";

if (mysqli_query($conn, $sql)) {
	// Redirect to home page
	header("Location: index.php");
	exit();
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
