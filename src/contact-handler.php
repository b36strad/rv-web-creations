<?php
// Enable error reporting for debugging (remove in production if needed)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Set content type
header('Content-Type: application/json');

// Configuration
define('RECIPIENT_EMAIL', 'info@rvwebcreations.com');
define('SUBJECT', 'New Contact Form Submission - RV Web Creations');

// Initialize response
$response = ['success' => false, 'message' => ''];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

// Sanitize and validate input
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Get and sanitize form data
$name = sanitize_input($_POST['name'] ?? '');
$email = sanitize_input($_POST['email'] ?? '');
$phone = sanitize_input($_POST['phone'] ?? '');
$call_time = sanitize_input($_POST['call-time'] ?? '');
$business = sanitize_input($_POST['business'] ?? '');
$website = sanitize_input($_POST['website'] ?? '');
$project_type = sanitize_input($_POST['project-type'] ?? '');
$budget = sanitize_input($_POST['budget'] ?? '');
$message = sanitize_input($_POST['message'] ?? '');

// Validate required fields
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required.';
}

if (empty($email)) {
    $errors[] = 'Email is required.';
} elseif (!validate_email($email)) {
    $errors[] = 'Invalid email address.';
}

if (empty($message)) {
    $errors[] = 'Message is required.';
}

// Check for errors
if (!empty($errors)) {
    $response['message'] = implode(' ', $errors);
    echo json_encode($response);
    exit;
}

// Basic spam protection - honeypot check (if you add a hidden field)
if (!empty($_POST['website_url'])) {
    $response['message'] = 'Spam detected.';
    echo json_encode($response);
    exit;
}

// Build email body
$email_body = "New contact form submission from RV Web Creations website\n\n";
$email_body .= "═══════════════════════════════════════\n\n";
$email_body .= "Name: {$name}\n";
$email_body .= "Email: {$email}\n";
$email_body .= "Phone: {$phone}\n";
$email_body .= "Best Time to Call: {$call_time}\n";
$email_body .= "Business: {$business}\n";
$email_body .= "Current Website: {$website}\n";
$email_body .= "Project Type: {$project_type}\n";
$email_body .= "Budget Range: {$budget}\n\n";
$email_body .= "Message:\n{$message}\n\n";
$email_body .= "═══════════════════════════════════════\n";
$email_body .= "Submitted: " . date('F j, Y \a\t g:i A T') . "\n";
$email_body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";

// Email headers
$headers = [];
$headers[] = "From: RV Web Creations <noreply@rvwebcreations.com>";
$headers[] = "Reply-To: {$name} <{$email}>";
$headers[] = "X-Mailer: PHP/" . phpversion();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-Type: text/plain; charset=UTF-8";

// Send email
$mail_sent = mail(RECIPIENT_EMAIL, SUBJECT, $email_body, implode("\r\n", $headers));

if ($mail_sent) {
    $response['success'] = true;
    $response['message'] = 'Thank you for your message! I\'ll get back to you within 1-2 business days.';
} else {
    $response['message'] = 'Sorry, there was a problem sending your message. Please email me directly at ' . RECIPIENT_EMAIL;
}

echo json_encode($response);
exit;
