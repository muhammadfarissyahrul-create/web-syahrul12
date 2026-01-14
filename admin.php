<?php 
// =====================
// SESSION & KEAMANAN
// =====================
session_start(); 
include "koneksi.php";

// jika belum login → ke login
if (!isset($_SESSION['username'])) { 
    header("location:login.php"); 
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Daily Journal | Admin</title>

    <link rel="icon" href="img/logo.png" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #content {
            flex: 1;
        }
    </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-sm sticky-top bg-danger-subtle">
    <div class="container">
        <a class="navbar-brand" target="_blank" href=".">My Daily Journal</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin.php?page=article">Article</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="admin.php?page=gallery">Gallery</a>
                </li>

                <!-- ===== USER MENU ===== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-danger fw-bold"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                        <?= $_SESSION['username']; ?>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <!-- PROFILE (BARU) -->
                        <li>
                            <a class="dropdown-item" href="admin.php?page=profile">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <!-- LOGOUT -->
                        <li>
                            <a class="dropdown-item text-danger" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- ================= NAVBAR END ================= -->

<!-- ================= CONTENT ================= -->
<section id="content" class="p-5">
    <div class="container">

        <?php
        // routing halaman
        $page = $_GET['page'] ?? 'dashboard';

        echo '<h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">'
             . ucfirst($page) .
             '</h4>';

        // whitelist halaman
        $allowed_pages = [
            'dashboard',
            'article',
            'gallery',
            'profile'
        ];

        if (in_array($page, $allowed_pages)) {
            include $page . ".php";
        } else {
            echo "<div class='alert alert-danger'>Halaman tidak ditemukan</div>";
        }
        ?>

    </div>
</section>
<!-- ================= CONTENT END ================= -->

<!-- ================= FOOTER ================= -->
<footer class="text-center p-3 bg-danger-subtle">
    <div>
        <a href="https://www.instagram.com/udinusofficial">
            <i class="bi bi-instagram h2 p-2 text-dark"></i>
        </a>
        <a href="https://twitter.com/udinusofficial">
            <i class="bi bi-twitter h2 p-2 text-dark"></i>
        </a>
        <a href="https://wa.me/+62812685577">
            <i class="bi bi-whatsapp h2 p-2 text-dark"></i>
        </a>
    </div>
    <div>Faris Syahrul &copy; 2023</div>
</footer>
<!-- ================= FOOTER END ================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>