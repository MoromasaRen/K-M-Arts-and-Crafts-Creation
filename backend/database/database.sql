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
    base_price DECIMAL(10, 2),
    status ENUM('in stock', 'low stock', 'no stock') DEFAULT 'in stock'
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

-- Insert Products
ALTER TABLE products ADD product_quantity INT NOT NULL DEFAULT 0;
INSERT INTO products (product_name, product_description, base_price, product_quantity, status) VALUES
('1DZ', '12 roses', 999, 200, 'in stock'),
('6 Sunrise 2', '1 sunflower 6 roses', 880, 200, 'in stock'),
('6 Sunrise Bloom', '3 red roses 3 pink', 880, 200, 'in stock'),
('6R Black', '6 red roses black cello', 510, 200, 'in stock'),
('6R Green', '6 red roses green cello', 500, 200, 'in stock'),
('6R Vio', '6 roses vio cello', 500, 200, 'in stock'),
('6R White', '6 roses white cello', 510, 200, 'in stock'),
('6R2 White', '6 roses white cello v2', 610, 200, 'in stock'),
('7R Green', '8 roses green cello', 500, 200, 'in stock');

-- Insert Users
INSERT INTO users (first_name, last_name, email, user_type, password, contact_number) VALUES
('Test1', 'User', 'test1@example.com', 'user', 'password123', '09170000001'),
('Test2', 'User', 'test2@example.com', 'user', 'password123', '09170000002'),
('Test3', 'User', 'test3@example.com', 'user', 'password123', '09170000003'),
('Test4', 'User', 'test4@example.com', 'user', 'password123', '09170000004'),
('Test5', 'User', 'test5@example.com', 'user', 'password123', '09170000005'),
('Test6', 'User', 'test6@example.com', 'user', 'password123', '09170000006'),
('Test7', 'User', 'test7@example.com', 'user', 'password123', '09170000007'),
('Test8', 'User', 'test8@example.com', 'user', 'password123', '09170000008'),
('Test9', 'User', 'test9@example.com', 'user', 'password123', '09170000009'),
('Test10', 'User', 'test10@example.com', 'user', 'password123', '09170000010'),
('Test11', 'User', 'test11@example.com', 'user', 'password123', '09170000011'),
('Test12', 'User', 'test12@example.com', 'user', 'password123', '09170000012'),
('Test13', 'User', 'test13@example.com', 'user', 'password123', '09170000013'),
('Test14', 'User', 'test14@example.com', 'user', 'password123', '09170000014'),
('Test15', 'User', 'test15@example.com', 'user', 'password123', '09170000015'),
('Test16', 'User', 'test16@example.com', 'user', 'password123', '09170000016'),
('Test17', 'User', 'test17@example.com', 'user', 'password123', '09170000017'),
('Test18', 'User', 'test18@example.com', 'user', 'password123', '09170000018'),
('Test19', 'User', 'test19@example.com', 'user', 'password123', '09170000019'),
('Test20', 'User', 'test20@example.com', 'user', 'password123', '09170000020');


INSERT INTO orders (user_id, order_details, total_amount, status) VALUES
-- User 1
(1, '1DZ, 6R Black', 1509.00, 'confirmed'),
(1, '6 Sunrise Bloom', 880.00, 'pending'),
(1, '6R Green, 6R Vio', 1000.00, 'completed'),

-- User 2
(2, '6 Sunrise 2', 880.00, 'confirmed'),
(2, '1DZ', 999.00, 'pending'),
(2, '7R Green', 500.00, 'completed'),

-- User 3
(3, '6R White', 510.00, 'confirmed'),
(3, '6 Sunrise Bloom, 6R2 White', 1490.00, 'pending'),
(3, '6R Vio', 500.00, 'completed'),

-- User 4
(4, '6R Green', 500.00, 'confirmed'),
(4, '1DZ', 999.00, 'pending'),
(4, '6 Sunrise 2, 6R White', 1390.00, 'completed'),

-- User 5
(5, '6 Sunrise Bloom', 880.00, 'confirmed'),
(5, '6R2 White', 610.00, 'pending'),
(5, '6R Black', 510.00, 'completed'),

-- User 6
(6, '1DZ', 999.00, 'confirmed'),
(6, '7R Green, 6 Sunrise 2', 1380.00, 'pending'),
(6, '6R Green', 500.00, 'completed'),

-- User 7
(7, '6R Vio', 500.00, 'confirmed'),
(7, '6R White, 6R2 White', 1120.00, 'pending'),
(7, '6 Sunrise Bloom', 880.00, 'completed'),

-- User 8
(8, '6 Sunrise 2', 880.00, 'confirmed'),
(8, '1DZ, 6R Green', 1499.00, 'pending'),
(8, '6R Vio', 500.00, 'completed'),

-- User 9
(9, '6R Black', 510.00, 'confirmed'),
(9, '6 Sunrise Bloom', 880.00, 'pending'),
(9, '6R2 White', 610.00, 'completed'),

-- User 10
(10, '7R Green', 500.00, 'confirmed'),
(10, '6R Green, 6R White', 1010.00, 'pending'),
(10, '1DZ', 999.00, 'completed'),

-- User 11
(11, '6 Sunrise 2', 880.00, 'confirmed'),
(11, '6R Vio', 500.00, 'pending'),
(11, '6R2 White', 610.00, 'completed'),

-- User 12
(12, '6 Sunrise Bloom', 880.00, 'confirmed'),
(12, '6R White', 510.00, 'pending'),
(12, '1DZ', 999.00, 'completed'),

-- User 13
(13, '6R Green', 500.00, 'confirmed'),
(13, '6R Black, 6R Vio', 1010.00, 'pending'),
(13, '6R2 White', 610.00, 'completed'),

-- User 14
(14, '6 Sunrise 2', 880.00, 'confirmed'),
(14, '6R White, 1DZ', 1509.00, 'pending'),
(14, '7R Green', 500.00, 'completed'),

-- User 15
(15, '6 Sunrise Bloom', 880.00, 'confirmed'),
(15, '6R2 White, 6R Green', 1110.00, 'pending'),
(15, '6R Black', 510.00, 'completed'),

-- User 16
(16, '6 Sunrise 2', 880.00, 'confirmed'),
(16, '1DZ, 6R White', 1509.00, 'pending'),
(16, '6R Vio', 500.00, 'completed'),

-- User 17
(17, '6 Sunrise Bloom', 880.00, 'confirmed'),
(17, '6R2 White', 610.00, 'pending'),
(17, '6R White, 6R Black', 1020.00, 'completed'),

-- User 18
(18, '6 Sunrise 2, 6R Green', 1380.00, 'confirmed'),
(18, '1DZ', 999.00, 'pending'),
(18, '6R Vio', 500.00, 'completed'),

-- User 19
(19, '6R2 White', 610.00, 'confirmed'),
(19, '6 Sunrise Bloom, 6R White', 1390.00, 'pending'),
(19, '1DZ', 999.00, 'completed'),

-- User 20
(20, '6R Green, 6R Black', 1010.00, 'confirmed'),
(20, '6 Sunrise 2', 880.00, 'pending'),
(20, '6R2 White', 610.00, 'completed');
