-- TailorEase Smart Tailor Shop Database Schema
-- Compatible with MySQL, MariaDB, phpMyAdmin, and XAMPP

CREATE DATABASE IF NOT EXISTS `tailorease_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tailorease_db`;

-- 1. Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `phone` VARCHAR(20) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('customer', 'admin') DEFAULT 'customer',
  `avatar` VARCHAR(255) DEFAULT 'default_avatar.png',
  `address` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Services Table
CREATE TABLE IF NOT EXISTS `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category` ENUM('men', 'women', 'kids', 'special') NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `est_days` VARCHAR(50) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Fabrics Table
CREATE TABLE IF NOT EXISTS `fabrics` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `price_per_meter` DECIMAL(10, 2) NOT NULL,
  `colors` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `stock_status` ENUM('in_stock', 'low_stock', 'out_of_stock') DEFAULT 'in_stock',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Designs Table
CREATE TABLE IF NOT EXISTS `designs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category` ENUM('men', 'women', 'kids') NOT NULL,
  `feature_type` VARCHAR(50) NOT NULL, -- collar, sleeve, pocket, embroidery, neck, etc.
  `name` VARCHAR(100) NOT NULL,
  `extra_cost` DECIMAL(10, 2) DEFAULT 0.00,
  `image` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Measurements Table
CREATE TABLE IF NOT EXISTS `measurements` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `profile_name` VARCHAR(50) DEFAULT 'My Default Fit',
  `height` VARCHAR(20) DEFAULT NULL,
  `weight` VARCHAR(20) DEFAULT NULL,
  `chest` VARCHAR(20) DEFAULT NULL,
  `waist` VARCHAR(20) DEFAULT NULL,
  `hip` VARCHAR(20) DEFAULT NULL,
  `shoulder` VARCHAR(20) DEFAULT NULL,
  `sleeve` VARCHAR(20) DEFAULT NULL,
  `neck` VARCHAR(20) DEFAULT NULL,
  `wrist` VARCHAR(20) DEFAULT NULL,
  `inseam` VARCHAR(20) DEFAULT NULL,
  `thigh` VARCHAR(20) DEFAULT NULL,
  `calf` VARCHAR(20) DEFAULT NULL,
  `chart_file` VARCHAR(255) DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Staff / Tailors Table
