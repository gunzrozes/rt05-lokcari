<?php
// public/api/ektp_scan.php
// Requires tesseract-ocr installed on the server and writable tmp folder
require_once __DIR__ . '/../../config.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['error'=>'POST file field: ktp']); exit; }
if (!isset($_FILES['ktp'])) { echo json_encode(['error'=>'file missing']); exit; }

$uploaddir = __DIR__.'/../../public/uploads/';
if (!is_dir($uploaddir)) mkdir($uploaddir, 0755, true);
$fname = basename($_FILES['ktp']['name']);
$target = $uploaddir . time() . '_' . $fname;
if (!move_uploaded_file($_FILES['ktp']['tmp_name'], $target)) { echo json_encode(['error'=>'upload failed']); exit; }

// Run tesseract on the image (ensure tesseract installed)
// Output will be $target.txt
$txtfile = $target . '.txt';
$cmd = "tesseract " . escapeshellarg($target) . " " . escapeshellarg($target) . " 2>&1";
exec($cmd, $output, $ret);
$ocr = file_exists($txtfile) ? file_get_contents($txtfile) : implode("\n", $output);

// basic regex extraction for NIK (16 digits) and Nama (heuristic)
$nik = null; $nama = null;
if (preg_match('/(\d{16})/', $ocr, $m)) $nik = $m[1];
if (preg_match('/NAMA\s*:\s*([A-Z\s]+)/i', $ocr, $m)) $nama = trim($m[1]);
// Fallback heuristics
if (!$nama && preg_match('/([A-Z]{2,}\s+[A-Z]{2,})/', $ocr, $m)) $nama = trim($m[1]);

echo json_encode(['file'=>$target, 'ocr_text'=>substr($ocr,0,800), 'nik'=>$nik, 'nama'=>$nama ]);
?>