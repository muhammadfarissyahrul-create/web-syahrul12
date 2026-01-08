<?php
include 'koneksi.php';
?>
<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="w-25">Judul</th>
                        <th class="w-50">Isi</th>
                        <th class="w-50">Gambar</th>
                        <th class="w-25">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                        $hasil = $conn->query($sql);

                        $no = 1;
                        while ($row = $hasil->fetch_assoc()) {
                    ?>
                  												<tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <strong><?= $row["judul"] ?></strong>
                                <br>pada : <?= $row["tanggal"] ?>
                                <br>oleh : <?= $row["username"] ?>
                            </td>
                            <td><?= $row["isi"] ?></td>
                            <td>
                                <?php
                                    if ($row["gambar"] != '') {
                                        if (file_exists('img/' . $row["gambar"] . '')) { 
                                            echo '<img src="img/' . $row["gambar"] . '" class="img-fluid" alt="Gambar Artikel">'; 
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <!-- untuk tombol aksi update dan delete -->
                            </td>
                        </tr>
                <?php        
                }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>