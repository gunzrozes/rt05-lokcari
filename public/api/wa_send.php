<?php
// public/api/wa_send.php
// Sends WhatsApp messages via WhatsApp Business Cloud API (Facebook Graph API)
// Set your credentials in config.php: $WA_PHONE_NUMBER_ID and $WA_TOKEN
require_once __DIR__ . '/../../config.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error'=>'Use POST with message and recipients']); exit;
}
$body = json_decode(file_get_contents('php://input'), true);
$msg = $body['message'] ?? '';
$recipients = $body['recipients'] ?? []; // array of phone numbers in international format e.g. 6281234...

if (!$msg || !is_array($recipients) || empty($recipients)) {
    echo json_encode(['error'=>'Missing message or recipients']); exit;
}

if (empty($WA_PHONE_NUMBER_ID) || empty($WA_TOKEN)) {
    echo json_encode(['error'=>'WhatsApp API credentials not set in config.php']); exit;
}

$results = [];
foreach ($recipients as $to) {
    $payload = [
        'messaging_product' => 'whatsapp',
        'to' => $to,
        'type' => 'text',
        'text' => ['body' => $msg]
    ];
    $ch = curl_init("https://graph.facebook.com/v15.0/{$WA_PHONE_NUMBER_ID}/messages");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $WA_TOKEN, 'Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $res = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    $results[] = ['to'=>$to, 'response'=>$res, 'error'=>$err];
}
echo json_encode($results);
?>