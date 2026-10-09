<?php
header('Content-Type: application/json; charset=utf-8');

$handlerPath = __DIR__ . '/send-inquiry.php';
if (!is_readable($handlerPath)) {
    http_response_code(500);
    echo json_encode(['readable' => false]);
    exit;
}

try {
    token_get_all(file_get_contents($handlerPath), TOKEN_PARSE);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['syntax' => 'error', 'line' => $error->getLine()]);
    exit;
}

ob_start();
$_SERVER['REQUEST_METHOD'] = 'GET';
register_shutdown_function(static function (): void {
    $handlerOutput = ob_get_clean();
    $lastError = error_get_last();
    $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];
    $fatalError = $lastError !== null && in_array($lastError['type'], $fatalTypes, true)
        ? ['type' => $lastError['type'], 'message' => $lastError['message']]
        : null;

    echo json_encode([
        'status' => http_response_code(),
        'handler_output' => $handlerOutput,
        'fatal_error' => $fatalError,
    ]);
});

require $handlerPath;
