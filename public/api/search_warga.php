<?php require_once '../../config.php';
$q=$_GET['q']??''; $l='%'.$q.'%';
$s=$pdo->prepare("SELECT nik,nama,alamat,no_kk FROM warga WHERE nama LIKE ? OR nik LIKE ? OR no_kk LIKE ? LIMIT 50");
$s->execute([$l,$l,$l]); echo json_encode($s->fetchAll());