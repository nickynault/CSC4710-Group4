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

  