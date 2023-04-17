<?php
// Database connection
$servername = "localhost";
$username = "id20153491_testingthis";
$password = "l5ak3jKJ_44hJh]9";
$database = "id20153491_test";

$conn = mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . connect_error());
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
      <table>
          <tr>
              <th>Description</th>
              <th>Due Date</th>
              <th>Category</th>
              <th>Priority Level</th>
              <th>Status</th>
          </tr>
          <?php
            //Defualt List View
            $fetch = "SELECT * FROM tasks WHERE due_date <= CURDATE() OR due_date = CURDATE() ORDER BY task_priority ASC";
            $data = mysqli_query($conn, $fetch) or die('Unable to obtain data: '. mysqli_connect_error());

            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)){
                echo "<tr><form method='post'>";
                echo "<td><input type='text' name='task_desc' value='".$row["task_desc"]."'></td>";
                echo "<td><input type='date' name='due_date' value='".$row["due_date"]."'></td>";

                // Display categories dropdown
                echo "<td><select name='task_category_id'>";
                $categories_query = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");
                while ($category_row = mysqli_fetch_array($categories_query, MYSQLI_ASSOC)) {
                    $selected = $category_row['id'] == $row['task_category_id'] ? 'selected' : '';
                    echo "<option value='".$category_row['id']."' $selected>".$category_row['category_name']."</option>";
                }
                echo "</select></td>";
 
                echo "<td><input type='number' id='task_priority' name='task_priority' min='1' max='4' value='".$row["task_priority"]."'></td>";
                echo "<td><input type='checkbox' name='task_status' value='1' " . ($row["task_status"] == 1 ? "checked" : "") . "></td>";
                echo "<td><input type='submit' name='submit' value='Save'></td>";
                echo "<input type='hidden' name='id' value='".$row["id"]."'>";
                echo "</form></tr>";
            }
          ?>
      </table>
      <br />
      <h1>Custom Views</h1>
      <?php
        //Queries for category list views
        $taskCatQuery = "SELECT * FROM tasks ORDER BY task_priority ASC, due_date ASC";
        $catQuery = "SELECT category_name FROM categories";
        $taskCatData = mysqli_query($conn, $taskCatQuery) or die('Unable to obtain data: '. mysqli_connect_error());
        $catData = mysqli_query($conn, $catQuery) or die('Unable to obtain data: '. mysqli_connect_error());
        //Queries for completed tasks list view
        $taskCompQuery = "SELECT * FROM tasks WHERE task_status = 1 ORDER BY due_date ASC";
        $taskCompData = mysqli_query($conn, $taskCompQuery) or die('Unable to obtain data: '. mysqli_connect_error());
        
        //Converts category_name column from categories table into array
        $catArray = array();
        if ($catData->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($catData)) {
                $catArray[] = $row['category_name'];
            }
        }
        //Converts entire tasks table into an array
        $taskCatArray = array();
        while ($row = mysqli_fetch_assoc($taskCatData)){
            $taskCatArray[] = $row;
        }
        
        //Creates drop down list to select a list view
        echo '<form method="post" action="">';
        echo '<label for="view">Select List View: </label>';
        echo '<select id="view" name="view">';
        //Loops through the array created above to display available categories
        foreach ($catArray as $value) {
            echo '<option value="' . $value . '">' . $value . '</option>';
        }
        echo '</select>';
        echo '<input type="submit" value="Submit">';
        echo '</form>';
        
        //Brings up the selected form with the information
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selectedView = $_POST['submit'];
            if (isset($taskCatArray[$selectedView])) {
                echo '<table>';
            }
        }
      ?>
  </div>
  
</body>
</html>
