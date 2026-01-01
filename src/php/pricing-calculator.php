<?php
/**
 * RV WEB CREATIONS - PRICING CALCULATOR
 * Calculate project pricing based on intake data and pricing structure
 */

session_start();

// Simple authentication check
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin-dashboard.php');
    exit;
}

// Database connection
define('DB_HOST', 'localhost');
define('DB_NAME', 'rv_web_creations');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// ═══════════════════════════════════════════════════════
// PRICING STRUCTURE (Based on your pricing spreadsheet)
// ═══════════════════════════════════════════════════════

$BASE_PACKAGES = [
    'starter' => [
        'name' => 'Starter Site',
        'min_price' => 2500,
        'max_price' => 6000,
        'default_price' => 3500,
        'description' => '1-5 pages, basic features, 2-4 week timeline',
        'includes' => ['Responsive Design', 'Contact Form', 'Basic SEO', 'Mobile Optimization']
    ],
    'growth' => [
        'name' => 'Growth Site',
        'min_price' => 7500,
        'max_price' => 12000,
        'default_price' => 9000,
        'description' => '6-15 pages, advanced features, 4-8 week timeline',
        'includes' => ['Everything in Starter', 'Advanced SEO', 'Analytics Setup', 'Content Strategy', 'Social Integration']
    ],
    'growth_advanced' => [
        'name' => 'Growth Site - Advanced',
        'min_price' => 12000,
        'max_price' => 18000,
        'default_price' => 15000,
        'description' => '16+ pages, complex features, 8-12 week timeline',
        'includes' => ['Everything in Growth', 'Custom Functionality', 'E-commerce', 'Advanced Integrations', 'Priority Support']
    ],
    'custom' => [
        'name' => 'Custom/Enterprise',
        'min_price' => 18000,
        'max_price' => 50000,
        'default_price' => 25000,
        'description' => 'Custom scope, enterprise features, 12+ week timeline',
        'includes' => ['Fully Custom Solution', 'Dedicated Project Manager', 'Advanced Security', 'Scalable Architecture']
    ]
];

$ADD_ONS = [
    // Content & Copywriting
    'copywriting_basic' => ['name' => 'Basic Copywriting (3-5 pages)', 'price' => 500],
    'copywriting_full' => ['name' => 'Full Website Copywriting (6-15 pages)', 'price' => 1500],
    'copywriting_advanced' => ['name' => 'Advanced Copywriting (16+ pages)', 'price' => 3000],
    'content_migration' => ['name' => 'Content Migration from Existing Site', 'price' => 800],
    
    // E-commerce
    'ecommerce_basic' => ['name' => 'Basic E-commerce (up to 25 products)', 'price' => 2000],
    'ecommerce_standard' => ['name' => 'Standard E-commerce (26-100 products)', 'price' => 3500],
    'ecommerce_advanced' => ['name' => 'Advanced E-commerce (100+ products)', 'price' => 5000],
    'payment_gateway' => ['name' => 'Additional Payment Gateway Integration', 'price' => 500],
    
    // Features
    'booking_system' => ['name' => 'Booking/Scheduling System', 'price' => 1500],
    'member_portal' => ['name' => 'Member Login/Portal', 'price' => 2000],
    'custom_forms' => ['name' => 'Custom Forms & Calculators', 'price' => 800],
    'blog_setup' => ['name' => 'Blog Setup & Training', 'price' => 500],
    'email_marketing' => ['name' => 'Email Marketing Integration', 'price' => 600],
    'crm_integration' => ['name' => 'CRM Integration', 'price' => 1000],
    'api_integration' => ['name' => 'Custom API Integration', 'price' => 1500],
    
    // Design
    'custom_graphics' => ['name' => 'Custom Graphics & Illustrations (per set)', 'price' => 800],
    'photography' => ['name' => 'Professional Photography Coordination', 'price' => 500],
    'video_integration' => ['name' => 'Video Integration & Optimization', 'price' => 400],
    
    // Advanced
    'multilingual' => ['name' => 'Multi-language Support', 'price' => 2000],
    'advanced_seo' => ['name' => 'Advanced SEO Package', 'price' => 1200],
    'accessibility' => ['name' => 'WCAG Accessibility Compliance', 'price' => 1500],
    'performance_optimization' => ['name' => 'Advanced Performance Optimization', 'price' => 800],
    
    // Timeline
    'rush_2weeks' => ['name' => 'Rush Delivery (50% faster)', 'price' => 0, 'percentage' => 25],
    'rush_1week' => ['name' => 'Urgent Rush (2 weeks or less)', 'price' => 0, 'percentage' => 50],
];

