<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once 'includes/config.php';

// Simulasi indikator load balancer
ob_start();
include 'includes/check-id.php';
$server_indicator = ob_get_clean();

// Fetch anggota dari database
$query = "SELECT * FROM anggota_kelompok";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota Kelompok - Tugas Besar Komputasi Awan</title>
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

        .member-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            transition: all 0.4s ease;
            color: white;
            overflow: hidden;
            position: relative;
        }

        .member-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #00C9FF, #92FE9D);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .member-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(0, 201, 255, 0.3);
        }

        .member-card:hover::before {
            opacity: 1;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.1);
            padding: 4px;
            transition: all 0.3s;
        }

        .member-card:hover .profile-img {
            border-color: #00C9FF;
            transform: scale(1.05);
        }

        .card-title {
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-top: 15px;
        }

        .role-badge {
            background: rgba(0, 201, 255, 0.1);
            color: #00C9FF;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }

        .server-indicator-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 201, 255, 0.3);
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .indicator-dot {
            width: 10px;
            height: 10px;
            background-color: #92FE9D;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 10px #92FE9D;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.4; }
            100% { opacity: 1; }
        }
        
        .page-title {
            font-weight: 700;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 3rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">CloudApp SI4703</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="anggota.php" style="color: #00C9FF !important;">Anggota Kelompok</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger fw-bold" href="actions/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 mb-5">
    <h2 class="text-center page-title">Tim Pengembang (SI4703)</h2>
    
    <div class="row justify-content-center">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card member-card h-100 text-center p-4">
                        <img src="<?php echo htmlspecialchars($row['foto']); ?>" class="profile-img mx-auto mt-2" alt="Foto <?php echo htmlspecialchars($row['nama']); ?>" onerror="this.onerror=null; this.src='https://via.placeholder.com/150/0f172a/00C9FF?text=No+Photo';">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['nama']); ?></h5>
                            <h6 class="mb-3" style="color: #e2e8f0; font-weight: 500; font-size: 1.1rem;"><?php echo htmlspecialchars($row['nim']); ?></h6>
                            <span class="role-badge"><?php echo htmlspecialchars($row['peran']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Data anggota tidak ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="server-indicator-floating">
    <span class="indicator-dot"></span>
    <span style="color: #ffffff; font-weight: 500; font-size: 1rem;">Server Instance: <strong style="color: #00C9FF; font-size: 1.2rem; font-weight: 700;"><?php echo $server_indicator; ?></strong></span>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
