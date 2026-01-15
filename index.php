<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Real Madrid Journal</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="icon" href="img/realmadrid_logo.png" />

    <style>
      body {
        background-color: #f8f9fa;
        color: black;
      }

      .navbar {
        background: linear-gradient(to right, #ffffff, #00529f);
        border-bottom: 3px solid gold;
      }

      .navbar-brand {
        font-weight: bold;
        color: #002e6e !important;
      }

      .nav-link {
        color: #002e6e !important;
        font-weight: 500;
      }

      
      #hero {
        background: url("https://www.barcelo.com/guia-turismo/wp-content/uploads/2019/03/santiago-bernabeu-1.jpg") center/cover no-repeat;
        text-shadow: 2px 2px 8px black;

        background-color: rgba(0, 82, 159, 0.5);
        background-blend-mode: darken;

        color: white !important; 
      }

      .card-title {
        color: #002e6e;
        font-weight: bold;
      }

      #gallery {
        background-color: #e8edf3;
      }

      .accordion-button:not(.collapsed) {
        background-color: #002e6e;
        color: white;
      }

      footer {
        background: #002e6e;
        color: white;
        border-top: 3px solid gold;
      }

      #scrollTopBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 22px;
        border: none;
      }

      
      .dark-mode,
      .dark-mode * {
        color: white !important;
      }

      .dark-mode {
        background-color: #121212 !important;
      }

      .dark-mode .navbar {
        background: #000 !important;
        border-bottom: 3px solid gold;
      }

      .dark-mode #gallery {
        background-color: #222 !important;
      }

      .dark-mode .card {
        background-color: #1e1e1e !important;
      }

      .dark-mode footer {
        background: #000 !important;
      }

      .dark-mode .accordion-button {
        background-color: #333 !important;
      }

      .dark-mode .accordion-body {
        background-color: #1a1a1a !important;
      }

      .dark-mode #hero {
        background-color: rgba(0, 0, 0, 0.5) !important;
        background-blend-mode: darken;
        text-shadow: none !important;
      }

      .dark-mode .border {
        border-color: #555 !important;
      }
    </style>
  </head>

  <body>
    
    <nav class="navbar navbar-expand-lg sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">Real Madrid Journal</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutme">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>

            
            <li class="nav-item">
              <button id="darkBtn" class="btn btn-dark ms-3">
                <i class="bi bi-moon"></i> Dark
              </button>
            </li>

            <li class="nav-item">
              <button id="lightBtn" class="btn btn-light ms-2">
                <i class="bi bi-brightness-high"></i> Light
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section id="hero" class="text-center p-5">
      <div class="container py-5">
        <h1 class="fw-bold display-3">Real Madrid</h1>
        <h4 class="lead display-6">
          Klub sepak bola legendaris asal Spanyol dengan sejarah panjang dan
          prestasi luar biasa
        </h4>
        <h6>
          <span id="tanggal"></span>
          <span id="jam"></span>
        </h6>
      </div>
    </section>
  
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Real Madrid Article</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
       		<?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while ($row = $hasil->fetch_assoc()){
 
        ?>
                <!-- Card 1 -->
                <div class="col">
                    <div class="card h-100">
                        <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row["judul"]?></h5>
                            <p class="card-text">
                                <?= $row["isi"]?>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">
                                <?= $row["tanggal"]?>
                            </small>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
        
        </div>
      </div>
    </section>

<section id="GALLERY" class="text-center p-5 bg-info-subtle">
    <div class="container">
        <h1 class="fw-bold display-6 pb-3">Gallery</h1>

        <?php
        $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
        $hasil = $conn->query($sql);
        $active = true;
        ?>

        <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <?php while ($row = $hasil->fetch_assoc()) { ?>
                    <div class="carousel-item <?= $active ? 'active' : '' ?>">
                        <img src="img/<?= $row['gambar'] ?>"
                             class="d-block w-100"
                             style="max-height:800px; object-fit:cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <h5><?= $row['deskripsi'] ?></h5>
                            <small><?= $row['tanggal'] ?></small>
                        </div>
                    </div>
                <?php $active = false; } ?>

            </div>

            <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselGallery" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselGallery" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>
    <section id="schedule" class="text-center p-5">
      <h1 class="fw-bold display-4 pb-3">Schedule</h1>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 g-4 justify-content-center">
        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-book text-danger fs-1"></i>
            <h5 class="mt-3">Membaca</h5>
            <p>Menambah wawasan setiap pagi sebelum beraktivitas.</p>
          </div>
        </div>

        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-laptop text-danger fs-1"></i>
            <h5 class="mt-3">Menulis</h5>
            <p>Mencatat setiap pengalaman harian di jurnal pribadi.</p>
          </div>
        </div>

        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-people text-danger fs-1"></i>
            <h5 class="mt-3">Diskusi</h5>
            <p>Bertukar ide dengan teman kelompok belajar.</p>
          </div>
        </div>

        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-bicycle text-danger fs-1"></i>
            <h5 class="mt-3">Olahraga</h5>
            <p>Menjaga kesehatan dengan bersepeda sore hari.</p>
          </div>
        </div>

        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-film text-danger fs-1"></i>
            <h5 class="mt-3">Movie</h5>
            <p>Menonton film yang bagus di bioskop.</p>
          </div>
        </div>

        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-bag text-danger fs-1"></i>
            <h5 class="mt-3">Belanja</h5>
            <p>Membeli kebutuhan bulanan di supermarket.</p>
          </div>
        </div>
      </div>
    </section>

    <section id="aboutme" class="p-4 rounded shadow-sm mb-4" style="background-color: #f8d7da">
      <h2 class="text-center mb-4 fw-bold">About Me</h2>

      <div class="accordion" id="accordionAboutMe">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
              Universitas Dian Nuswantoro Semarang (2024–Now)
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionAboutMe">
            <div class="accordion-body">
              <strong>Mata Kuliah Pemograman Berbasis Web.</strong> Ini adalah masa saya menjadi mahasiswa di UDINUS, belajar pemrograman web dan teknologi digital.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
              MA Futuhiyyah 01 (2021–2024)
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionAboutMe">
            <div class="accordion-body">
              Masa SMA penuh kenangan. Saya termasuk murid yang nakal, saya sering tidak masuk kelas dan pergi bermain bersama teman-teman saya.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
              MTs Futuhiyya 01 (2018–2021)
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionAboutMe">
            <div class="accordion-body">
             Masa MTs adalah masa awal saya menyukai dunia sepakbola, dan tim yang membuat saya jatuh hati adalah Real Madrid..
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="text-center p-4">
      <div class="pb-2">
        <i class="h2 bi bi-instagram p-2"></i>
        <i class="h2 bi bi-twitter p-2"></i>
        <i class="h2 bi bi-whatsapp p-2"></i>
      </div>
      <p class="mb-0">Faris Syahrul © 2025</p>
    </footer>

    <button id="scrollTopBtn" class="btn btn-warning">↑</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      function updateDateTime() {
        const sekarang = new Date();
        const options = { day: "2-digit", month: "long", year: "numeric" };
        const tanggal = sekarang.toLocaleDateString("id-ID", options);

        let jam = sekarang.getHours().toString().padStart(2, "0");
        let menit = sekarang.getMinutes().toString().padStart(2, "0");
        let detik = sekarang.getSeconds().toString().padStart(2, "0");

        document.getElementById("tanggal").textContent = tanggal + " | ";
        document.getElementById("jam").textContent =
          jam + ":" + menit + ":" + detik;
      }

      setInterval(updateDateTime, 1000);
      updateDateTime();
    </script>

    <script>
      const scrollBtn = document.getElementById("scrollTopBtn");

      window.onscroll = function () {
        if (
          document.body.scrollTop > 200 ||
          document.documentElement.scrollTop > 200
        ) {
          scrollBtn.style.display = "block";
        } else {
          scrollBtn.style.display = "none";
        }
      };

      scrollBtn.addEventListener("click", function () {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      });
    </script>

    <script>
      const darkBtn = document.getElementById("darkBtn");
      const lightBtn = document.getElementById("lightBtn");

      darkBtn.addEventListener("click", function () {
        document.body.classList.add("dark-mode");
      });

      lightBtn.addEventListener("click", function () {
        document.body.classList.remove("dark-mode");
      });
    </script>
  </body>
</html>
