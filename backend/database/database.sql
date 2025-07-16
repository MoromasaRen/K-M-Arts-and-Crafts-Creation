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
    contact_number VARCHAR(20),
    dateofbirth DATE,
    address TEXT DEFAULT NULL,
    country VARCHAR(100) DEFAULT NULL,
    city VARCHAR(100) DEFAULT NULL,
    postal_code VARCHAR(20) DEFAULT NULL
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
    courier_type ENUM('Move It', 'Maxim', 'Motor') DEFAULT 'Motor',
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
('7R Green', '8 roses green cello', 550, 200, 'in stock'),
('8R Blue', '8 roses blue cello', 550, 200, 'in stock'),
('8R Sunrise', '8 roses sunrise arrangement', 989, 200, 'in stock'),
('Baby Blooms', 'Small mixed bloom', 488, 200, 'in stock'),
('Beige Lily', 'Beige lily flowers', 160, 200, 'in stock'),
('Blue Fade', 'Faded blue floral arrangement', 245, 200, 'in stock'),
('Blue Gerbera', 'Blue gerbera daisy', 165, 200, 'in stock'),
('Blue Lily', 'Blue lily flower (single)', 185, 200, 'in stock'),
('Blue Lily', 'Premium blue lily bouquet', 385, 200, 'in stock'),
('Blue Star Garden', 'Blue floral star arrangement', 655, 200, 'in stock'),
('Blue Tulip', 'Blue tulip', 155, 200, 'in stock'),
('Blush Lily', 'Blush lily flower', 155, 200, 'in stock'),
('Blush Star Garden', 'Blush-themed star garden', 655, 200, 'in stock'),
('Blush Tulip', 'Blush pink tulip', 155, 200, 'in stock'),
('Dark Lilac Lily', 'Dark lilac lily bouquet', 385, 200, 'in stock'),
('Elegance Bloom', 'Elegant mixed bloom', 488, 200, 'in stock'),
('Fade Pink Lily', 'Faded pink lily bouquet', 385, 200, 'in stock'),
('Floral Mix', 'Mixed floral bouquet', 485, 200, 'in stock'),
('Fortune Bloom', 'Fortune-themed floral bouquet', 500, 200, 'in stock'),
('Grand Custom', 'Custom grand bouquet', 1199, 200, 'in stock'),
('Grand Garden', 'Grand garden bouquet', 520, 200, 'in stock'),
('Green Star Garden', 'Green-themed star garden', 655, 200, 'in stock'),
('Lilac Blush', 'Lilac blush bouquet', 385, 200, 'in stock'),
('Lilac Lily', 'Light lilac lily', 155, 200, 'in stock'),
('Pink Garden', 'Pink-themed garden bouquet', 489, 200, 'in stock'),
('PinVio', 'Pink and violet bouquet', 520, 200, 'in stock'),
('Purple Star Garden', 'Purple star garden', 655, 200, 'in stock'),
('Sunrise Sunflower', 'Sunflower with sunrise tones', 165, 200, 'in stock'),
('Wild Garden', 'Wildflower bouquet', 489, 200, 'in stock');

-- insert users
INSERT INTO users (first_name, last_name, email, user_type, password, contact_number, dateofbirth) VALUES
('Test1', 'User', 'test1@example.com', 'user', 'password123', NULL, NULL),
('Test2', 'User', 'test2@example.com', 'user', 'password123', NULL, NULL),
('Test3', 'User', 'test3@example.com', 'user', 'password123', NULL, NULL),
('Test4', 'User', 'test4@example.com', 'user', 'password123', NULL, NULL),
('Test5', 'User', 'test5@example.com', 'user', 'password123', NULL, NULL),
('Test6', 'User', 'test6@example.com', 'user', 'password123', NULL, NULL),
('Test7', 'User', 'test7@example.com', 'user', 'password123', NULL, NULL),
('Test8', 'User', 'test8@example.com', 'user', 'password123', NULL, NULL),
('Test9', 'User', 'test9@example.com', 'user', 'password123', NULL, NULL),
('Test10', 'User', 'test10@example.com', 'user', 'password123', NULL, NULL),
('Test11', 'User', 'test11@example.com', 'user', 'password123', NULL, NULL),
('Test12', 'User', 'test12@example.com', 'user', 'password123', NULL, NULL),
('Test13', 'User', 'test13@example.com', 'user', 'password123', NULL, NULL),
('Test14', 'User', 'test14@example.com', 'user', 'password123', NULL, NULL),
('Test15', 'User', 'test15@example.com', 'user', 'password123', NULL, NULL),
('Test16', 'User', 'test16@example.com', 'user', 'password123', NULL, NULL),
('Test17', 'User', 'test17@example.com', 'user', 'password123', NULL, NULL),
('Test18', 'User', 'test18@example.com', 'user', 'password123', NULL, NULL),
('Test19', 'User', 'test19@example.com', 'user', 'password123', NULL, NULL),
('Test20', 'User', 'test20@example.com', 'user', 'password123', NULL, NULL);



