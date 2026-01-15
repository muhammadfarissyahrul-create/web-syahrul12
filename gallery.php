<?php
include 'koneksi.php';
include 'upload_foto.php';
?>

<style>
/* ===== FINAL FIX LAYOUT ===== */
.col-aksi {
    width: 100px;
    white-space: nowrap;
    vertical-align: middle !important;
}

.col-gambar {
    width: 250px; /* Menentukan lebar kolom gambar */
    vertical-align: middle !important;
}

.img-gallery {
    width: 200px;      /* Lebar foto seragam */
    height: 120px;     /* Tinggi foto seragam */
    object-fit: cover; /* Memotong gambar secara proporsional agar "pas" */
    border-radius: 8px;/* Sudut melengkung agar lebih rapi */
    display: block;
    border: 1px solid #dee2e6;
}

/* Memastikan teks deskripsi di tengah secara vertikal */
table td {
    vertical-align: middle !important;
}
</style>

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary"
                data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Gallery
            </button>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Cari Gallery...">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th class="w-50">Deskripsi</th>
                    <th>Gambar</th>
                    <th class="col-aksi text-end">Aksi</th>
                </tr>
            </thead>

            <tbody id="result">
            <?php
            $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
            $hasil = $conn->query($sql);
            $no = 1;

            while ($row = $hasil->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>

                    <td>
                        <strong><?= $row["deskripsi"] ?></strong><br>
                        pada : <?= $row["tanggal"] ?><br>
                        oleh : <?= $row["username"] ?>
                    </td>

                    <td class="col-gambar">
                        <?php if ($row["gambar"] && file_exists('img/'.$row["gambar"])) { ?>
                            <img src="img/<?= $row["gambar"] ?>" class="img-gallery">
                        <?php } ?>
                    </td>

                    <td class="col-aksi text-end">
                        <a href="#" class="badge rounded-pill text-bg-success"
                           data-bs-toggle="modal"
                           data-bs-target="#modalEdit<?= $row['id'] ?>">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="#" class="badge rounded-pill text-bg-danger"
                           data-bs-toggle="modal"
                           data-bs-target="#modalHapus<?= $row['id'] ?>">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </td>
                </tr>

                <!-- MODAL EDIT -->
                <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Gallery</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" required><?= $row['deskripsi'] ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ganti Gambar</label>
                                        <input type="file" class="form-control" name="gambar">
                                    </div>

                                    <?php if ($row['gambar']) { ?>
                                        <img src="img/<?= $row['gambar'] ?>" class="img-fluid">
                                    <?php } ?>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MODAL HAPUS -->
                <div class="modal fade" id="modalHapus<?= $row['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form method="post">
                                <div class="modal-body">
                                    Yakin ingin menghapus gallery ini?
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gallery</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $deskripsi = $_POST['deskripsi'];
    $gambar = '';

    if (!empty($_FILES['gambar']['name'])) {
        $upload = upload_foto($_FILES['gambar']);
        $gambar = $upload['message'];
    }

    $username = 'admin';
    $stmt = $conn->prepare("INSERT INTO gallery (deskripsi, gambar, username) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $deskripsi, $gambar, $username);
    $stmt->execute();

    echo "<script>location.href='admin.php?page=gallery'</script>";
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_POST['gambar_lama'];

    if (!empty($_FILES['gambar']['name'])) {
        if ($gambar) unlink("img/$gambar");
        $upload = upload_foto($_FILES['gambar']);
        $gambar = $upload['message'];
    }

    $conn->query("UPDATE gallery SET deskripsi='$deskripsi', gambar='$gambar' WHERE id='$id'");
    echo "<script>location.href='admin.php?page=gallery'</script>";
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar) unlink("img/$gambar");
    $conn->query("DELETE FROM gallery WHERE id='$id'");
    echo "<script>location.href='admin.php?page=gallery'</script>";
}
?>

<script>
$('#search').keyup(function () {
    $.post('gallery_search.php', {
        keyword: $(this).val()
    }, function (data) {
        $('#result').html(data);
    });
});
</script>