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
5. Enter the name `kmartsdb` database name and click **Create**.

---

### 3. Create Database Table

1. On the top bar of phpMyAdmin, click on the **SQL** tab.
2. In the SQL query box, paste the following code:

```sql

CREATE DATABASE km_arts;
USE km_arts;

-- USERS TABLE
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    user_type ENUM('staff', 'user') NOT NULL,
    password VARCHAR(255),
    contact_number VARCHAR(20)
);

-- PRODUCTS TABLE
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255),
    product_description TEXT,
    base_price DECIMAL(10,2),
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- ORDERS TABLE
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    order_details TEXT,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2),
    status ENUM('pending', 'confirmed', 'completed') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- ORDER_ITEMS TABLE
CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10,2),
    total_units DECIMAL(10,2),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- DELIVERIES TABLE
CREATE TABLE deliveries (
    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    staff_id INT,
    scheduled_time DATETIME,
    actual_delivery_time DATETIME,
    delivery_status ENUM('scheduled', 'in_transit', 'delivered') DEFAULT 'scheduled',
    courier_type VARCHAR(50),
    plate_number VARCHAR(20),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (staff_id) REFERENCES users(user_id)
);

```

3. Execute the SQL script by clicking Go.