// make sure there are relation to order, product, and delivery such that

Following Relations need to be added:

product -> order
when a user orders a product in a batch of specific product_quantities this will get multiplied by product_quantities * the base_price to get the total amount of orders


order -> delivery
// populate delivery table using order status = 'confirmed'
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (1, '1DZ, 6R Black', '2025-07-16 19:29:05', 1509.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (1, '6 Sunrise Bloom', '2025-07-18 10:04:01', 880.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (1, '6R Green, 6R Vio', '2025-07-11 05:44:32', 1000.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (2, '6 Sunrise 2', '2025-07-18 20:45:40', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (2, '1DZ', '2025-07-11 18:33:49', 999.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (2, '7R Green', '2025-07-16 02:38:46', 500.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (3, '6R White', '2025-07-10 17:31:42', 510.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (3, '6 Sunrise Bloom, 6R2 White', '2025-07-21 13:13:30', 1490.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (3, '6R Vio', '2025-07-17 17:53:01', 500.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (4, '6R Green', '2025-07-10 00:16:53', 500.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (4, '1DZ', '2025-07-14 17:41:32', 999.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (4, '6 Sunrise 2, 6R White', '2025-07-20 02:06:24', 1390.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (5, '6 Sunrise Bloom', '2025-07-20 17:59:48', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (5, '6R2 White', '2025-07-13 15:56:33', 610.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (5, '6R Black', '2025-07-10 23:27:07', 510.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (6, '1DZ', '2025-07-20 15:50:18', 999.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (6, '7R Green, 6 Sunrise 2', '2025-07-13 04:29:35', 1380.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (6, '6R Green', '2025-07-12 13:03:29', 500.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (7, '6R Vio', '2025-07-19 18:57:13', 500.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (7, '6R White, 6R2 White', '2025-07-19 01:38:18', 1120.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (7, '6 Sunrise Bloom', '2025-07-09 06:27:33', 880.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (8, '6 Sunrise 2', '2025-07-19 00:50:39', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (8, '1DZ, 6R Green', '2025-07-11 03:47:53', 1499.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (8, '6R Vio', '2025-07-17 00:14:51', 500.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (9, '6R Black', '2025-07-18 12:34:13', 510.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (9, '6 Sunrise Bloom', '2025-07-22 14:20:11', 880.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (9, '6R2 White', '2025-07-18 23:44:32', 610.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (10, '7R Green', '2025-07-12 11:56:55', 500.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (10, '6R Green, 6R White', '2025-07-18 06:10:09', 1010.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (10, '1DZ', '2025-07-17 04:26:58', 999.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (11, '6 Sunrise 2', '2025-07-11 13:19:32', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (11, '6R Vio', '2025-07-17 19:14:10', 500.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (11, '6R2 White', '2025-07-14 07:42:01', 610.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (12, '6 Sunrise Bloom', '2025-07-21 09:10:01', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (12, '6R White', '2025-07-22 18:50:02', 510.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (12, '1DZ', '2025-07-13 21:19:24', 999.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (13, '6R Green', '2025-07-09 03:12:07', 500.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (13, '6R Black, 6R Vio', '2025-07-19 13:22:18', 1010.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (13, '6R2 White', '2025-07-17 15:18:44', 610.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (14, '6 Sunrise 2', '2025-07-13 08:14:53', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (14, '6R White, 1DZ', '2025-07-10 21:44:13', 1509.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (14, '7R Green', '2025-07-21 04:59:30', 500.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (15, '6 Sunrise Bloom', '2025-07-12 09:11:23', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (15, '6R2 White, 6R Green', '2025-07-20 10:20:13', 1110.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (15, '6R Black', '2025-07-18 08:02:17', 510.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (16, '6 Sunrise 2', '2025-07-13 01:26:17', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (16, '1DZ, 6R White', '2025-07-22 07:47:10', 1509.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (16, '6R Vio', '2025-07-15 04:00:00', 500.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (17, '6 Sunrise Bloom', '2025-07-11 15:48:59', 880.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (17, '6R2 White', '2025-07-22 13:10:23', 610.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (17, '6R White, 6R Black', '2025-07-13 19:41:22', 1020.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (18, '6 Sunrise 2, 6R Green', '2025-07-13 17:18:02', 1380.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (18, '1DZ', '2025-07-10 03:04:58', 999.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (18, '6R Vio', '2025-07-14 10:55:29', 500.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (19, '6R2 White', '2025-07-09 07:43:25', 610.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (19, '6 Sunrise Bloom, 6R White', '2025-07-21 00:59:19', 1390.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (19, '1DZ', '2025-07-15 18:05:20', 999.0, 'completed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (20, '6R Green, 6R Black', '2025-07-09 22:23:44', 1010.0, 'confirmed');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (20, '6 Sunrise 2', '2025-07-15 11:36:39', 880.0, 'pending');
INSERT INTO orders (user_id, order_details, order_date, total_amount, status) VALUES (20, '6R2 White', '2025-07-22 21:33:15', 610.0, 'completed');
