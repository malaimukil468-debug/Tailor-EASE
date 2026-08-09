<?php
/**
 * TailorEase - Helper & Utility Functions
 */

require_once __DIR__ . '/../config/db.php';

function sanitize_input($data) {
    if (is_array($data)) {
        return array_map('sanitize_input', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function format_currency($amount) {
    return '₹' . number_format((float)$amount, 2);
}

function get_logged_in_user() {
    if (isset($_SESSION['user_id'])) {
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'] ?? 'Guest User',
            'email' => $_SESSION['user_email'] ?? '',
            'role' => $_SESSION['user_role'] ?? 'customer',
            'avatar' => $_SESSION['user_avatar'] ?? 'default_avatar.png'
        ];
    }
    return null;
}

function is_admin() {
    $user = get_logged_in_user();
    return ($user && $user['role'] === 'admin');
}

/**
 * Fallback dataset helper ensuring the website is 100% operational with or without live MySQL database.
 */
function get_sample_services($category = null) {
    $db = getDB();
    if (!$db->isMock() && $pdo = $db->getConnection()) {
        try {
            if ($category) {
                $stmt = $pdo->prepare("SELECT * FROM services WHERE category = ?");
                $stmt->execute([$category]);
            } else {
                $stmt = $pdo->query("SELECT * FROM services");
            }
            $results = $stmt->fetchAll();
            if (!empty($results)) return $results;
        } catch (Exception $e) {}
    }

    // Static rich sample dataset
    $services = [
        ['id' => 1, 'category' => 'men', 'title' => 'Custom Shirt Stitching', 'description' => 'Precision slim/regular fit handcrafted shirt with personal monogramming.', 'price' => 850.00, 'est_days' => '3 Days', 'image' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=600&auto=format&fit=crop&q=80'],
        ['id' => 2, 'category' => 'men', 'title' => 'Bespoke Trouser Stitching', 'description' => 'Tailored formal trousers with premium lining and waistband adjustment.', 'price' => 950.00, 'est_days' => '4 Days', 'image' => 'https://images.unsplash.com/photo-1479064555552-3ef4979f8908?w=600&auto=format&fit=crop&q=80'],
        ['id' => 3, 'category' => 'men', 'title' => '3-Piece Designer Suit', 'description' => 'Italian cut 3-piece suit with canvas chest piece and peak lapel.', 'price' => 6500.00, 'est_days' => '7 Days', 'image' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600&auto=format&fit=crop&q=80'],
        ['id' => 4, 'category' => 'men', 'title' => 'Royal Wedding Sherwani', 'description' => 'Hand-embellished royal sherwani with zari embroidery and dupatta.', 'price' => 12500.00, 'est_days' => '10 Days', 'image' => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=600&auto=format&fit=crop&q=80'],
        ['id' => 5, 'category' => 'women', 'title' => 'Designer Bridal Blouse', 'description' => 'Heavy zardosi embroidered saree blouse with padding and custom cutout.', 'price' => 2400.00, 'est_days' => '5 Days', 'image' => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=600&auto=format&fit=crop&q=80'],
        ['id' => 6, 'category' => 'women', 'title' => 'Anarkali Salwar Suit', 'description' => 'Flared designer Anarkali suit with hand detailing and pleated pants.', 'price' => 2800.00, 'est_days' => '5 Days', 'image' => 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=600&auto=format&fit=crop&q=80'],
        ['id' => 7, 'category' => 'women', 'title' => 'Bridal Lehenga Choli', 'description' => 'Custom grand royal lehenga with heavy zardosi work and dual dupattas.', 'price' => 14500.00, 'est_days' => '12 Days', 'image' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'],
        ['id' => 8, 'category' => 'women', 'title' => 'Indo-Western Kurti', 'description' => 'Modern asymmetrical designer kurti with premium stitch finish.', 'price' => 1200.00, 'est_days' => '3 Days', 'image' => 'https://images.unsplash.com/photo-1583391733975-01e4df6063b4?w=600&auto=format&fit=crop&q=80'],
        ['id' => 9, 'category' => 'kids', 'title' => 'School & Academy Uniform', 'description' => 'Durable, breathable uniform stitching with reinforced stitching seams.', 'price' => 650.00, 'est_days' => '2 Days', 'image' => 'https://images.unsplash.com/photo-1518831959646-742c3a14ebf7?w=600&auto=format&fit=crop&q=80'],
        ['id' => 10, 'category' => 'special', 'title' => 'Express Garment Alteration', 'description' => 'Reshaping, shortening, waist adjustment, and seam strengthening.', 'price' => 350.00, 'est_days' => '24 Hours', 'image' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=600&auto=format&fit=crop&q=80']
    ];

    if ($category) {
        return array_values(array_filter($services, function($s) use ($category) {
            return $s['category'] === $category;
        }));
    }
    return $services;
}

function get_sample_fabrics() {
    return [
        ['id' => 1, 'name' => 'Egyptian Giza Cotton', 'type' => 'Cotton', 'price_per_meter' => 650.00, 'colors' => '#FFFFFF, #E6E6FA, #1E1E2F, #87CEEB', 'description' => 'Ultra-breathable 100% long-staple cotton perfect for formal shirts.', 'image' => 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=600&auto=format&fit=crop&q=80', 'stock_status' => 'in_stock'],
        ['id' => 2, 'name' => 'Banarasi Raw Silk', 'type' => 'Silk', 'price_per_meter' => 1450.00, 'colors' => '#6A0DAD, #D4AF37, #C0392B, #27AE60', 'description' => 'Lustrous, pure silk with golden zari weave for grand attires.', 'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=600&auto=format&fit=crop&q=80', 'stock_status' => 'in_stock'],
        ['id' => 3, 'name' => 'Belgian Pure Linen', 'type' => 'Linen', 'price_per_meter' => 850.00, 'colors' => '#F5F5DC, #D2B48C, #808080, #FFFFFF', 'description' => 'Classic textured pure linen with high moisture absorption.', 'image' => 'https://images.unsplash.com/photo-1528459801416-a9e53bbf4e17?w=600&auto=format&fit=crop&q=80', 'stock_status' => 'in_stock'],
        ['id' => 4, 'name' => 'Royal Velvet', 'type' => 'Velvet', 'price_per_meter' => 1200.00, 'colors' => '#4A0033, #0A1128, #1B4D3E', 'description' => 'Plush, dense velvet fabric ideal for blazers and sherwanis.', 'image' => 'https://images.unsplash.com/photo-1563170351-be82bc888aa4?w=600&auto=format&fit=crop&q=80', 'stock_status' => 'in_stock'],
        ['id' => 5, 'name' => 'Pure Mulberry Satin', 'type' => 'Satin', 'price_per_meter' => 950.00, 'colors' => '#E6E6FA, #FFC0CB, #FFD700', 'description' => 'Silky smooth high-gloss satin that drapes fluidly.', 'image' => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?w=600&auto=format&fit=crop&q=80', 'stock_status' => 'in_stock']
    ];
}

function get_sample_tailors() {
    return [
        ['id' => 1, 'name' => 'Master Ramesh', 'role' => 'Chief Suit Artisan', 'specialization' => 'Men Bespoke Suits & Sherwanis', 'experience_years' => 22, 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&auto=format&fit=crop&q=80', 'rating' => 5.0],
        ['id' => 2, 'name' => 'Meenakshi Devi', 'role' => 'Senior Designer', 'specialization' => 'Women Bridal & Designer Blouses', 'experience_years' => 18, 'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&auto=format&fit=crop&q=80', 'rating' => 4.9],
        ['id' => 3, 'name' => 'Arun Prakash', 'role' => 'Pattern Master', 'specialization' => 'Fit Precision & Alterations', 'experience_years' => 14, 'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&auto=format&fit=crop&q=80', 'rating' => 4.8]
    ];
}