$DISCOUNTS = [
    'nonprofit' => ['name' => 'Nonprofit Organization', 'percentage' => 15],
    'referral' => ['name' => 'Referral Discount', 'percentage' => 10],
    'upfront_payment' => ['name' => 'Full Upfront Payment', 'percentage' => 5],
];

// ═══════════════════════════════════════════════════════
// GET INTAKE DATA IF ID PROVIDED
// ═══════════════════════════════════════════════════════
$intake = null;
$intake_id = $_GET['intake_id'] ?? null;

if ($intake_id) {
    $stmt = $pdo->prepare("SELECT * FROM project_intakes WHERE id = ?");
    $stmt->execute([$intake_id]);
    $intake = $stmt->fetch();
}

// ═══════════════════════════════════════════════════════
// HANDLE CALCULATION
// ═══════════════════════════════════════════════════════
$calculation = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calculate'])) {
    $base_package = $_POST['base_package'] ?? 'starter';
    $base_price = floatval($_POST['base_price'] ?? $BASE_PACKAGES[$base_package]['default_price']);
    
    // Calculate add-ons
    $selected_addons = $_POST['addons'] ?? [];
    $addons_total = 0;
    $addons_list = [];
    
    foreach ($selected_addons as $addon_key) {
        if (isset($ADD_ONS[$addon_key])) {
            $addon = $ADD_ONS[$addon_key];
            if (isset($addon['percentage'])) {
                // Percentage-based add-on (like rush fees)
                $addon_cost = $base_price * ($addon['percentage'] / 100);
            } else {
                $addon_cost = $addon['price'];
            }
            $addons_total += $addon_cost;
            $addons_list[] = [
                'name' => $addon['name'],
                'cost' => $addon_cost
            ];
        }
    }
    
    // Subtotal before discounts
    $subtotal = $base_price + $addons_total;
    
    // Calculate discounts
    $selected_discounts = $_POST['discounts'] ?? [];
    $discount_total = 0;
    $discounts_list = [];
    
    foreach ($selected_discounts as $discount_key) {
        if (isset($DISCOUNTS[$discount_key])) {
            $discount = $DISCOUNTS[$discount_key];
            $discount_amount = $subtotal * ($discount['percentage'] / 100);
            $discount_total += $discount_amount;
            $discounts_list[] = [
                'name' => $discount['name'],
                'percentage' => $discount['percentage'],
                'amount' => $discount_amount
            ];
        }
    }
    
    // Final total
    $final_total = $subtotal - $discount_total;
    
    // Payment schedule
    $payment_preference = $_POST['payment_preference'] ?? 'standard';
    
    if ($payment_preference === 'upfront') {
        $payment_schedule = [
            ['name' => 'Full Payment (Upfront)', 'amount' => $final_total, 'due' => 'At contract signing']
        ];
    } elseif ($payment_preference === 'milestone') {
        $num_milestones = intval($_POST['num_milestones'] ?? 4);
        $milestone_amount = $final_total / $num_milestones;
        $payment_schedule = [];
        for ($i = 1; $i <= $num_milestones; $i++) {
            $payment_schedule[] = [
                'name' => "Milestone {$i} Payment",
                'amount' => $milestone_amount,
                'due' => "Upon milestone {$i} completion"
            ];
        }
    } else {
        // Standard 50/25/25
        $payment_schedule = [
            ['name' => 'Deposit (50%)', 'amount' => $final_total * 0.5, 'due' => 'At contract signing'],
            ['name' => 'Midpoint (25%)', 'amount' => $final_total * 0.25, 'due' => 'At project midpoint'],
            ['name' => 'Final Payment (25%)', 'amount' => $final_total * 0.25, 'due' => 'Upon project completion']
        ];
    }
    
    $calculation = [
        'base_package' => $BASE_PACKAGES[$base_package]['name'],
        'base_price' => $base_price,
        'addons_list' => $addons_list,
        'addons_total' => $addons_total,
        'subtotal' => $subtotal,
        'discounts_list' => $discounts_list,
        'discount_total' => $discount_total,
        'final_total' => $final_total,
        'payment_schedule' => $payment_schedule
    ];
    
    // Save to database if intake_id provided
    if ($intake_id) {
        $stmt = $pdo->prepare("UPDATE project_intakes SET estimated_value = ? WHERE id = ?");
        $stmt->execute([$final_total, $intake_id]);
    }
}

