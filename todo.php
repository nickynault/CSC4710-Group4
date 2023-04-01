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
  <title>Your To-Do Lists</title>
</head>

<body>
  <header>
	<h1>Your To-Do Lists</h1>
  </header>
  <nav>
	<ul>
		<li><a href= "index.php">Home</a></li>
		<li><a href= "about.html">About the Authors</a></li>
		<li><a href= "form.php">Submit Form</a></li>
		<li><a href= "todo.php">To-Do Lists</a></li>
	</ul>
  </nav>
  
  <div id="main">
      <table>
          <tr>
              <th>Description</th>
              <th>Due Date</th>
              <th>Category</th>
              <th>Priority Level</th>
              <th>Status</th>
          </tr>
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
            
            $fetch = "SELECT * FROM tasks";
			$data = mysqli_query($conn, $fetch) or die('Unable to obtain data: '. mysqli_connect_error());
            
			while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)){
				echo "<tr><form method='post'>";
				echo "<td><input type='text' name='task_desc' value='".$row["task_desc"]."'></td>";
				echo "<td><input type='text' name='due_date' value='".$row["due_date"]."'></td>";
				echo "<td><input type='text' name='task_category' value='".$row["task_category"]."'></td>";
				echo "<td><input type='text' name='priority' value='".$row["priority"]."'></td>";
				echo "<td><input type='text' name='status' value='".$row["task_status"]."'></td>";
				echo "<td><input type='submit' name='submit' value='Save'></td>";
				echo "<input type='hidden' name='id' value='".$row["id"]."'>";
				echo "</form></tr>";
			}
			
			if(isset($_POST['submit'])){
				$id = $_POST['id'];
				$task_desc = $_POST['task_desc'];
				$due_date = $_POST['due_date'];
				$task_category = $_POST['task_category'];
				$priority = $_POST['priority'];
				$task_status = $_POST['task_status'];
				
				$update = "UPDATE tasks SET task_desc='$task_desc', due_date='$due_date', task_category='$task_category', priority='$priority', task_status='$task_status' WHERE id='$id'";
				mysqli_query($conn, $update);
				header("Location: todo.php");
        exit();
			}
          ?>
      </table>
  </div>
  
</body>
</html