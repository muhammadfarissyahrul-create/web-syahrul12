<?php
// =====================
// BAGIAN PHP (WAJIB DI ATAS, JANGAN ADA HTML SEBELUM INI)
// =====================
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // ⬅️ FIX agar tidak notice session
}

include "koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['user']);
    $password = trim($_POST['pass']);

    // Validasi kosong
    if ($username == "" || $password == "") {
        $error = "Username dan password tidak boleh kosong!";
    } else {

        // Enkripsi password (SESUAI DATABASE KAMU)
        $password = md5($password);

        // Query login
        $stmt = $conn->prepare(
            "SELECT * FROM user WHERE username = ? AND password = ?"
        );
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Jika login berhasil
        if ($row) {

            // =====================
            // SESSION (INI YANG DIPERBAIKI)
            // =====================
            $_SESSION['id']       = $row['id'];       // ⬅️ FIX (bukan id_user)
            $_SESSION['username'] = $row['username'];

            header("Location: admin.php");
            exit;

        } else {
            $error = "Username atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | My Daily Journal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="img/logo.png" />
</head>

<body class="bg-danger-subtle">

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow rounded-5">
                <div class="card-body">

                    <div class="text-center mb-3">
                        <i class="bi bi-person-circle display-4"></i>
                        <p>My Daily Journal</p>
                        <hr />
                    </div>

                    <!-- PESAN ERROR -->
                    <?php if ($error != "") : ?>
                        <div class="alert alert-danger text-center">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="post">
                        <input
                            type="text"
                            name="user"
                            class="form-control my-3 py-2 rounded-4"
                            placeholder="Username"
                        />

                        <input
                            type="password"
                            name="pass"
                            class="form-control my-3 py-2 rounded-4"
                            placeholder="Password"
                        />

                        <div class="d-grid mt-3">
                            <button class="btn btn-danger rounded-4">
                                Login
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>