<?php require_once '../config.php'; if(!is_logged_in()) header('Location: login.php'); ?>
<!doctype html><html><head><title>Grafik Iuran</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head><body>
<canvas id="chart" width="800" height="400"></canvas>
<script>
fetch('api/iuran_stats.php').then(r=>r.json()).then(data=>{
  const labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  const values = Object.values(data).slice(1); // 1..12
  const ctx = document.getElementById('chart').getContext('2d');
  new Chart(ctx, { type: 'bar', data: { labels: labels, datasets:[{label:'Iuran Lunas per Bulan', data: values}] } });
});
</script>
</body></html>