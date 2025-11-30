<?php
// Project Intake Form Handler for RV Web Creations
// This processes the detailed project intake form submissions

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set content type to JSON
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// ═══════════════════════════════════════════════════════
// DATABASE CONFIGURATION
// ═══════════════════════════════════════════════════════
// Update these with your database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'rv_web_creations');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');

// Connect to database
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    // Log error but don't expose details to client
    error_log("Database connection failed: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'System error. Please try again or email info@rvwebcreations.com']);
    exit;
}

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Function to handle checkbox arrays
function sanitizeArray($array) {
    if (!is_array($array)) {
        return '';
    }
    return implode(', ', array_map('sanitizeInput', $array));
}

// Collect and sanitize all form data
$companyName = sanitizeInput($_POST['companyName'] ?? '');
$contactPerson = sanitizeInput($_POST['contactPerson'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$preferredCommunication = sanitizeArray($_POST['preferredCommunication'] ?? []);
$preferredCommunicationOther = sanitizeInput($_POST['preferredCommunicationOther'] ?? '');
$currentWebsite = sanitizeInput($_POST['currentWebsite'] ?? '');
$businessAddress = sanitizeInput($_POST['businessAddress'] ?? '');

$businessDescription = sanitizeInput($_POST['businessDescription'] ?? '');
$websiteGoals = sanitizeArray($_POST['websiteGoals'] ?? []);
$websiteGoalsOther = sanitizeInput($_POST['websiteGoalsOther'] ?? '');
$primaryAction = sanitizeInput($_POST['primaryAction'] ?? '');
$businessPriorities = sanitizeInput($_POST['businessPriorities'] ?? '');

$idealCustomer = sanitizeInput($_POST['idealCustomer'] ?? '');
$multipleAudiences = sanitizeInput($_POST['multipleAudiences'] ?? '');
$audienceProblems = sanitizeInput($_POST['audienceProblems'] ?? '');

$brandingStatus = sanitizeInput($_POST['brandingStatus'] ?? '');
$brandingAssets = sanitizeInput($_POST['brandingAssets'] ?? '');
$brandPersonality = sanitizeArray($_POST['brandPersonality'] ?? []);
$brandPersonalityOther = sanitizeInput($_POST['brandPersonalityOther'] ?? '');

$contentStatus = sanitizeInput($_POST['contentStatus'] ?? '');
$imagesOptions = sanitizeArray($_POST['imagesOptions'] ?? []);
$pages = sanitizeArray($_POST['pages'] ?? []);
$pagesOther = sanitizeInput($_POST['pagesOther'] ?? '');

$features = sanitizeArray($_POST['features'] ?? []);
$featuresOther = sanitizeInput($_POST['featuresOther'] ?? '');
$numProducts = sanitizeInput($_POST['numProducts'] ?? '');
$productCategories = sanitizeInput($_POST['productCategories'] ?? '');
$ecommerceOptions = sanitizeArray($_POST['ecommerceOptions'] ?? []);
$shippingOptions = sanitizeArray($_POST['shippingOptions'] ?? []);
$paymentOptions = sanitizeArray($_POST['paymentOptions'] ?? []);
$paymentOptionsOther = sanitizeInput($_POST['paymentOptionsOther'] ?? '');

$websitesLiked = sanitizeInput($_POST['websitesLiked'] ?? '');
$competitorSites = sanitizeInput($_POST['competitorSites'] ?? '');
$dislikes = sanitizeInput($_POST['dislikes'] ?? '');

$seoServices = sanitizeArray($_POST['seoServices'] ?? []);
$trackingTools = sanitizeArray($_POST['trackingTools'] ?? []);
$seoCopywriting = sanitizeInput($_POST['seoCopywriting'] ?? '');

$platform = sanitizeInput($_POST['platform'] ?? '');
$hosting = sanitizeInput($_POST['hosting'] ?? '');
$domainStatus = sanitizeInput($_POST['domainStatus'] ?? '');
$security = sanitizeArray($_POST['security'] ?? []);
$securityOther = sanitizeInput($_POST['securityOther'] ?? '');

$maintenanceOptions = sanitizeArray($_POST['maintenanceOptions'] ?? []);
$siteUpdater = sanitizeInput($_POST['siteUpdater'] ?? '');

$budget = sanitizeInput($_POST['budget'] ?? '');
$timeline = sanitizeInput($_POST['timeline'] ?? '');
$timelineDate = sanitizeInput($_POST['timelineDate'] ?? '');

$urgency = sanitizeInput($_POST['urgency'] ?? '');
$decisionMaker = sanitizeInput($_POST['decisionMaker'] ?? '');
$possibleDelays = sanitizeInput($_POST['possibleDelays'] ?? '');

$additionalNotes = sanitizeInput($_POST['additionalNotes'] ?? '');

// NEW FIELDS from enhanced form
$contentStatus = sanitizeInput($_POST['contentStatus'] ?? '');
$existingWebsite = sanitizeInput($_POST['existingWebsite'] ?? '');
$existingUrl = sanitizeInput($_POST['existingUrl'] ?? '');
$migrationDetails = sanitizeInput($_POST['migrationDetails'] ?? '');
$maintenanceInterest = sanitizeInput($_POST['maintenanceInterest'] ?? '');
$supportNeeds = sanitizeArray($_POST['supportNeeds'] ?? []);
$maintenanceBilling = sanitizeInput($_POST['maintenanceBilling'] ?? '');
$hostingNeeded = sanitizeInput($_POST['hostingNeeded'] ?? '');
$referralSource = sanitizeInput($_POST['referralSource'] ?? '');
$referralName = sanitizeInput($_POST['referralName'] ?? '');
$nonprofitStatus = sanitizeInput($_POST['nonprofitStatus'] ?? '');
$paymentPreference = sanitizeInput($_POST['paymentPreference'] ?? '');

// Validate required fields
if (empty($companyName) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Company name and email are required.']);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
    exit;
}

// ═══════════════════════════════════════════════════════
// SAVE TO DATABASE
// ═══════════════════════════════════════════════════════
try {
    $sql = "INSERT INTO project_intakes (
        company_name, contact_person, email, phone, 
        preferred_communication, current_website, business_address,
        business_description, website_goals, primary_action, business_priorities,
        ideal_customer, multiple_audiences, audience_problems,
        branding_status, branding_assets, brand_personality,
        content_status, images_options, pages_needed,
        features, num_products, product_categories, ecommerce_options,
        shipping_options, payment_options,
        websites_liked, competitor_sites, dislikes,
        seo_services, tracking_tools, seo_copywriting,
        platform, hosting, domain_status, security,
        maintenance_options, site_updater,
        budget, timeline, timeline_date,
        urgency, decision_maker, possible_delays,
        existing_website, existing_url, migration_details,
        maintenance_interest, support_needs, maintenance_billing, hosting_needed,
        referral_source, referral_name, nonprofit_status, payment_preference,
        additional_notes,
        submitted_at, ip_address, status
    ) VALUES (
        :company_name, :contact_person, :email, :phone,
        :preferred_communication, :current_website, :business_address,
        :business_description, :website_goals, :primary_action, :business_priorities,
        :ideal_customer, :multiple_audiences, :audience_problems,
        :branding_status, :branding_assets, :brand_personality,
        :content_status_new, :images_options, :pages_needed,
        :features, :num_products, :product_categories, :ecommerce_options,
        :shipping_options, :payment_options,
        :websites_liked, :competitor_sites, :dislikes,
        :seo_services, :tracking_tools, :seo_copywriting,
        :platform, :hosting, :domain_status, :security,
        :maintenance_options, :site_updater,
        :budget, :timeline, :timeline_date,
        :urgency, :decision_maker, :possible_delays,
        :existing_website, :existing_url, :migration_details,
        :maintenance_interest, :support_needs, :maintenance_billing, :hosting_needed,
        :referral_source, :referral_name, :nonprofit_status, :payment_preference,
        :additional_notes,
        NOW(), :ip_address, 'new'
    )";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':company_name' => $companyName,
        ':contact_person' => $contactPerson,
        ':email' => $email,
        ':phone' => $phone,
        ':preferred_communication' => $preferredCommunication,
        ':current_website' => $currentWebsite,
        ':business_address' => $businessAddress,
        ':business_description' => $businessDescription,
        ':website_goals' => $websiteGoals,
        ':primary_action' => $primaryAction,
        ':business_priorities' => $businessPriorities,
        ':ideal_customer' => $idealCustomer,
        ':multiple_audiences' => $multipleAudiences,
        ':audience_problems' => $audienceProblems,
        ':branding_status' => $brandingStatus,
        ':branding_assets' => $brandingAssets,
        ':brand_personality' => $brandPersonality,
        ':content_status_new' => $contentStatus,
        ':images_options' => $imagesOptions,
        ':pages_needed' => $pages,
        ':features' => $features,
        ':num_products' => $numProducts,
        ':product_categories' => $productCategories,
        ':ecommerce_options' => $ecommerceOptions,
        ':shipping_options' => $shippingOptions,
        ':payment_options' => $paymentOptions,
        ':websites_liked' => $websitesLiked,
        ':competitor_sites' => $competitorSites,
        ':dislikes' => $dislikes,
        ':seo_services' => $seoServices,
        ':tracking_tools' => $trackingTools,
        ':seo_copywriting' => $seoCopywriting,
        ':platform' => $platform,
        ':hosting' => $hosting,
        ':domain_status' => $domainStatus,
        ':security' => $security,
        ':maintenance_options' => $maintenanceOptions,
        ':site_updater' => $siteUpdater,
        ':budget' => $budget,
        ':timeline' => $timeline,
        ':timeline_date' => $timelineDate,
        ':urgency' => $urgency,
        ':decision_maker' => $decisionMaker,
        ':possible_delays' => $possibleDelays,
        ':existing_website' => $existingWebsite,
        ':existing_url' => $existingUrl,
        ':migration_details' => $migrationDetails,
        ':maintenance_interest' => $maintenanceInterest,
        ':support_needs' => $supportNeeds,
        ':maintenance_billing' => $maintenanceBilling,
        ':hosting_needed' => $hostingNeeded,
        ':referral_source' => $referralSource,
        ':referral_name' => $referralName,
        ':nonprofit_status' => $nonprofitStatus,
        ':payment_preference' => $paymentPreference,
        ':additional_notes' => $additionalNotes,
        ':ip_address' => $_SERVER['REMOTE_ADDR']
    ]);
    
    $intakeId = $pdo->lastInsertId();
    
} catch (PDOException $e) {
    error_log("Database insert failed: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error saving your submission. Please try again.']);
    exit;
}

// Prepare email content
$to = 'info@rvwebcreations.com';
$subject = 'New Project Intake Form: ' . $companyName;
$headers = "From: " . $email . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Build comprehensive email message
$message = "NEW PROJECT INTAKE FORM SUBMISSION\n";
$message .= "═══════════════════════════════════════════════════════\n\n";

$message .= "1. BASIC BUSINESS INFORMATION\n";
$message .= "─────────────────────────────────\n";
$message .= "Company Name: $companyName\n";
$message .= "Contact Person: $contactPerson\n";
$message .= "Email: $email\n";
$message .= "Phone: $phone\n";
$message .= "Preferred Communication: $preferredCommunication\n";
if ($preferredCommunicationOther) $message .= "Other Communication: $preferredCommunicationOther\n";
$message .= "Current Website: $currentWebsite\n";
if ($businessAddress) $message .= "Business Address: $businessAddress\n";
$message .= "\n";

$message .= "2. BUSINESS OVERVIEW & GOALS\n";
$message .= "─────────────────────────────────\n";
$message .= "Business Description: $businessDescription\n";
$message .= "Website Goals: $websiteGoals\n";
if ($websiteGoalsOther) $message .= "Other Goals: $websiteGoalsOther\n";
$message .= "Primary Visitor Action: $primaryAction\n";
$message .= "Business Priorities: $businessPriorities\n";
$message .= "\n";

$message .= "3. TARGET AUDIENCE\n";
$message .= "─────────────────────────────────\n";
$message .= "Ideal Customer: $idealCustomer\n";
$message .= "Multiple Audiences: $multipleAudiences\n";
$message .= "Audience Problems: $audienceProblems\n";
$message .= "\n";

$message .= "4. BRANDING REQUIREMENTS\n";
$message .= "─────────────────────────────────\n";
$message .= "Branding Status: $brandingStatus\n";
$message .= "Branding Assets: $brandingAssets\n";
$message .= "Brand Personality: $brandPersonality\n";
if ($brandPersonalityOther) $message .= "Other Personality: $brandPersonalityOther\n";
$message .= "\n";

$message .= "5. WEBSITE CONTENT\n";
$message .= "─────────────────────────────────\n";
$message .= "Content Status: $contentStatus\n";
$message .= "Images Options: $imagesOptions\n";
$message .= "Pages Needed: $pages\n";
if ($pagesOther) $message .= "Other Pages: $pagesOther\n";
$message .= "\n";

$message .= "6. FEATURES & FUNCTIONALITY\n";
$message .= "─────────────────────────────────\n";
$message .= "Features: $features\n";
if ($featuresOther) $message .= "Other Features: $featuresOther\n";
if ($numProducts) {
    $message .= "\nE-COMMERCE:\n";
    $message .= "Number of Products: $numProducts\n";
    $message .= "Product Categories: $productCategories\n";
    $message .= "E-commerce Options: $ecommerceOptions\n";
    $message .= "Shipping: $shippingOptions\n";
    $message .= "Payment Options: $paymentOptions\n";
    if ($paymentOptionsOther) $message .= "Other Payment: $paymentOptionsOther\n";
}
$message .= "\n";

$message .= "7. COMPETITOR & INSPIRATION\n";
$message .= "─────────────────────────────────\n";
$message .= "Websites Liked: $websitesLiked\n";
$message .= "Competitor Sites: $competitorSites\n";
$message .= "Dislikes: $dislikes\n";
$message .= "\n";

$message .= "8. SEO, MARKETING & PERFORMANCE\n";
$message .= "─────────────────────────────────\n";
$message .= "SEO Services: $seoServices\n";
$message .= "Tracking Tools: $trackingTools\n";
$message .= "SEO Copywriting: $seoCopywriting\n";
$message .= "\n";

$message .= "9. TECHNICAL REQUIREMENTS\n";
$message .= "─────────────────────────────────\n";
$message .= "Platform: $platform\n";
$message .= "Hosting: $hosting\n";
$message .= "Domain Status: $domainStatus\n";
$message .= "Security: $security\n";
if ($securityOther) $message .= "Other Security: $securityOther\n";
$message .= "\n";

$message .= "10. MAINTENANCE & SUPPORT\n";
$message .= "─────────────────────────────────\n";
$message .= "Maintenance Options: $maintenanceOptions\n";
$message .= "Site Updater: $siteUpdater\n";
$message .= "\n";

$message .= "11. BUDGET & TIMELINE\n";
$message .= "─────────────────────────────────\n";
$message .= "Budget: $budget\n";
$message .= "Timeline: $timeline\n";
if ($timelineDate) $message .= "Specific Deadline: $timelineDate\n";
$message .= "\n";

$message .= "12. PROJECT PRIORITY & DECISION-MAKING\n";
$message .= "─────────────────────────────────\n";
$message .= "Urgency (1-10): $urgency\n";
$message .= "Decision Maker: $decisionMaker\n";
$message .= "Possible Delays: $possibleDelays\n";
$message .= "\n";

$message .= "13. ADDITIONAL NOTES\n";
$message .= "─────────────────────────────────\n";
$message .= "$additionalNotes\n";
$message .= "\n";

$message .= "═══════════════════════════════════════════════════════\n";
$message .= "Submitted: " . date('Y-m-d H:i:s') . "\n";
$message .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your intake form has been submitted successfully. I\'ll review your answers and be in touch within 24 hours.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'There was an error submitting your intake form. Please email it directly to info@rvwebcreations.com.'
    ]);
}
?>
