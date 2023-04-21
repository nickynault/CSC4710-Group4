<?php	
// Database connection
	$servername = "localhost";
	$username = "id20153491_testingthis";
	$password = "l5ak3jKJ_44hJh]9";
	$database = "id20153491_test";

	$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
	$sql = "SELECT * FROM categories";
	$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="site.css">
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
  </script>
  <![endif]-->
  <title>Create a Task or Category</title>
</head>

<body>
  <header>
	<h1>Create a Task or Category</h1>
  </header>

  <nav>
	<ul>
	  <li><a href= "index.php">Home</a></li>
      <li><a href= "about.html">About the Authors</a></li>
      <li><a href= "form.php">Create a Task or Category</a></li>
      <li><a href= "todo.php">Edit Tasks and Categories</a></li>
      <li><a href= "listview.php">See List Views</a></li>
	</ul>
  </nav>
  
  <div id="main">
 
<form id="myForm" style="display:block" action="add_task.php" method="post">
  <label for="task_desc">Task Description*:</label>
  <input type="text" id="task_desc" name="task_desc"><br><br>
  <label for="due_date">Due Date*:</label>
  <input type="date" id="due_date" name="due_date"><br><br>
  <label for="category_name">Task Category:</label>
  <select id="category_name" name="category_name">
    <?php
    // Loop through each category retrieved from database
    while ($row = mysqli_fetch_assoc($result)) { 
      // Echo option tag with category ID as value and category name as text
      echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>"; 
    }
    ?>
  </select><br><br>
  <label for="task_priority">Priority Level:</label>
  <input type="number" id="task_priority" name="task_priority" min="1" max="4"><br><br>
  <label for="task_status">Status:</label>
  <input type="checkbox" id="task_status" name="task_status" value="true"><br><br>
  <input type="submit" value="Create Task">     
</form>

<br />

<form id="myForm2" style="display:block" action="add_category.php" method="post">
	<label for="category_name">Category Name:</label>
	<input type="text" id="category_name" name="category_name"><br><br>
	<input type="submit" value="Create Category">
</form>

 
</body>
