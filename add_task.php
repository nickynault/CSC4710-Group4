<?php
// add_task.php

// Database connection
$servername = "localhost";
$username = "id20153491_testingthis";
$password = "l5ak3jKJ_44hJh]9";
$database = "id20153491_test";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$id = uniqid();
$task_desc = $_POST['task_desc'];
$due_date = $_POST['due_date'];
$task_priority = $_POST['task_priority'];
$task_category_id = trim($_POST['category_name']);
$task_status = isset($_POST['task_status']) ? 1 : 0;

// SQL query to insert new task
$sql = "INSERT INTO tasks (id, task_desc, due_date, task_category_id, task_priority, task_status) VALUES ('$id', '$task_desc', '$due_date', '$task_category_id', '$task_priority', '$task_status')";

if (mysqli_query($conn, $sql)) {
	header('Refresh:0; url=form.php');
	echo '<script type="text/javascript">
            window.onload = function () { alert("Task created!"); } 
        </script>'; 
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
