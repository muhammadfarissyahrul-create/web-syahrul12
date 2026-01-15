<?php
include "koneksi.php";

$username = $_SESSION['username'];

// ambil data user yang login
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// proses simpan
if (isset($_POST['simpan'])) {

    // ganti password (jika diisi)
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $conn->query("UPDATE user SET password='$password' WHERE username='$username'");
    }

    // ganti foto
    if (!empty($_FILES['foto']['name'])) {
        $namaFile = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $namaFile);

        // hapus foto lama (jika ada)
        if (!empty($user['foto']) && file_exists("img/".$user['foto'])) {
            unlink("img/".$user['foto']);
        }

        $conn->query("UPDATE user SET foto='$namaFile' WHERE username='$username'");
    }

    header("location:admin.php?page=profile");
    exit;
}
?>

<form method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" value="<?= $user['username']; ?>" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Ganti Password</label>
        <input type="password" name="password" class="form-control"
               placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
    </div>

    <div class="mb-3">
        <label class="form-label">Ganti Foto Profil</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Foto Profil Saat Ini</label><br>

        <?php if (!empty($user['foto'])) { ?>
            <img src="img/<?= $user['foto']; ?>"
                 width="120"
                 height="120"
                 style="object-fit:cover; border:1px solid #ccc;">
        <?php } ?>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">simpan</button>

</form>