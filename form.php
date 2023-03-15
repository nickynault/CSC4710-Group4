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
  <title>Create Your Task!</title>
</head>

<body>
  <header>
	<h1>Create Your Task!</h1>
  </header>

  <nav>
	<ul>
		<li><a href= "index.php">Home</a></li>
		<li><a href= "about.html">About Us</a></li>
		<li><a href= "todo.php">To-Do Lists</a></li>
	</ul>
  </nav>
  
  <div id="main">
 
<form id="myForm" style="display:block" action="add_task.php" method="post">
		<label for="task_desc">Task Description*:</label>
		<input type="text" id="task_desc" name="task_desc"><br><br>
		<label for="due_date">Due Date*:</label>
		<input type="date" id="due_date" name="due_date"><br><br>
		<label for="task_category">Task Category:</label>
		<select id="task_category" name="task_category">
			<option value="">N/A</option>
			<option value="Work">Work</option>
			<option value="Personal">Personal</option>
			<option value="Shopping">Shopping</option>
			<option value="Other">Other</option>
		</select><br><br>
		<label for="priority">Priority Level:</label>
		<input type="number" id="priority" name="priority" min="1" max="4"><br><br>
		<label for="task_status">Status*:</label>
		<select id="task_status" name="task_status">
			<option value="active">Active</option>
			<option value="completed">Completed</option>
		</select><br><br>
	    <input type="submit" value="Create">
	    
<?php if(isset($_GET['success'])): ?>
  <p>Task successfully added!</p>
<?php endif; ?>

<form id="myForm" action="add_task.php" method="post" style="display:none;">
  <!-- form fields -->
	  </form>
  
  <footer>
  <p>Copyright © Group 4 with Wayne State University and their respective owners.</p>
  </footer>
</body>
