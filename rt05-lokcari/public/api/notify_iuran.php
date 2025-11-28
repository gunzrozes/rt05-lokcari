<?php
// public/api/notify_iuran.php
// This script will notify warga with unpaid iuran via email and WhatsApp API (if configured)
// Requires PHPMailer configured (composer). Place in cron to run monthly.
require_once __DIR__ . '/../../config.php';

// Fetch unpaid iuran for current month
$month = date('n'); $year = date('Y');
$stmt = $pdo->prepare('SELECT i.*, w.nama, w.no_hp, w.email FROM iuran i JOIN warga w ON i.warga_id=w.id WHERE i.bulan=? AND i.tahun=? AND i.status="belum"');
$stmt->execute([$month,$year]);
$rows = $stmt->fetchAll();
$results = [];

foreach($rows as $r){
  $to_email = $r['email'] ?? null;
  $to_phone = preg_replace('/^0/','62',$r['no_hp']); // convert to 62...
  $message = "Halo {$r['nama']}, Anda mempunyai iuran bulan {$r['bulan']}/{$r['tahun']} sebesar Rp " . number_format($r['nominal'],0,',','.');
  // Send email (PHPMailer) - placeholder: requires composer install and SMTP config
  $results[] = ['id'=>$r['id'],'email_sent'=>false,'wa_sent'=>false,'message'=>$message];
  // Optionally call WA API via curl
  if(!empty($WA_PHONE_NUMBER_ID) && !empty($WA_TOKEN) && !empty($to_phone)){
    $payload = ['message'=>$message,'recipients'=>[$to_phone]];
    $ch = curl_init('http://localhost/public/api/wa_send.php'); // adjust path
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $res = curl_exec($ch); curl_close($ch);
    $results[count($results)-1]['wa_sent'] = $res ? true : false;
  }
}

header('Content-Type: application/json'); echo json_encode($results);
?>