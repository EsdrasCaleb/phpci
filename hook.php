<?php
include 'load_env.php';

// Set the secret token (optional, but recommended for security)
$secret = $_ENV['SECRET'];

// Get the payload from GitHub
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Verify the payload if the secret is set
if ($secret) {
    list($algo, $hash) = explode('=', $signature, 2) + ['', ''];
    $payloadHash = hash_hmac('sha256', $payload, $secret);

    if (!hash_equals($hash, $payloadHash)) {
        header('HTTP/1.1 403 Forbidden');
        exit('Invalid signature');
    }
}

// Log the payload for debugging (optional)
if($_ENV['SAVE_LOG'])
file_put_contents('webhook.log', $payload.PHP_EOL, FILE_APPEND);

// Change to the directory of your project
chdir('/path/to/your/repo');

// Run the git pull command
$output = [];
$return_var = 0;
exec('git pull 2>&1', $output, $return_var);

// Log the output for debugging (optional)
file_put_contents('git-pull.log', implode(PHP_EOL, $output).PHP_EOL, FILE_APPEND);

// Send a response back to GitHub
if ($return_var === 0) {
    echo 'Git pull successful';
} else {
    echo 'Git pull failed';
    http_response_code(500);
}
