<?php
// add_category.php

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
$category_name = $_POST['category_name'];
$status = isset($_POST['status']) ? 'active' : 'completed';

// SQL query to insert new task
$sql = "INSERT INTO categories (id,categor_name) VALUES ('$id','$category_name')";

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