<?php
// add_category.php

// Database connection
$servername = "localhost";
$username = "id20153491_testingthis";
$password = "W%_y~N_A^vW*]s@0";
$database = "id20153491_test";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$category_name = $_POST['category_name'];
$status = isset($_POST['status']) ? 'active' : 'completed';

// SQL query to insert new task
$sql = "INSERT INTO categories () VALUES ('$category_name')";

if (mysqli_query($conn, $sql)) {
    header('Refresh:0; url=form.php');
	echo '<script type="text/javascript">
            window.onload = function () { alert("Category created!"); } 
        </script>'; 
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>