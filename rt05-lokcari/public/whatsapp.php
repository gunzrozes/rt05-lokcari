<?php require_once '../config.php'; if(!is_logged_in()) header('Location: login.php');
if($_POST){
 $msg=urlencode($_POST['msg']); $rows=$pdo->query("SELECT no_hp FROM warga WHERE no_hp IS NOT NULL")->fetchAll();
 $links=array_map(fn($r)=>"https://wa.me/62".ltrim($r['no_hp'],'0')."?text=$msg",$rows);
}
?>
<form method="post"><textarea name="msg" placeholder="Pesan broadcast"></textarea><button>Kirim (Generate)</button></form>
<?php if(!empty($links)) foreach($links as $l) echo "<div><a target=_blank href='$l'>$l</a></div>"; ?>