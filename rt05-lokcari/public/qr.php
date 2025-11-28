<?php require_once '../config.php';
$w=$pdo->query("SELECT id,nama,nik FROM warga LIMIT 50")->fetchAll();
?>
<h3>QR Card</h3>
<?php foreach($w as $x):
$data=urlencode("NIK:{$x['nik']}|Nama:{$x['nama']}"); ?>
<div>
<img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $data ?>">
<p><?= $x['nama'] ?></p>
</div>
<?php endforeach; ?>