// Auto-suggest package based on budget
$suggested_package = 'starter';
if ($intake) {
    $budget = $intake['budget'];
    if (strpos($budget, '$18,000') !== false) {
        $suggested_package = 'custom';
    } elseif (strpos($budget, '$12,000') !== false) {
        $suggested_package = 'growth_advanced';
    } elseif (strpos($budget, '$7,500') !== false) {
        $suggested_package = 'growth';
    }
}

// Auto-suggest add-ons based on intake data
$suggested_addons = [];
if ($intake) {
    // Content needs
    if ($intake['content_status'] === 'Need help creating some content') {
        $suggested_addons[] = 'copywriting_basic';
    } elseif ($intake['content_status'] === 'Need full copywriting services') {
        $suggested_addons[] = 'copywriting_full';
    }
    
    // Migration
    if ($intake['existing_website'] === 'Yes') {
        $suggested_addons[] = 'content_migration';
    }
    
    // Features from the features field
    $features = strtolower($intake['features'] ?? '');
    if (strpos($features, 'ecommerce') !== false || strpos($features, 'e-commerce') !== false || strpos($features, 'shop') !== false) {
        $suggested_addons[] = 'ecommerce_basic';
    }
    if (strpos($features, 'booking') !== false || strpos($features, 'appointment') !== false) {
        $suggested_addons[] = 'booking_system';
    }
    if (strpos($features, 'member') !== false || strpos($features, 'login') !== false) {
        $suggested_addons[] = 'member_portal';
    }
    if (strpos($features, 'blog') !== false) {
        $suggested_addons[] = 'blog_setup';
    }
    
    // Timeline rush
    if ($intake['timeline'] === 'As soon as possible' || $intake['urgency'] >= 8) {
        $suggested_addons[] = 'rush_2weeks';
    }
}

