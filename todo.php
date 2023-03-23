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
            $username = "id20159110_test";
            $password = "{]Y6xy<mW8J&EIEg";
            $database = "id20159110_test1";

            $conn = mysqli_connect($servername, $username, $password, $database);
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
            
            $fetch = "SELECT * FROM tasks";
			$data = mysqli_query($conn, $fetch) or die('Unable to obtain data: '. mysqli_connect_error());
            
			//echo "<table>";
			//echo "<tr><th>Description</th><th>Due Date</th><th>Category</th><th>Priority</th><th>Status</th></tr>";
			while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)){
				echo "<tr><td>";
				echo $row["task_desc"];
				echo "</td><td>";
				echo $row["due_date"];
				echo "</td><td>";
				echo $row["task_category"];
				echo "</td><td>";
				echo $row["priority"];
				echo "</td><td>";
				echo $row["status"];
				echo "</td></tr>";
			}
          ?>
      </table>
  
  <footer>
  <p>Copyright © Group 4 with Wayne State University and their respective owners.</p>
  </footer>
</body>
