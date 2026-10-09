<?php
header('Content-Type: application/json; charset=utf-8');

$handlerPath = __DIR__ . '/send-inquiry.php';
if (!is_readable($handlerPath)) {
    http_response_code(500);
    echo json_encode(['readable' => false]);
    exit;
}

$source = file_get_contents($handlerPath);
if ($source === false) {
    http_response_code(500);
    echo json_encode(['readable' => false]);
    exit;
}

try {
    token_get_all($source, TOKEN_PARSE);
    echo json_encode(['readable' => true, 'syntax' => 'ok']);
} catch (ParseError $error) {
    http_response_code(500);
    echo json_encode(['readable' => true, 'syntax' => 'error', 'line' => $error->getLine()]);
}
