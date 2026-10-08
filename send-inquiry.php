
<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

/**
 * Form handler for project inquiries
 * Receives POST data and sends email to the business inbox.
 */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

header('Content-Type: application/json; charset=utf-8');

$name = trim(str_replace(["\r", "\n"], ' ', (string) ($_POST['name'] ?? '')));
$email = trim((string) ($_POST['email'] ?? ''));
$business = trim((string) ($_POST['business'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $business === '' || $message === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please complete all required fields.']);
    exit;
}

$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if ($email === false) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please provide a valid email address.']);
    exit;
}

$smtpPassword = getenv('SMTP_PASSWORD');
if ($smtpPassword === false || $smtpPassword === '') {
    error_log('Contact form unavailable: SMTP_PASSWORD is not configured.');
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'We could not send your request right now. Please try again later.']);
    exit;
}

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'mail.rvwebcreations.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@rvwebcreations.com';
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('info@rvwebcreations.com', 'RV Web Creations');
    $mail->addAddress('info@rvwebcreations.com');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(false);
    $mail->Subject = "New project inquiry from $name";
    $mail->Body = "New Project Inquiry\n\nName: $name\nEmail: $email\nBusiness: $business\n\nProject notes:\n$message\n";

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Inquiry sent successfully.']);
} catch (\Throwable $error) {
    http_response_code(500);
    error_log('Contact form delivery failed: ' . $mail->ErrorInfo . ' ' . $error->getMessage());
    echo json_encode(['success' => false, 'message' => 'We could not send your request right now. Please try again later.']);
}
