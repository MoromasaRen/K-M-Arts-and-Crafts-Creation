Database Setup Instructions
Follow the steps below to set up the database for this project:

1. Start XAMPP Services
Open the XAMPP Control Panel on your local machine.

Start the following services:

Apache (Web server)

MySQL (Database server)

2. Access phpMyAdmin
Open your web browser and go to http://localhost.

Click on phpMyAdmin to open the MySQL admin interface.

In the left sidebar, click New to create a new database.

Enter the database name: kmartsdb and click Create.

3. Create Database Tables
On the top bar of phpMyAdmin, click on the SQL tab.

In the SQL query box, paste the following SQL code:

sql
Copy
Edit
-- Create Database
CREATE DATABASE KM_Arts_and_Crafts_Creation;
USE KM_Arts_and_Crafts_Creation;

-- Table: Users
CREATE TABLE Users_T (
  User_ID INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  First_Name VARCHAR(20) NOT NULL,
  Last_Name VARCHAR(20) NOT NULL,
  Email VARCHAR(20) UNIQUE NOT NULL,
  User_Type VARCHAR(20) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  Contact_Number VARCHAR(15) NOT NULL
);

-- Table: Staff
CREATE TABLE Staff_T (
  Staff_ID INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  First_Name VARCHAR(20) NOT NULL,
  Last_Name VARCHAR(20) NOT NULL,
  Email VARCHAR(20) UNIQUE NOT NULL,
  Contact_Number VARCHAR(15) NOT NULL,
  Position VARCHAR(20) NOT NULL,
  Status VARCHAR(20) NOT NULL
);

-- Table: Product
CREATE TABLE Product_T (
  Product_ID INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  Product_Name VARCHAR(20) NOT NULL,
  Product_Description TEXT,
  Base_Price DECIMAL(10, 2) NOT NULL,
  Status VARCHAR(20) NOT NULL
);

-- Table: Orders
CREATE TABLE Orders_T (
  Order_ID INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  User_ID INT(10) NOT NULL,
  Item_ID INT(10) NOT NULL,
  Order_Details TEXT,
  Order_Date DATE NOT NULL,
  Total_Amount DECIMAL(10, 2) NOT NULL,
  Status VARCHAR(20) NOT NULL,
  FOREIGN KEY (User_ID) REFERENCES Users_T(User_ID),
  FOREIGN KEY (Item_ID) REFERENCES Order_Item_T(Item_ID)
);

-- Table: Order_Item
CREATE TABLE Order_Item_T (
  Item_ID INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  Order_ID INT(10) NOT NULL,
  Product_ID INT(10) NOT NULL,
  Quantity INT(10) NOT NULL,
  Price DECIMAL(10, 2) NOT NULL,
  Total_Units INT(10) NOT NULL,
  FOREIGN KEY (Order_ID) REFERENCES Orders_T(Order_ID),
  FOREIGN KEY (Product_ID) REFERENCES Product_T(Product_ID)
);

-- Table: Delivery
CREATE TABLE Delivery_T (
  Delivery_ID INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  Order_ID INT(10) NOT NULL,
  Staff_ID INT(10) NOT NULL,
  Scheduled_Time DATETIME NOT NULL,
  Actual_Delivery_Time DATETIME,
  Delivery_Status VARCHAR(20) NOT NULL,
  Courier_Type VARCHAR(20) NOT NULL,
  Plate_Number VARCHAR(15) NOT NULL,
  FOREIGN KEY (Order_ID) REFERENCES Orders_T(Order_ID),
  FOREIGN KEY (Staff_ID) REFERENCES Staff_T(Staff_ID)
);
Execute the SQL script by clicking Go.