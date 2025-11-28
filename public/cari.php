<?php require_once '../config.php'; if(!is_logged_in()) header('Location: login.php'); ?>
<!doctype html><html><head><title>Cari</title><script>
function cari(q){fetch('api/search_warga.php?q='+q).then(r=>r.json()).then(d=>{
 let o=''; d.forEach(x=>o+=`<tr><td>${x.nik}</td><td>${x.nama}</td><td>${x.alamat}</td></tr>`);
 document.getElementById('r').innerHTML=o;
});}
</script></head><body>
<input onkeyup="cari(this.value)" placeholder="Cari Nama / NIK / KK">
<table border=1><tr><th>NIK</th><th>Nama</th><th>Alamat</th></tr><tbody id="r"></tbody></table>
</body></html>