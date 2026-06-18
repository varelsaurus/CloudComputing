<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tugas Besar Komputasi Awan</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }
        
        /* Floating background shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s infinite ease-in-out;
            z-index: 0;
        }
        .shape-1 { width: 300px; height: 300px; top: -100px; left: -100px; animation-delay: 0s; }
        .shape-2 { width: 400px; height: 400px; bottom: -150px; right: -100px; animation-delay: 2s; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(20px); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 2.5rem;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            z-index: 1;
            color: white;
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }

        .login-card h3 {
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            color: white !important;
            border-radius: 10px;
            padding: 12px;
            font-weight: 400;
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.25) !important;
            border-color: rgba(255, 255, 255, 0.8) !important;
            color: white !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.2);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .form-label {
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00C9FF 0%, #92FE9D 100%);
            border: none;
            color: #1a2a6c;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #92FE9D 0%, #00C9FF 100%);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 201, 255, 0.4);
        }
        
        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }
    </style>
</head>
<body>

<div class="shape shape-1"></div>
<div class="shape shape-2"></div>

<div class="login-card">
    <h3 class="text-center">CloudApp <br> <span style="font-size: 1.2rem; font-weight: 300;">SI4703</span></h3>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert" style="background: rgba(220, 53, 69, 0.2); border: 1px solid rgba(220, 53, 69, 0.5); color: #ffcccc;">
            Username atau Password salah!
        </div>
    <?php endif; ?>

    <form action="actions/login_action.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login to Cloud</button>
    </form>
    <div class="text-center mt-4">
        <small class="text-muted">Tubes Komputasi Awan 2026</small>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
