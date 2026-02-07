

require __DIR__ . '/phpmailer/PHPMailer.php';
require __DIR__ . '/phpmailer/SMTP.php';
require __DIR__ . '/phpmailer/Exception.php';
<?php
/**
 * Form handler for project inquiries
 * Receives POST data and sends email to info@rvwebcreations.com
 */

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    exit;
}

// Set JSON response header
header('Content-Type: application/json');

// Collect and sanitize form data
$name     = htmlspecialchars(trim($_POST['name'] ?? ''));
$email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$business = htmlspecialchars(trim($_POST['business'] ?? ''));
$message  = htmlspecialchars(trim($_POST['message'] ?? ''));

// Basic validation
if (empty($name) || empty($email) || empty($business)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Required fields missing']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Build email
$to = 'ryanvia62@gmail.com';
$subject = "New Project Inquiry from $name";

$body = "
New Project Inquiry
====================

Name: $name
Email: $email
Business: $business
Project Notes:
$message

--
Sent from rvwebcreations.com contact form
";

$headers = [
    'From: noreply@rvwebcreations.com',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=UTF-8'
];

// Send email

$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'mail.rvwebcreations.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@rvwebcreations.com';
    // Load SMTP password from hidden file
    $smtp_password_file = __DIR__ . '/.smtp_password';
    $mail->Password = file_exists($smtp_password_file) ? trim(file_get_contents($smtp_password_file)) : '';
    // If the password file is missing or empty, throw an error
    if (empty($mail->Password)) {
        throw new Exception('SMTP password file missing or empty.');
    }
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Recipients
    $mail->setFrom('info@rvwebcreations.com', 'RV Web Creations');
    $mail->addAddress($to);
    $mail->addReplyTo($email, $name);

    // Content
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Inquiry sent successfully']);
} catch (Exception $e) {
    http_response_code(500);
    // Log both PHPMailer and Exception error details
    error_log('PHPMailer error: ' . $mail->ErrorInfo);
    error_log('Exception: ' . $e->getMessage());
    // Optionally, return the error for debugging (remove in production)
    echo json_encode([
        'success' => false,
        'message' => 'Failed to send email. Please try again.',
        'error' => $mail->ErrorInfo,
        'exception' => $e->getMessage()
    ]);
}
