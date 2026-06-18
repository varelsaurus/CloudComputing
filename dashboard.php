<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Simulasi indikator load balancer
ob_start();
include 'includes/check-id.php';
$server_indicator = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tugas Besar Komputasi Awan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.8) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            background: linear-gradient(135deg, #00C9FF 0%, #92FE9D 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8) !important;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #00C9FF !important;
        }

        .hero-section {
            padding: 100px 0;
            position: relative;
            z-index: 1;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: 50%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0,201,255,0.15) 0%, rgba(15,23,42,0) 70%);
            transform: translate(-50%, 0);
            z-index: -1;
            border-radius: 50%;
        }

        .server-badge {
            font-size: 1.5rem;
            padding: 15px 30px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 201, 255, 0.3);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            color: #00C9FF;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(0, 201, 255, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(0, 201, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 201, 255, 0); }
        }

        .btn-custom {
            background: linear-gradient(135deg, #00C9FF 0%, #92FE9D 100%);
            border: none;
            color: #0f172a;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 201, 255, 0.3);
            color: #0f172a;
        }
        
        h1 {
            font-weight: 700;
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .lead {
            color: #94a3b8;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Tubes Cloud Computing</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="anggota.php">Anggota Kelompok</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger fw-bold" href="actions/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container hero-section text-center">
    <h1>Selamat Datang, <span style="color: #92FE9D;"><?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></span>!</h1>
    <p class="lead mb-5">Ini adalah halaman utama aplikasi Cloud berbasis Multi-Instance.</p>
    
    <div class="mt-5 mb-5">
        <p class="text-uppercase tracking-wider mb-3" style="letter-spacing: 2px; font-size: 1rem; color: #cbd5e1; font-weight: 600;">Indikator Server Respons</p>
        <div class="d-inline-block server-badge">
            <span style="color: #f8fafc; font-size: 1.1rem; vertical-align: middle; font-weight: 500;">Server Instance:</span> 
            <span class="fw-bold" style="font-size: 2rem; vertical-align: middle; margin-left: 10px;"><?php echo $server_indicator; ?></span>
        </div>
        <p class="mt-3" style="color: #cbd5e1; font-weight: 300; font-size: 0.9rem;">Refresh halaman untuk melihat perubahan Load Balancer (Simulasi Lokal)</p>
    </div>
    
    <div class="mt-5">
        <a href="anggota.php" class="btn-custom">Lihat Anggota Kelompok ➔</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
