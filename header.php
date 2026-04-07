
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuickTask</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #FFB6C1 !important;
            padding: 10px 0;
        }
        
        .navbar-brand {
            font-weight: bold;
            color: black !important;
            font-size: 1.5rem;
            margin-left: 15px;
        }
        
        /* Auth buttons container */
        .auth-buttons {
            display: flex;
            gap: 15px; /* Space between buttons */
        }
        
        /* Auth buttons styling */
        .auth-btn {
            font-weight: bold;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap; /* Prevent text wrapping */
        }
        
        /* Login/Register buttons */
        .btn-login {
            background-color: #ADD8E6;
            color: black;
        }
        
        /* Logout button */
        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        
        .btn-login:hover {
            background-color: black;
            color: #ADD8E6;
        }
        
        .btn-logout:hover {
            background-color: #bb2d3b;
            color: white;
        }
        
        /* Mobile styles */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                padding: 15px;
            }
            .auth-buttons {
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }
            .auth-btn {
                width: 100%;
                margin: 0;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">TaskManager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="auth-buttons">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="auth-btn btn-logout" href="logout.php">Logout</a>
                <?php else: ?>
                    <a class="auth-btn btn-login" href="login.php">Login</a>
                    <a class="auth-btn btn-login" href="register.php">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div class="container">
