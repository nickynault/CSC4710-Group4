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

// Check if category already exists
$sql_check = "SELECT * FROM categories WHERE category_name = '$category_name'";
$result_check = mysqli_query($conn, $sql_check);
if (mysqli_num_rows($result_check) > 0) {
    header('Refresh:0; url=form.php');
    echo '<script type="text/javascript">
            window.onload = function () { alert("Category already exists!"); }
        </script>'; 
} else {
    // SQL query to insert new category
    $sql_insert = "INSERT INTO categories (id, category_name) VALUES ('$id', '$category_name')";
    if (mysqli_query($conn, $sql_insert)) {
        header('Refresh:0; url=form.php');
        echo '<script type="text/javascript">
                window.onload = function () { alert("Category created!"); } 
            </script>'; 
    } else {
        echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>