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
    order_quantity INT,
    total_amount DECIMAL(10,2),
    status ENUM('pending', 'confirmed', 'completed') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);



-- Payment Table
CREATE TABLE Payment (
    Payment_ID INT(11)  AUTO_INCREMENT PRIMARY KEY,
    Order_ID INT(11),
    Mode_of_payment ENUM('Cash On Delivery', 'To Be Implemented'),
    Amount_paid DECIMAL(10, 2),
    Payment_Status ENUM('Pending Payment', 'Completed Payment'),
    FOREIGN KEY (Order_ID) REFERENCES Orders(Order_ID)
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
    user_id INT,
    scheduled_time DATETIME,
    actual_delivery_time DATETIME,
    delivery_status ENUM('scheduled', 'in_transit', 'delivered') DEFAULT 'scheduled',
    courier_type ENUM('Move It', 'Maxim', 'Motor') DEFAULT 'Motor',
    plate_number VARCHAR(20),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
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


INSERT INTO orders (user_id, order_details, order_date, order_quantity, total_amount, status) VALUES
-- User 1
(1, '1DZ',           '2025-07-16 19:29:05', 1, 999.00, 'confirmed'),
(1, '6R Black',      '2025-07-16 19:29:05', 1, 510.00, 'confirmed'),
(1, '6 Sunrise Bloom','2025-07-18 10:04:01', 1, 880.00, 'pending'),

-- User 2
(2, '6 Sunrise 2',   '2025-07-18 20:45:40', 1, 880.00, 'confirmed'),
(2, '1DZ',           '2025-07-11 18:33:49', 1, 999.00, 'pending'),
(2, '7R Green',      '2025-07-16 02:38:46', 1, 500.00, 'completed'),

-- User 3
(3, '6R White',      '2025-07-10 17:31:42', 1, 510.00, 'confirmed'),
(3, '6 Sunrise Bloom','2025-07-21 13:13:30', 1, 880.00, 'pending'),
(3, '6R2 White',     '2025-07-21 13:13:30', 1, 610.00, 'pending'),
(3, '6R Vio',        '2025-07-17 17:53:01', 1, 500.00, 'completed'),

-- User 4
(4, '6R Green',      '2025-07-10 00:16:53', 1, 500.00, 'confirmed'),
(4, '1DZ',           '2025-07-14 17:41:32', 1, 999.00, 'pending'),
(4, '6 Sunrise 2',   '2025-07-20 02:06:24', 1, 880.00, 'completed'),
(4, '6R White',      '2025-07-20 02:06:24', 1, 510.00, 'completed'),

-- User 5
(5, '6 Sunrise Bloom','2025-07-20 17:59:48', 1, 880.00, 'confirmed'),
(5, '6R2 White',     '2025-07-13 15:56:33', 1, 610.00, 'pending'),
(5, '6R Black',      '2025-07-10 23:27:07', 1, 510.00, 'completed'),

-- User 6
(6, '1DZ',            '2025-07-20 15:50:18', 1, 999.00, 'confirmed'),
(6, '7R Green',       '2025-07-13 04:29:35', 1, 500.00, 'pending'),
(6, '6 Sunrise 2',    '2025-07-13 04:29:35', 1, 880.00, 'pending'),
(6, '6R Green',       '2025-07-12 13:03:29', 1, 500.00, 'completed'),

-- User 7
(7, '6R Vio',         '2025-07-19 18:57:13', 1, 500.00, 'confirmed'),
(7, '6R White',       '2025-07-19 01:38:18', 1, 510.00, 'pending'),
(7, '6R2 White',      '2025-07-19 01:38:18', 1, 610.00, 'pending'),
(7, '6 Sunrise Bloom','2025-07-09 06:27:33', 1, 880.00, 'completed'),

-- User 8
(8, '6 Sunrise 2',    '2025-07-19 00:50:39', 1, 880.00, 'confirmed'),
(8, '1DZ',            '2025-07-11 03:47:53', 1, 999.00, 'pending'),
(8, '6R Green',       '2025-07-11 03:47:53', 1, 500.00, 'pending'),
(8, '6R Vio',         '2025-07-17 00:14:51', 1, 500.00, 'completed'),

-- User 9
(9, '6R Black',       '2025-07-18 12:34:13', 1, 510.00, 'confirmed'),
(9, '6 Sunrise Bloom','2025-07-22 14:20:11', 1, 880.00, 'pending'),
(9, '6R2 White',      '2025-07-18 23:44:32', 1, 610.00, 'completed'),

-- User 10
(10, '7R Green',      '2025-07-12 11:56:55', 1, 500.00, 'confirmed'),
(10, '6R Green',      '2025-07-18 06:10:09', 1, 500.00, 'pending'),
(10, '6R White',      '2025-07-18 06:10:09', 1, 510.00, 'pending'),
(10, '1DZ',           '2025-07-17 04:26:58', 1, 999.00, 'completed'),

-- User 11
(11, '6 Sunrise 2',   '2025-07-11 13:19:32', 1, 880.00, 'confirmed'),
(11, '6R Vio',        '2025-07-17 19:14:10', 1, 500.00, 'pending'),
(11, '6R2 White',     '2025-07-14 07:42:01', 1, 610.00, 'completed'),

-- User 12
(12, '6 Sunrise Bloom','2025-07-21 09:10:01', 1, 880.00, 'confirmed'),
(12, '6R White',      '2025-07-22 18:50:02', 1, 510.00, 'pending'),
(12, '1DZ',           '2025-07-13 21:19:24', 1, 999.00, 'completed'),

-- User 13
(13, '6R Green',      '2025-07-09 03:12:07', 1, 500.00, 'confirmed'),
(13, '6R Black',      '2025-07-19 13:22:18', 1, 500.00, 'pending'),
(13, '6R Vio',        '2025-07-19 13:22:18', 1, 510.00, 'pending'),
(13, '6R2 White',     '2025-07-17 15:18:44', 1, 610.00, 'completed'),

-- User 14
(14, '6 Sunrise 2',   '2025-07-13 08:14:53', 1, 880.00, 'confirmed'),
(14, '6R White',      '2025-07-10 21:44:13', 1, 510.00, 'pending'),
(14, '1DZ',           '2025-07-10 21:44:13', 1, 999.00, 'pending'),
(14, '7R Green',      '2025-07-21 04:59:30', 1, 500.00, 'completed'),

-- User 15
(15, '6 Sunrise Bloom','2025-07-12 09:11:23', 1, 880.00, 'confirmed'),
(15, '6R2 White',     '2025-07-20 10:20:13', 1, 610.00, 'pending'),
(15, '6R Green',      '2025-07-20 10:20:13', 1, 500.00, 'pending'),
(15, '6R Black',      '2025-07-18 08:02:17', 1, 510.00, 'completed'),

-- User 16
(16, '6 Sunrise 2',   '2025-07-13 01:26:17', 1, 880.00, 'confirmed'),
(16, '1DZ',           '2025-07-22 07:47:10', 1, 999.00, 'pending'),
(16, '6R White',      '2025-07-22 07:47:10', 1, 510.00, 'pending'),
(16, '6R Vio',        '2025-07-15 04:00:00', 1, 500.00, 'completed'),

-- User 17
(17, '6 Sunrise Bloom','2025-07-11 15:48:59', 1, 880.00, 'confirmed'),
(17, '6R2 White',     '2025-07-22 13:10:23', 1, 610.00, 'pending'),
(17, '6R White',      '2025-07-13 19:41:22', 1, 510.00, 'completed'),
(17, '6R Black',      '2025-07-13 19:41:22', 1, 510.00, 'completed'),

-- User 18
(18, '6 Sunrise 2',   '2025-07-13 17:18:02', 1, 880.00, 'confirmed'),
(18, '6R Green',      '2025-07-13 17:18:02', 1, 500.00, 'confirmed'),
(18, '1DZ',           '2025-07-10 03:04:58', 1, 999.00, 'pending'),
(18, '6R Vio',        '2025-07-14 10:55:29', 1, 500.00, 'completed'),

-- User 19
(19, '6R2 White',     '2025-07-09 07:43:25', 1, 610.00, 'confirmed'),
(19, '6 Sunrise Bloom','2025-07-21 00:59:19', 1, 880.00, 'pending'),
(19, '6R White',      '2025-07-21 00:59:19', 1, 510.00, 'pending'),
(19, '1DZ',           '2025-07-15 18:05:20', 1, 999.00, 'completed'),

-- User 20
(20, '6R Green',      '2025-07-09 22:23:44', 1, 500.00, 'confirmed'),
(20, '6R Black',      '2025-07-09 22:23:44', 1, 510.00, 'confirmed'),
(20, '6 Sunrise 2',   '2025-07-15 11:36:39', 1, 880.00, 'pending');


INSERT INTO deliveries (
    order_id, scheduled_time, actual_delivery_time, delivery_status, courier_type, plate_number
) VALUES
(1, '2025-07-17 17:29:05', '2025-07-17 19:29:05', 'in_transit', 'Maxim',   'ABC123'),
(2, '2025-07-19 14:45:40', '2025-07-19 17:45:40', 'delivered',  'Motor',   'XYZ789'),
(3, '2025-07-11 16:31:42', '2025-07-11 18:31:42', 'scheduled',  'Move It', 'MNO456'),
(4, '2025-07-10 08:16:53', '2025-07-10 11:16:53', 'delivered',  'Move It', 'JKL321'),
(5, '2025-07-20 19:59:48', '2025-07-20 21:59:48', 'scheduled',  'Maxim',   'QWE987'),
(6, '2025-07-21 06:50:18', '2025-07-21 08:50:18', 'delivered',  'Move It', 'ZXC654'),
(7, '2025-07-20 10:57:13', '2025-07-20 11:57:13', 'delivered',  'Move It', 'RTY321'),
(8, '2025-07-19 20:50:39', '2025-07-20 00:50:39', 'in_transit', 'Motor',   'GHJ852'),
(9, '2025-07-19 12:34:13', '2025-07-19 13:34:13', 'in_transit', 'Motor',   'BNM963'),
(10, '2025-07-13 08:56:55', '2025-07-13 10:56:55', 'in_transit', 'Motor',   'PLM741'),
(11, '2025-07-11 09:30:22', '2025-07-11 11:30:22', 'scheduled',  'Move It', 'LMN654'),
(12, '2025-07-21 15:20:10', '2025-07-21 17:20:10', 'in_transit', 'Motor',   'TYU321'),
(13, '2025-07-18 06:46:33', '2025-07-18 09:46:33', 'delivered',  'Maxim',   'UIO963'),
(14, '2025-07-11 07:15:00', '2025-07-11 09:15:00', 'in_transit', 'Move It', 'GHF852'),
(15, '2025-07-13 18:27:45', '2025-07-13 20:27:45', 'delivered',  'Motor',   'VBN789'),
(16, '2025-07-12 13:48:50', '2025-07-12 15:48:50', 'scheduled',  'Maxim',   'WER456'),
(17, '2025-07-15 10:17:33', '2025-07-15 12:17:33', 'in_transit', 'Move It', 'ASE159'),
(18, '2025-07-14 21:09:18', '2025-07-15 00:09:18', 'delivered',  'Motor',   'KLM741'),
(19, '2025-07-09 09:12:31', '2025-07-09 11:12:31', 'scheduled',  'Move It', 'TRE963'),
(20, '2025-07-11 06:05:27', '2025-07-11 08:05:27', 'delivered',  'Maxim',   'DFG147');