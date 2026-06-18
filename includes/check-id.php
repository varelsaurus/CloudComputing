<?php
// Script ini digunakan untuk mensimulasikan indikator Load Balancer (1 atau 2).
// Di AWS, script ini akan berbeda di tiap instance (misal di web1 echo "1", di web2 echo "2").
// Atau bisa juga otomatis membaca hostname IP private EC2.

// Untuk development lokal, kita akan me-random angka 1 atau 2 setiap kali halaman di-refresh,
// hanya untuk melihat bagaimana UI meresponsnya.

$server_id = rand(1, 2);
echo $server_id;
?>
