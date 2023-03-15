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
  <title>ToDo List</title>
</head>

<body>
  <header>
	<h1>Make Useful To-Do Lists!</h1>
  </header>

  <nav>
	<ul>
		<li><a href= "index.php">Home</a></li>
		<li><a href= "about.html">About the Authors</a></li>
	</ul>
  </nav>
  
  <div id="main">
 
  <h2>Purpose of This Site</h2>
  <p>
  This site is intended to help users create and edit in a number of ways an efficient To-Do List. Due dates, descriptions,
  catergories, priority levels, names, statuses and more will be available to tweak user experience. Certain included
  functionalities consist of what is listed above, along with users being able to mark tasks as complete or incomplete,
  creating new tasks/categories, and editing all the details before and during task existence. 
  </p>
  </div>
  
  <div class="container">
  <a class="button"  style="--color:#1e9bff;" href="#myForm">
    Start your to-do list here!
  </a>
  </div>

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