<?php require_once '../config.php'; if(!is_logged_in()) header('Location: login.php');
$tw=$pdo->query('SELECT COUNT(*) FROM warga')->fetchColumn();
$tk=$pdo->query('SELECT COUNT(DISTINCT no_kk) FROM warga')->fetchColumn();
$ti=$pdo->query("SELECT IFNULL(SUM(nominal),0) FROM iuran WHERE bulan=MONTH(CURDATE()) AND tahun=YEAR(CURDATE()) AND status='lunas'")->fetchColumn();
$ts=$pdo->query("SELECT COUNT(*) FROM surat WHERE DATE(created_at)=CURDATE()")->fetchColumn();
?>
<!doctype html><html><head><title>Dashboard</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<nav class="topbar"><b>RT 05 RW 10 LOKCARI</b><a href="logout.php">Logout</a></nav>
<div class="grid">
<div class="card">Total Warga<br><b><?= $tw ?></b></div>
<div class="card">KK Aktif<br><b><?= $tk ?></b></div>
<div class="card">Kas Bulan Ini<br><b>Rp <?= number_format($ti,0,',','.') ?></b></div>
<div class="card">Surat Hari Ini<br><b><?= $ts ?></b></div>
</div>
<div class="links">
<a href="warga/list.php">Data Warga</a>
<a href="iuran/list.php">Iuran</a>
<a href="surat/create.php">Buat Surat</a>
<a href="cari.php">Cari</a>
<a href="qr.php">QR Card</a>
<a href="whatsapp.php">WhatsApp Blast</a>
<a href="ektp.php">Scan e-KTP</a>
</div>
</body></html>