<<<<<<< HEAD
DROP TABLE IF EXISTS tasks;
CREATE TABLE tasks(
        id int NOT NULL,
  		  task_desc varchar(255) NOT NULL,
        due_date date NOT NULL,
        task_category varchar(255),
        priority int NOT NULL,
        task_status varchar(255)

        CHECK (1 <= priority <= 4)
  );
  
DROP TABLE IF EXISTS categories;
CREATE TABLE categories(
      id int NOT NULL,
  		category_name varchar(255)
  );

=======
DROP TABLE IF EXISTS tasks;
CREATE TABLE tasks(
  		task_desc varchar(255) NOT NULL,
        due_date date NOT NULL,
        task_category varchar(255),
        priority int NOT NULL,
        task_status varchar(255)

        CHECK (1 <= priority <= 4)
  );
  
DROP TABLE IF EXISTS categories;
CREATE TABLE categories(
  		category_name varchar(255)
  );

>>>>>>> e142cfb61819e37bd11ed029edf171b92e4ec21e
  