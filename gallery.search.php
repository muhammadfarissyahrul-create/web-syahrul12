<?php
include "../koneksi.php";

$keyword = $_POST['keyword'] ?? '';

$sql = "SELECT * FROM gallery 
        WHERE deskripsi LIKE '%$keyword%' 
        ORDER BY tanggal DESC";

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

    <td>
        <?php if ($row["gambar"] && file_exists('../img/' . $row["gambar"])) { ?>
            <img src="../img/<?= $row["gambar"] ?>" class="img-fluid">
        <?php } ?>
    </td>

    <td>
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
<?php } ?>