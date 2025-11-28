<?php
// public/generate_pdf.php - example using Dompdf
require_once __DIR__ . '/../config.php';
// Make sure vendor/autoload.php exists after composer install
if (!file_exists(__DIR__.'/../vendor/autoload.php')) {
    die('Please run composer install to enable PDF generation (dompdf).');
}
require_once __DIR__ . '/../vendor/autoload.php';
use Dompdf\Dompdf;

$id = $_GET['id'] ?? null;
if (!$id) die('Missing surat id');

$stmt = $pdo->prepare('SELECT s.*, w.nama FROM surat s LEFT JOIN warga w ON s.warga_id=w.id WHERE s.id=?');
$stmt->execute([$id]);
$row = $stmt->fetch();
if (!$row) die('Surat not found');

$html = '<h2>Surat '+htmlentities($row['jenis'])+'</h2>';
$html .= '<p>Nomor Surat: '.htmlentities($row['nomor_surat']).'</p>';
$html .= '<p>Nama: '.htmlentities($row['nama']).'</p>';
$html .= '<p>'.nl2br(htmlentities($row['isi'])).'</p>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream('surat_'.$row['id'].'.pdf', ['Attachment'=>0]);
?>