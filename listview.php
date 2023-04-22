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

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $task_desc = $_POST['task_desc'];
    $due_date = $_POST['due_date'];
    $task_category_id = $_POST['task_category_id'];
    $task_priority = $_POST['task_priority'];
    $task_status = isset($_POST['task_status']) ? $_POST['task_status'] : 0;
				
    $update = "UPDATE tasks SET task_desc='$task_desc', due_date='$due_date', task_category_id='$task_category_id', task_priority='$task_priority', task_status='$task_status' WHERE id='$id'";
    mysqli_query($conn, $update);
    header("Location: todo2.php");
    exit();
}

if(isset($_POST['submit2'])){
  $id = $_POST['id'];
  $category_name = $_POST['category_name'];     
  $update2 = "UPDATE categories SET category_name='$category_name' WHERE id='$id'";
  mysqli_query($conn, $update2);
  header("Location: todo2.php");
  exit();
}

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
  <title>See List Views</title>
</head>

<body>
  <header>
    <h1>See List Views</h1>
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
      <!--Table/List Views-->
      <h1>Default List View</h1>
      <table style='border-collapse: collapse; width: 100%;'>
      <thead style='text-align: center; background-color: #ddd;'>
      <tr>
        <th style='border: 1px solid black; padding: 5px;'>Task Description</th>
        <th style='border: 1px solid black; padding: 5px;'>Due Date</th>
        <th style='border: 1px solid black; padding: 5px;'>Task Category</th>
        <th style='border: 1px solid black; padding: 5px;'>Priority</th>
        <th style='border: 1px solid black; padding: 5px;'>Status</th>
      </tr>
      </thead>
      <tbody>
        <?php
        //Default List View
        $fetch = "SELECT * FROM tasks WHERE due_date <= CURDATE() OR due_date = CURDATE() ORDER BY task_priority ASC";
        $data = mysqli_query($conn, $fetch) or die('Unable to obtain data: '. mysqli_error($conn));

        while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td style='border: 1px solid black; padding: 5px;'>".$row["task_desc"]."</td>";
            echo "<td style='border: 1px solid black; padding: 5px;'>".$row["due_date"]."</td>";
            // Display category name instead of category id
            $category_query = mysqli_query($conn, "SELECT category_name FROM categories WHERE id='".$row['task_category_id']."'");
            $category_name = mysqli_fetch_assoc($category_query)['category_name'];
            echo "<td style='border: 1px solid black; padding: 5px;'>".$category_name."</td>";

            echo "<td style='border: 1px solid black; padding: 5px;'>".$row["task_priority"]."</td>";
            echo "<td style='border: 1px solid black; padding: 5px;'>".($row["task_status"] == 1 ? "Complete" : "Incomplete")."</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    </table>
      <br />
     <h1>View By Category</h1>
      <?php
       // Check if category is selected
        if(isset($_POST['category_id'])) {
        // Get the category ID from the form
        $category_id = $_POST['category_id'];
    
        // Query the tasks table for the selected category
        $sql = "SELECT * FROM tasks WHERE task_category_id = '$category_id'";
        $result = mysqli_query($conn, $sql);
    
        // Check if there are any tasks for the selected category
        // Check if there are any tasks for the selected category
    if(mysqli_num_rows($result) > 0) {
      // Display a table of tasks for the selected category
      echo "<table style='border-collapse: collapse; width: 100%;'>";
      echo "<thead style='text-align: center; background-color: #ddd;'>";
      echo "<tr>
      <th style='border: 1px solid black; padding: 5px;'>Task Description</th>
      <th style='border: 1px solid black; padding: 5px;'>Due Date</th>
      <th style='border: 1px solid black; padding: 5px;'>Task Category</th>
      <th style='border: 1px solid black; padding: 5px;'>Priority</th>
      <th style='border: 1px solid black; padding: 5px;'>Status</th>
      </tr>";
      echo "</thead>";
      echo "<tbody>";
      while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['task_desc'] . "</td>";
          echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['due_date'] . "</td>";
          $category_query = mysqli_query($conn, "SELECT category_name FROM categories WHERE id='".$row['task_category_id']."'");
          $category_name = mysqli_fetch_assoc($category_query)['category_name'];
          echo "<td style='border: 1px solid black; padding: 5px;'>".$category_name."</td>";
          echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['task_priority'] . "</td>";
          echo "<td style='border: 1px solid black; padding: 5px;'>" . ($row['task_status'] ? 'Complete' : 'Incomplete') . "</td>";
          echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
  } else {
      echo "No tasks found for the selected category.";
  }
}

// Display a form to select a category
      echo "<form method='post'>";
      echo "<label for='category_id'>Select a category:</label>";
      echo "<select id='category_id' name='category_id'>";
      // Query the categories table for all categories
      $sql = "SELECT * FROM categories";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)) {
      echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
      }
      echo "</select>";
      echo "<input type='submit' value='Show Tasks'>";
      echo "</form>";
        
      ?>
      <br />
      <h1>View by Completed Tasks</h1>
      <table style='border-collapse: collapse; width: 100%;'>
      <thead style='text-align: center; background-color: #ddd;'>
      <tr>
        <th style='border: 1px solid black; padding: 5px;'>Task Description</th>
        <th style='border: 1px solid black; padding: 5px;'>Due Date</th>
        <th style='border: 1px solid black; padding: 5px;'>Task Category</th>
        <th style='border: 1px solid black; padding: 5px;'>Priority</th>
        <th style='border: 1px solid black; padding: 5px;'>Status</th>
      </tr>
      </thead>
      <tbody>
          <?php
            //Queries for completed tasks list view
            $taskCompQuery = "SELECT * FROM tasks WHERE task_status = 1 ORDER BY due_date ASC";
            $taskCompData = mysqli_query($conn, $taskCompQuery) or die('Unable to obtain data: '. mysqli_connect_error());
            if(empty($taskCompData)){
                echo "There are no completed tasks to display";
            }
            else{
                while ($row = mysqli_fetch_array($taskCompData, MYSQLI_ASSOC)){
                  echo "<tr>";
                  echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['task_desc'] . "</td>";
                  echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['due_date'] . "</td>";
                  $category_query = mysqli_query($conn, "SELECT category_name FROM categories WHERE id='".$row['task_category_id']."'");
                  $category_name = mysqli_fetch_assoc($category_query)['category_name'];
                  echo "<td style='border: 1px solid black; padding: 5px;'>".$category_name."</td>";
                  echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['task_priority'] . "</td>";
                  echo "<td style='border: 1px solid black; padding: 5px;'>" . ($row['task_status'] ? 'Complete' : 'Incomplete') . "</td>";
                  echo "</tr>";
                }
            }
          ?>
      </tbody>
      </table>
  </div>
</body>
</html>