// Auto-suggest discounts
$suggested_discounts = [];
if ($intake) {
    if ($intake['nonprofit_status'] === 'Yes') {
        $suggested_discounts[] = 'nonprofit';
    }
    if ($intake['referral_name']) {
        $suggested_discounts[] = 'referral';
    }
    if ($intake['payment_preference'] === 'Full upfront payment (5% discount)') {
        $suggested_discounts[] = 'upfront_payment';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pricing Calculator - RV Web Creations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .package-card {
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid transparent;
        }
        .package-card:hover {
            border-color: #1f4f7b;
            transform: translateY(-2px);
        }
        .package-card.selected {
            border-color: #1f4f7b;
            background-color: #f0f7ff;
        }
        .addon-item {
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            margin-bottom: 0.5rem;
            transition: background-color 0.2s;
        }
        .addon-item:hover {
            background-color: #f8f9fa;
        }
        .addon-item input[type="checkbox"] {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.75rem;
        }
        .suggested {
            border: 2px solid #ffc107 !important;
            background-color: #fff9e6;
        }
        .suggested-badge {
            position: absolute;
            top: -10px;
            right: 10px;
            background: #ffc107;
            color: #000;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
        }
        .calculation-result {
            position: sticky;
            top: 20px;
        }
        .price-slider {
            width: 100%;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="admin-dashboard.php" class="navbar-brand">
                <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                    <rect width="40" height="40" rx="8" fill="#1f4f7b"/>
                    <path d="M10 28V12H14C15.5 12 16.5 12.3 17.5 13C18.5 13.7 19 14.8 19 16.2C19 17 18.8 17.7 18.4 18.3C18 18.9 17.4 19.3 16.6 19.5L19.5 28H16.5L13.8 20H12.5V28H10ZM12.5 18H14C14.8 18 15.4 17.8 15.8 17.4C16.2 17 16.4 16.4 16.4 15.7C16.4 15 16.2 14.5 15.8 14.1C15.4 13.7 14.8 13.5 14 13.5H12.5V18Z" fill="#f8b400"/>
                    <path d="M23 12L26.5 28H29L32.5 12H30L27.75 23L25.5 12H23Z" fill="white"/>
                </svg>
                Pricing Calculator
            </a>
            <a href="admin-dashboard.php" class="btn btn-sm btn-outline-light">← Back to Dashboard</a>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <?php if ($intake): ?>
            <div class="alert alert-info">
                <strong>Calculating for:</strong> <?php echo htmlspecialchars($intake['company_name']); ?> 
                (Intake #<?php echo $intake['id']; ?>)
                - Budget: <?php echo htmlspecialchars($intake['budget']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" id="pricingForm">
            <div class="row">
                <!-- Left Column - Configuration -->
                <div class="col-lg-8">
                    <!-- Base Package Selection -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">1. Select Base Package</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <?php foreach ($BASE_PACKAGES as $key => $package): ?>
                                    <div class="col-md-6">
                                        <div class="package-card card h-100 <?php echo ($key === $suggested_package) ? 'suggested' : ''; ?>" 
                                             onclick="selectPackage('<?php echo $key; ?>')">
                                            <?php if ($key === $suggested_package): ?>
                                                <span class="suggested-badge">Recommended</span>
                                            <?php endif; ?>
                                            <div class="card-body">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="base_package" 
                                                           id="package_<?php echo $key; ?>" value="<?php echo $key; ?>"
                                                           <?php echo ($key === $suggested_package) ? 'checked' : ''; ?>
                                                           data-min="<?php echo $package['min_price']; ?>"
                                                           data-max="<?php echo $package['max_price']; ?>"
                                                           data-default="<?php echo $package['default_price']; ?>">
                                                    <label class="form-check-label w-100" for="package_<?php echo $key; ?>">
                                                        <h6 class="mb-2"><?php echo $package['name']; ?></h6>
                                                        <p class="text-muted small mb-2"><?php echo $package['description']; ?></p>
                                                        <p class="mb-2"><strong>$<?php echo number_format($package['min_price']); ?> - $<?php echo number_format($package['max_price']); ?></strong></p>
                                                        <ul class="small mb-0">
                                                            <?php foreach ($package['includes'] as $feature): ?>
                                                                <li><?php echo $feature; ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="mt-4">
                                <label class="form-label">Adjust Base Price: <strong id="basePriceDisplay">$<?php echo number_format($BASE_PACKAGES[$suggested_package]['default_price']); ?></strong></label>
                                <input type="range" class="form-range price-slider" name="base_price" id="basePriceSlider"
                                       min="<?php echo $BASE_PACKAGES[$suggested_package]['min_price']; ?>"
                                       max="<?php echo $BASE_PACKAGES[$suggested_package]['max_price']; ?>"
                                       value="<?php echo $BASE_PACKAGES[$suggested_package]['default_price']; ?>"
                                       step="100">
                                <div class="d-flex justify-content-between small text-muted">
                                    <span id="minPrice">$<?php echo number_format($BASE_PACKAGES[$suggested_package]['min_price']); ?></span>
                                    <span id="maxPrice">$<?php echo number_format($BASE_PACKAGES[$suggested_package]['max_price']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add-ons Selection -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">2. Select Add-ons</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="border-bottom pb-2">Content & Copywriting</h6>
                            <div class="mb-3">
                                <?php 
                                $content_addons = ['copywriting_basic', 'copywriting_full', 'copywriting_advanced', 'content_migration'];
                                foreach ($content_addons as $addon_key): 
                                    if (isset($ADD_ONS[$addon_key])):
                                        $addon = $ADD_ONS[$addon_key];
                                        $is_suggested = in_array($addon_key, $suggested_addons);
                                ?>
                                    <div class="addon-item <?php echo $is_suggested ? 'suggested' : ''; ?>">
                                        <input type="checkbox" name="addons[]" value="<?php echo $addon_key; ?>" 
                                               id="addon_<?php echo $addon_key; ?>" class="addon-checkbox"
                                               data-price="<?php echo $addon['price']; ?>"
                                               <?php echo $is_suggested ? 'checked' : ''; ?>>
                                        <label for="addon_<?php echo $addon_key; ?>">
                                            <?php echo $addon['name']; ?> - <strong>$<?php echo number_format($addon['price']); ?></strong>
                                            <?php if ($is_suggested): ?><span class="badge bg-warning text-dark ms-2">Suggested</span><?php endif; ?>
                                        </label>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>

                            <h6 class="border-bottom pb-2 mt-4">E-commerce</h6>
                            <div class="mb-3">
                                <?php 
                                $ecommerce_addons = ['ecommerce_basic', 'ecommerce_standard', 'ecommerce_advanced', 'payment_gateway'];
                                foreach ($ecommerce_addons as $addon_key): 
                                    if (isset($ADD_ONS[$addon_key])):
                                        $addon = $ADD_ONS[$addon_key];
                                        $is_suggested = in_array($addon_key, $suggested_addons);
                                ?>
                                    <div class="addon-item <?php echo $is_suggested ? 'suggested' : ''; ?>">
                                        <input type="checkbox" name="addons[]" value="<?php echo $addon_key; ?>" 
                                               id="addon_<?php echo $addon_key; ?>" class="addon-checkbox"
                                               data-price="<?php echo $addon['price']; ?>"
                                               <?php echo $is_suggested ? 'checked' : ''; ?>>
                                        <label for="addon_<?php echo $addon_key; ?>">
                                            <?php echo $addon['name']; ?> - <strong>$<?php echo number_format($addon['price']); ?></strong>
                                            <?php if ($is_suggested): ?><span class="badge bg-warning text-dark ms-2">Suggested</span><?php endif; ?>
                                        </label>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>

                            <h6 class="border-bottom pb-2 mt-4">Features & Integrations</h6>
                            <div class="mb-3">
                                <?php 
                                $feature_addons = ['booking_system', 'member_portal', 'custom_forms', 'blog_setup', 'email_marketing', 'crm_integration', 'api_integration'];
                                foreach ($feature_addons as $addon_key): 
                                    if (isset($ADD_ONS[$addon_key])):
                                        $addon = $ADD_ONS[$addon_key];
                                        $is_suggested = in_array($addon_key, $suggested_addons);
                                ?>
                                    <div class="addon-item <?php echo $is_suggested ? 'suggested' : ''; ?>">
                                        <input type="checkbox" name="addons[]" value="<?php echo $addon_key; ?>" 
                                               id="addon_<?php echo $addon_key; ?>" class="addon-checkbox"
                                               data-price="<?php echo $addon['price']; ?>"
                                               <?php echo $is_suggested ? 'checked' : ''; ?>>
                                        <label for="addon_<?php echo $addon_key; ?>">
                                            <?php echo $addon['name']; ?> - <strong>$<?php echo number_format($addon['price']); ?></strong>
                                            <?php if ($is_suggested): ?><span class="badge bg-warning text-dark ms-2">Suggested</span><?php endif; ?>
                                        </label>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>

                            <h6 class="border-bottom pb-2 mt-4">Design & Media</h6>
                            <div class="mb-3">
                                <?php 
                                $design_addons = ['custom_graphics', 'photography', 'video_integration'];
                                foreach ($design_addons as $addon_key): 
                                    if (isset($ADD_ONS[$addon_key])):
                                        $addon = $ADD_ONS[$addon_key];
                                ?>
                                    <div class="addon-item">
                                        <input type="checkbox" name="addons[]" value="<?php echo $addon_key; ?>" 
                                               id="addon_<?php echo $addon_key; ?>" class="addon-checkbox"
                                               data-price="<?php echo $addon['price']; ?>">
                                        <label for="addon_<?php echo $addon_key; ?>">
                                            <?php echo $addon['name']; ?> - <strong>$<?php echo number_format($addon['price']); ?></strong>
                                        </label>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>

                            <h6 class="border-bottom pb-2 mt-4">Advanced Options</h6>
                            <div class="mb-3">
                                <?php 
                                $advanced_addons = ['multilingual', 'advanced_seo', 'accessibility', 'performance_optimization'];
                                foreach ($advanced_addons as $addon_key): 
                                    if (isset($ADD_ONS[$addon_key])):
                                        $addon = $ADD_ONS[$addon_key];
                                ?>
                                    <div class="addon-item">
                                        <input type="checkbox" name="addons[]" value="<?php echo $addon_key; ?>" 
                                               id="addon_<?php echo $addon_key; ?>" class="addon-checkbox"
                                               data-price="<?php echo $addon['price']; ?>">
                                        <label for="addon_<?php echo $addon_key; ?>">
                                            <?php echo $addon['name']; ?> - <strong>$<?php echo number_format($addon['price']); ?></strong>
                                        </label>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>

                            <h6 class="border-bottom pb-2 mt-4">Timeline Adjustments</h6>
                            <div class="mb-3">
                                <?php 
                                $timeline_addons = ['rush_2weeks', 'rush_1week'];
                                foreach ($timeline_addons as $addon_key): 
                                    if (isset($ADD_ONS[$addon_key])):
                                        $addon = $ADD_ONS[$addon_key];
                                        $is_suggested = in_array($addon_key, $suggested_addons);
                                ?>
                                    <div class="addon-item <?php echo $is_suggested ? 'suggested' : ''; ?>">
                                        <input type="checkbox" name="addons[]" value="<?php echo $addon_key; ?>" 
                                               id="addon_<?php echo $addon_key; ?>" class="addon-checkbox rush-addon"
                                               data-percentage="<?php echo $addon['percentage']; ?>"
                                               <?php echo $is_suggested ? 'checked' : ''; ?>>
                                        <label for="addon_<?php echo $addon_key; ?>">
                                            <?php echo $addon['name']; ?> - <strong>+<?php echo $addon['percentage']; ?>%</strong>
                                            <?php if ($is_suggested): ?><span class="badge bg-warning text-dark ms-2">Suggested</span><?php endif; ?>
                                        </label>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Discounts -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">3. Apply Discounts</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach ($DISCOUNTS as $key => $discount): 
                                $is_suggested = in_array($key, $suggested_discounts);
                            ?>
                                <div class="addon-item <?php echo $is_suggested ? 'suggested' : ''; ?>">
                                    <input type="checkbox" name="discounts[]" value="<?php echo $key; ?>" 
                                           id="discount_<?php echo $key; ?>" class="addon-checkbox"
                                           <?php echo $is_suggested ? 'checked' : ''; ?>>
                                    <label for="discount_<?php echo $key; ?>">
                                        <?php echo $discount['name']; ?> - <strong>-<?php echo $discount['percentage']; ?>%</strong>
                                        <?php if ($is_suggested): ?><span class="badge bg-warning text-dark ms-2">Eligible</span><?php endif; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Payment Schedule -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">4. Payment Schedule</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_preference" id="payment_standard" value="standard" 
                                           <?php echo (!$intake || $intake['payment_preference'] === 'Standard (50% deposit, 25% midpoint, 25% final)') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="payment_standard">
                                        <strong>Standard (50/25/25)</strong> - 50% deposit, 25% midpoint, 25% final
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_preference" id="payment_upfront" value="upfront"
                                           <?php echo ($intake && $intake['payment_preference'] === 'Full upfront payment (5% discount)') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="payment_upfront">
                                        <strong>Full Upfront</strong> - Single payment at contract signing
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_preference" id="payment_milestone" value="milestone"
                                           <?php echo ($intake && $intake['payment_preference'] === 'Milestone-based payments') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="payment_milestone">
                                        <strong>Milestone-Based</strong> - Equal payments at project milestones
                                    </label>
                                </div>
                                <div id="milestoneOptions" class="mt-3" style="display: none;">
                                    <label class="form-label">Number of Milestones:</label>
                                    <select name="num_milestones" class="form-select">
                                        <option value="2">2 milestones</option>
                                        <option value="3">3 milestones</option>
                                        <option value="4" selected>4 milestones</option>
                                        <option value="5">5 milestones</option>
                                        <option value="6">6 milestones</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="calculate" class="btn btn-primary btn-lg">Calculate Pricing</button>
                    </div>
                </div>

                <!-- Right Column - Live Calculation Preview -->
                <div class="col-lg-4">
                    <div class="calculation-result">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Pricing Summary</h5>
                            </div>
                            <div class="card-body">
                                <div id="liveCalculation">
                                    <p class="text-muted text-center py-4">Click "Calculate Pricing" to see results</p>
                                </div>
                            </div>
                        </div>

                        <?php if ($calculation): ?>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Detailed Breakdown</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm mb-0">
                                        <tr>
                                            <td><strong><?php echo $calculation['base_package']; ?></strong></td>
                                            <td class="text-end"><strong>$<?php echo number_format($calculation['base_price'], 2); ?></strong></td>
                                        </tr>
                                        <?php if (!empty($calculation['addons_list'])): ?>
                                            <tr><td colspan="2" class="pt-3"><strong>Add-ons:</strong></td></tr>
                                            <?php foreach ($calculation['addons_list'] as $addon): ?>
                                                <tr>
                                                    <td class="small ps-3"><?php echo $addon['name']; ?></td>
                                                    <td class="text-end small">$<?php echo number_format($addon['cost'], 2); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <tr class="border-top">
                                            <td><strong>Subtotal:</strong></td>
                                            <td class="text-end"><strong>$<?php echo number_format($calculation['subtotal'], 2); ?></strong></td>
                                        </tr>
                                        <?php if (!empty($calculation['discounts_list'])): ?>
                                            <tr><td colspan="2" class="pt-2"><strong>Discounts:</strong></td></tr>
                                            <?php foreach ($calculation['discounts_list'] as $discount): ?>
                                                <tr>
                                                    <td class="small ps-3 text-success"><?php echo $discount['name']; ?> (-<?php echo $discount['percentage']; ?>%)</td>
                                                    <td class="text-end small text-success">-$<?php echo number_format($discount['amount'], 2); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <tr class="border-top">
                                            <td><h5 class="mb-0">Final Total:</h5></td>
                                            <td class="text-end"><h5 class="mb-0 text-primary">$<?php echo number_format($calculation['final_total'], 2); ?></h5></td>
                                        </tr>
                                    </table>

                                    <hr>

                                    <h6 class="mb-3">Payment Schedule:</h6>
                                    <?php foreach ($calculation['payment_schedule'] as $payment): ?>
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between">
                                                <span class="small"><strong><?php echo $payment['name']; ?></strong></span>
                                                <span class="small"><strong>$<?php echo number_format($payment['amount'], 2); ?></strong></span>
                                            </div>
                                            <div class="small text-muted"><?php echo $payment['due']; ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Package selection
        function selectPackage(packageKey) {
            document.getElementById('package_' + packageKey).checked = true;
            updatePriceSlider();
            
            // Update visual selection
            document.querySelectorAll('.package-card').forEach(card => {
                card.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
        }

        // Update price slider based on selected package
        function updatePriceSlider() {
            const selectedPackage = document.querySelector('input[name="base_package"]:checked');
            if (selectedPackage) {
                const min = parseFloat(selectedPackage.dataset.min);
                const max = parseFloat(selectedPackage.dataset.max);
                const defaultPrice = parseFloat(selectedPackage.dataset.default);
                
                const slider = document.getElementById('basePriceSlider');
                slider.min = min;
                slider.max = max;
                slider.value = defaultPrice;
                
                document.getElementById('minPrice').textContent = '$' + min.toLocaleString();
                document.getElementById('maxPrice').textContent = '$' + max.toLocaleString();
                document.getElementById('basePriceDisplay').textContent = '$' + defaultPrice.toLocaleString();
            }
        }

        // Update base price display when slider moves
        document.getElementById('basePriceSlider').addEventListener('input', function() {
            document.getElementById('basePriceDisplay').textContent = '$' + parseFloat(this.value).toLocaleString();
        });

        // Show/hide milestone options
        document.querySelectorAll('input[name="payment_preference"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('milestoneOptions').style.display = 
                    this.value === 'milestone' ? 'block' : 'none';
            });
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updatePriceSlider();
            
            // Set initial milestone visibility
            const milestoneRadio = document.getElementById('payment_milestone');
            if (milestoneRadio && milestoneRadio.checked) {
                document.getElementById('milestoneOptions').style.display = 'block';
            }
        });
    </script>
</body>
</html>
