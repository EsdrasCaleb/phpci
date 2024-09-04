<?php
include 'load_env.php';

// Set the secret token (optional, but recommended for security)
$secret = $_ENV['SECRET'];

// Get the payload from GitHub
$payload = file_get_contents('php://input');
$currentPath = __DIR__;

// Verify the payload if the secret is set
if ($secret) {
    $headers = getallheaders();
    if (!hash_equals('sha256='.hash_hmac('sha256', $$payload, $secret), $headers['x-hub-signature-256'])) {
        header('HTTP/1.1 403 Forbidden');
        exit('Invalid signature');
    }
}

// Log the payload for debugging (optional)
if($_ENV['SAVE_LOG']){
    file_put_contents('webhook.log', $payload.PHP_EOL, FILE_APPEND);
}

// Change to the directory of your project
if(is_dir($_ENV['PROJECT_PATH'])){
    chdir($_ENV['PROJECT_PATH']);
}

if($_ENV['TOKEN']&&$_ENV['TOKEN']){
    exec('git remote set-url origin https://'.$_ENV['TOKEN'].'@'.$_ENV['GIT_URL']);
}

// Run the git pull command
$output = [];
$return_var = 0;

if($_ENV['RESET_BEFORE_PULL']){
    exec('git reset --hard', $output, $return_var);
    if ($return_var === 0) {
        echo 'Git reset successful';
    }
    else {
        echo 'Git reset failed';
    }
}
if($_ENV["BRANCH"]){
    exec('git checkout '.$_ENV["BRANCH"], $output, $return_var);
    if ($return_var === 0) {
        echo 'Git checkout successful';
    }
    else {
        echo 'Git checkout failed';
    }
}
exec('git pull 2>&1', $output, $return_var);

// Log the output for debugging (optional)
if($_ENV['SAVE_LOG']){
    file_put_contents("{$currentPath}/git-pull.log", implode(PHP_EOL, $output).PHP_EOL, FILE_APPEND);
}

// Send a response back to GitHub
if ($return_var === 0) {
    echo 'Git pull successful';
} else {
    echo 'Git pull failed';
    http_response_code(500);
}
