<?php
// public/api/iuran_stats.php - returns monthly totals for given year
require_once __DIR__ . '/../../config.php';
$year = $_GET['year'] ?? date('Y');
$stmt = $pdo->prepare('SELECT bulan, SUM(nominal) as total FROM iuran WHERE tahun=? AND status="lunas" GROUP BY bulan');
$stmt->execute([$year]);
$data = array_fill(1,12,0.0);
while($r=$stmt->fetch()){
  $b = (int)$r['bulan']; $data[$b] = (float)$r['total'];
}
header('Content-Type: application/json'); echo json_encode($data);
?>