CREATE TABLE IF NOT EXISTS `staff` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `role` VARCHAR(50) NOT NULL,
  `specialization` VARCHAR(100) NOT NULL,
  `experience_years` INT NOT NULL,
  `avatar` VARCHAR(255) NOT NULL,
  `rating` DECIMAL(3, 1) DEFAULT 4.9,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Appointments Table
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `service_type` VARCHAR(100) NOT NULL,
  `fitting_type` ENUM('in_store', 'home_visit') DEFAULT 'in_store',
  `appointment_date` DATE NOT NULL,
  `appointment_time` TIME NOT NULL,
  `tailor_id` INT DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `status` ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tailor_id`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Orders Table
CREATE TABLE IF NOT EXISTS `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_number` VARCHAR(50) NOT NULL UNIQUE,
  `user_id` INT NOT NULL,
  `service_name` VARCHAR(100) NOT NULL,
  `fabric_id` INT DEFAULT NULL,
  `design_options` JSON DEFAULT NULL,
  `custom_measurements` JSON DEFAULT NULL,
  `reference_image` VARCHAR(255) DEFAULT NULL,
  `express_delivery` TINYINT(1) DEFAULT 0,
  `gift_package` TINYINT(1) DEFAULT 0,
  `total_amount` DECIMAL(10, 2) NOT NULL,
  `current_stage` INT DEFAULT 1, -- 1: Order Received, 2: Measurement Confirmed, 3: Fabric Selected, 4: Cutting, 5: Stitching, 6: Quality Check, 7: Ready, 8: Delivered
  `delivery_address` TEXT NOT NULL,
  `payment_status` ENUM('pending', 'paid', 'refunded') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. Order Tracking Log
CREATE TABLE IF NOT EXISTS `order_tracking` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `stage_num` INT NOT NULL,
  `stage_title` VARCHAR(100) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `status` ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 10. Reviews Table
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_name` VARCHAR(100) NOT NULL,
  `user_role` VARCHAR(50) DEFAULT 'Verified Client',
  `user_avatar` VARCHAR(255) NOT NULL,
  `rating` INT DEFAULT 5,
  `comment` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 11. Blogs Table
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `category` VARCHAR(50) NOT NULL,
  `excerpt` TEXT NOT NULL,
  `content` LONGTEXT NOT NULL,
  `author` VARCHAR(100) DEFAULT 'TailorEase Editorial',
  `image` VARCHAR(255) NOT NULL,
  `read_time` VARCHAR(20) DEFAULT '5 min read',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 12. Gallery Table
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(100) NOT NULL,
  `category` ENUM('men', 'women', 'kids', 'wedding', 'traditional', 'western') NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 13. Coupons Table
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `code` VARCHAR(50) NOT NULL UNIQUE,
  `discount_percent` INT NOT NULL,
  `max_discount` DECIMAL(10, 2) NOT NULL,
  `valid_until` DATE NOT NULL,
  `status` ENUM('active', 'expired') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 14. Wishlist Table
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `fabric_id` INT DEFAULT NULL,
  `service_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ===================================================
-- SEED DATA FOR TESTING
-- ===================================================

-- Sample Users (Password is 'password123' hashed with bcrypt)
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `address`) VALUES
(1, 'Admin Master', 'admin@tailorease.com', '+91 98765 43210', '$2y$10$e.wFvS0N1GgZ2o56K.Zzme0cZ514Y1E5.o53YdG/8wYvH6J9g3v7i', 'admin', '100 Luxury Avenue, Suite 400, Chennai, TN'),
(2, 'Anita Sundaram', 'anita@example.com', '+91 98765 11111', '$2y$10$e.wFvS0N1GgZ2o56K.Zzme0cZ514Y1E5.o53YdG/8wYvH6J9g3v7i', 'customer', '42 Rose Garden Street, Coimbatore, TN'),
(3, 'Rajesh Kumar', 'rajesh@example.com', '+91 98765 22222', '$2y$10$e.wFvS0N1GgZ2o56K.Zzme0cZ514Y1E5.o53YdG/8wYvH6J9g3v7i', 'customer', '15 Royal Park Road, Madurai, TN');

-- Sample Staff / Master Tailors
INSERT INTO `staff` (`id`, `name`, `role`, `specialization`, `experience_years`, `avatar`, `rating`) VALUES
(1, 'Master Ramesh', 'Chief Suit Artisan', 'Men Bespoke Suits & Sherwanis', 22, 'tailor_ramesh.jpg', 5.0),
(2, 'Meenakshi Devi', 'Senior Designer', 'Women Bridal & Designer Blouses', 18, 'tailor_meenakshi.jpg', 4.9),
(3, 'Arun Prakash', 'Pattern Master', 'Fit Precision & Alterations', 14, 'tailor_arun.jpg', 4.8);

-- Sample Services
INSERT INTO `services` (`id`, `category`, `title`, `description`, `price`, `est_days`, `image`) VALUES
-- Men
(1, 'men', 'Custom Shirt Stitching', 'Precision slim/regular fit handcrafted shirt with personal monogramming option.', 850.00, '3 Days', 'service_shirt.jpg'),
(2, 'men', 'Bespoke Trouser Stitching', 'Tailored formal trousers with premium lining and custom waist adjustments.', 950.00, '4 Days', 'service_pant.jpg'),
(3, 'men', '3-Piece Designer Suit', 'Italian cut 3-piece suit with canvas chest piece and satin peak lapel.', 6500.00, '7 Days', 'service_suit.jpg'),
(4, 'men', 'Royal Wedding Sherwani', 'Hand-embellished royal sherwani with zari embroidery and custom dupatta.', 12500.00, '10 Days', 'service_sherwani.jpg'),
-- Women
(5, 'women', 'Designer Bridal Blouse', 'Heavy zardosi embroidered saree blouse with padding and custom back cutout.', 2400.00, '5 Days', 'service_blouse.jpg'),
(6, 'women', 'Anarkali Salwar Suit', 'Flared designer Anarkali suit with hand detailing and pleated pants.', 2800.00, '5 Days', 'service_salwar.jpg'),
(7, 'women', 'Bridal Lehenga Choli', 'Custom grand royal lehenga with heavy zardosi work and dual dupattas.', 14500.00, '12 Days', 'service_lehenga.jpg'),
(8, 'women', 'Indo-Western Kurti', 'Modern asymmetrical designer kurti with premium stitch finish.', 1200.00, '3 Days', 'service_kurti.jpg'),
-- Kids & Special
(9, 'kids', 'School & Academy Uniform', 'Durable, breathable uniform stitching with reinforced stitching seams.', 650.00, '2 Days', 'service_uniform.jpg'),
(10, 'special', 'Express Garment Alteration', 'Perfect reshaping, shortening, waist adjustment, and seam strengthening.', 350.00, '24 Hours', 'service_alteration.jpg');

-- Sample Fabrics
INSERT INTO `fabrics` (`id`, `name`, `type`, `price_per_meter`, `colors`, `description`, `image`, `stock_status`) VALUES
(1, 'Egyptian Giza Cotton', 'Cotton', 650.00, '#FFFFFF, #E6E6FA, #1E1E2F, #87CEEB', 'Ultra-breathable 100% long-staple cotton perfect for formal shirts and summer wear.', 'fabric_cotton.jpg', 'in_stock'),
(2, 'Banarasi Raw Silk', 'Silk', 1450.00, '#6A0DAD, #D4AF37, #C0392B, #27AE60', 'Lustrous, pure silk with golden zari weave, perfect for grand wedding attires.', 'fabric_silk.jpg', 'in_stock'),
(3, 'Belgian Pure Linen', 'Linen', 850.00, '#F5F5DC, #D2B48C, #808080, #FFFFFF', 'Classic textured pure linen with high moisture absorption and relaxed luxury drape.', 'fabric_linen.jpg', 'in_stock'),
(4, 'Royal Royal Velvet', 'Velvet', 1200.00, '#4A0033, #0A1128, #1B4D3E', 'Plush, dense velvet fabric ideal for blazers, sherwanis, and winter evening wear.', 'fabric_velvet.jpg', 'in_stock'),
(5, 'Pure Mulberry Satin', 'Satin', 950.00, '#E6E6FA, #FFC0CB, #FFD700', 'Silky smooth high-gloss satin that drapes fluidly for evening gowns and dupattas.', 'fabric_satin.jpg', 'in_stock');

-- Sample Designs
INSERT INTO `designs` (`id`, `category`, `feature_type`, `name`, `extra_cost`, `image`) VALUES
(1, 'men', 'Collar Style', 'French Cutaway Collar', 150.00, 'design_collar_cutaway.jpg'),
(2, 'men', 'Collar Style', 'Mandarin / Bandhgala Collar', 100.00, 'design_collar_mandarin.jpg'),
(3, 'men', 'Sleeve Style', 'French Cuff (Double Cuff)', 200.00, 'design_sleeve_french.jpg'),
(4, 'women', 'Back Neck', 'Deep U Cutout with Dori Tassels', 300.00, 'design_back_dori.jpg'),
(5, 'women', 'Embroidery', 'Hand-Crafted Zardosi Work', 1500.00, 'design_zardosi.jpg');

-- Sample Measurements
INSERT INTO `measurements` (`id`, `user_id`, `profile_name`, `height`, `weight`, `chest`, `waist`, `hip`, `shoulder`, `sleeve`, `neck`, `wrist`, `inseam`, `thigh`, `calf`) VALUES
(1, 2, 'Anita Formal Fit', '165 cm', '58 kg', '36 in', '28 in', '38 in', '15 in', '22 in', '13.5 in', '6 in', '30 in', '22 in', '14 in'),
(2, 3, 'Rajesh Suit Fit', '178 cm', '74 kg', '40 in', '34 in', '41 in', '18 in', '25 in', '15.5 in', '7 in', '32 in', '24 in', '15.5 in');

-- Sample Orders
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `service_name`, `fabric_id`, `total_amount`, `current_stage`, `delivery_address`, `payment_status`, `created_at`) VALUES
(1, 'ORD-2026-8801', 2, 'Designer Bridal Blouse', 2, 3850.00, 5, '42 Rose Garden Street, Coimbatore, TN', 'paid', '2026-07-20 10:30:00'),
(2, 'ORD-2026-8802', 3, '3-Piece Designer Suit', 1, 7800.00, 3, '15 Royal Park Road, Madurai, TN', 'paid', '2026-07-22 14:15:00');

-- Sample Order Tracking Stages for Order #1
INSERT INTO `order_tracking` (`order_id`, `stage_num`, `stage_title`, `description`, `status`) VALUES
(1, 1, 'Order Received', 'Order confirmed and registered in TailorEase system.', 'completed'),
(1, 2, 'Measurement Confirmed', 'Custom measurements verified by Master Ramesh.', 'completed'),
(1, 3, 'Fabric Selected', 'Banarasi Raw Silk allocated from warehouse.', 'completed'),
(1, 4, 'Precision Cutting', 'Pattern cut by Senior Master Designer.', 'completed'),
(1, 5, 'Master Stitching', 'Hand stitching and zardosi work in progress.', 'in_progress'),
(1, 6, 'Quality Check', 'Ironing, seam inspection & fitting validation.', 'pending'),
(1, 7, 'Ready For Delivery', 'Packed in signature luxury gift box.', 'pending'),
(1, 8, 'Delivered', 'Order dispatched to delivery address.', 'pending');

-- Sample Reviews
INSERT INTO `reviews` (`id`, `user_name`, `user_role`, `user_avatar`, `rating`, `comment`) VALUES
(1, 'Dr. Kavitha Raman', 'Verified Bride', 'review_kavitha.jpg', 5, 'TailorEase crafted my wedding lehenga to absolute perfection! The fitting was 100% precise and the glassmorphism visual builder helped me pick the exact back neck design.'),
(2, 'Vikram Chandran', 'Corporate Executive', 'review_vikram.jpg', 5, 'The 3-piece Italian suit fits better than any off-the-rack designer brand. The online measurement form was super clear and order tracking kept me updated at every stage.'),
(3, 'Priya Senthil', 'Fashion Blogger', 'review_priya.jpg', 5, 'Fast delivery, luxury packaging, and incredible craftsmanship! TailorEase is the gold standard for modern bespoke tailoring in South India.');

-- Sample Blogs
INSERT INTO `blogs` (`id`, `title`, `category`, `excerpt`, `content`, `author`, `image`, `read_time`) VALUES
(1, '10 Essential Tips to Care for Pure Silk & Velvet Outfits', 'Fabric Care', 'Learn how to preserve the sheen, color, and texture of your premium raw silk and royal velvet garments for decades.', 'Silk and velvet garments are investments in timeless style...', 'Meenakshi Devi', 'blog_silk_care.jpg', '4 min read'),
(2, 'How to Measure Yourself accurately at Home like a Master Tailor', 'Measurement Guide', 'Follow our step-by-step anatomical guide with a tape measure to get flawless custom stitching results every single time.', 'Achieving bespoke fitting starts with accurate measurements...', 'Master Ramesh', 'blog_measurement_guide.jpg', '6 min read'),
(3, '2026 Bridal Fashion Trends: Zardosi, Pastel Velvets & Cutout Backs', 'Fashion Trends', 'Discover the hottest wedding season color palettes and embroidery trends dominating Indian couture this year.', 'This year fashion shifts towards subtle pastel purples, rich royal violets...', 'Editorial Team', 'blog_trends_2026.jpg', '5 min read');

-- Sample Gallery Items
INSERT INTO `gallery` (`id`, `title`, `category`, `image`, `description`) VALUES
(1, 'Italian Navy 3-Piece Tuxedo', 'men', 'gallery_tuxedo.jpg', 'Hand-canvassed Italian tuxedo with satin peak lapel'),
(2, 'Royal Velvet Zardosi Lehenga', 'wedding', 'gallery_lehenga.jpg', 'Grand royal velvet lehenga with handcrafted antique gold work'),
(3, 'Contemporary Cutout Blouse', 'women', 'gallery_blouse.jpg', 'Modern high-neck blouse with intricate dori cutout back'),
(4, 'Silk Bandhgala Sherwani', 'traditional', 'gallery_sherwani.jpg', 'Banarasi silk Bandhgala with handcrafted brass buttons'),
(5, 'Pastel Silk Party Frock', 'kids', 'gallery_kids.jpg', 'Cute handcrafted silk frock with soft inner lining'),
(6, 'Double-Breasted Blazer', 'western', 'gallery_blazer.jpg', 'Custom houndstooth double-breasted blazer with horn buttons');

-- Sample Coupons
INSERT INTO `coupons` (`id`, `code`, `discount_percent`, `max_discount`, `valid_until`, `status`) VALUES
(1, 'TAILORFIRST15', 15, 1000.00, '2026-12-31', 'active'),
(2, 'ROYALWEDDING', 20, 3500.00, '2026-12-31', 'active');
