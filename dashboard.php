<?php
// ================= USER LOGIN =================
$username = $_SESSION['username'];

$sqlUser = "SELECT foto FROM user WHERE username='$username'";
$resultUser = $conn->query($sqlUser);
$user = $resultUser->fetch_assoc();

$foto = $user['foto'] ?? 'default.png';

// ================= ARTICLE =================
$sql1 = "SELECT COUNT(*) AS total FROM article";
$hasil1 = $conn->query($sql1);
$row1 = $hasil1->fetch_assoc();
$jumlah_article = $row1['total'];

// ================= GALLERY =================
$sql2 = "SELECT COUNT(*) AS total FROM gallery";
$hasil2 = $conn->query($sql2);
$row2 = $hasil2->fetch_assoc();
$jumlah_gallery = $row2['total'];
?>

<!-- USER INFO -->
<div class="text-center mt-4">
    <p class="mb-1">Selamat Datang,</p>
    <h4 class="text-danger fw-bold"><?= $username; ?></h4>

    <img 
        src="img/<?= $foto; ?>" 
        class="rounded-circle shadow my-3"
        width="160"
        height="160"
        style="object-fit: cover;"
    >
</div>

<!-- CARD -->
<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">

    <!-- CARD ARTICLE -->
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="p-3">
                        <h5 class="card-title">
                            <i class="bi bi-newspaper"></i> Article
                        </h5>
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2">
                            <?= $jumlah_article; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CARD GALLERY -->
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="p-3">
                        <h5 class="card-title">
                            <i class="bi bi-camera"></i> Gallery
                        </h5>
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2">
                            <?= $jumlah_gallery; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>