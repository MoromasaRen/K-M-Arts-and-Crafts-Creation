## Database Setup Instructions

Follow the steps below to set up the database for this project:

---

### 1. Open XAMPP Control Panel

1. Open the XAMPP control panel on your local machine.
2. Start the following services:
   - **Apache**: This will run the web server.
   - **MySQL**: This will run the database server.

---

### 2. Open MySQL Admin (phpMyAdmin)

1. Open your web browser.
2. In the address bar, type `localhost` and press **Enter**.
3. Click on **phpMyAdmin** to open the MySQL admin interface.
4. In the left sidebar, click **New** to create a new database.

---

### 3. Setting Up Database Table

-> Set up the database by going to backend/database/database.sql
-> dump all the code into the XAMPP
-> Execute the SQL script by clicking Go.



### 4. Setting Up The Staff Account
🪟 For Windows Command Prompt
-> Open Command Prompt (press Windows + R, type cmd, hit Enter).

-> Change to your PHP folder:
sample:
cd /d D:\Softwares\XAMPP\php
or 
cd C:\xampp\php

//cd /d is used to switch drives (D: in your case) and directories in one command.//

-> then 

php -r "echo password_hash('12345', PASSWORD_DEFAULT);"

✅ You should see output like:

$2y$10$VpX3vq3c3gXUpZNsqq5HOOD0UnyGr75sCJKcKGRhGbPC0OMU34E2C

once you get the hashed password


### 5. Setting Up The Staff Account part 2 
run this in sql XAMPP via users
INSERT INTO users (first_name, last_name, email, user_type, password, contact_number, dateofbirth) VALUES
('Admin', 'Moromasa', 'admin@gmail.com', 'staff', '$2y$10$TEpaeGKriyAlkvo3/OlY4edjilD3AqpvYL4hoBw6RwYRwv/l5tjcW', NULL, NULL),



-> the staff account should be:
email: admin@gmail.com
password: 12345
