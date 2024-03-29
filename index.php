<?php
include 'pages/Koneksi.php';
session_start();

if (isset($_SESSION['nama']) && isset($_SESSION['id_aktor'])) {
  if (isset($_SESSION['role']) == 'Siswa') {
    header("Location: home.php");
  }
  if (isset($_SESSION['role']) == 'Admin') {
    header("Location: pages/Admin/Dashboard_Admin.php");
  }
  if (isset($_SESSION['role']) == 'Super Admin') {
    header("Location: pages/Super Admin/Dashboard_SuperAdmin.php");
  }
  exit();
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password']; // Hash the input password using SHA-256

  $sql2 = "SELECT * FROM aktor WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql2);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['role'] == 'Siswa') {
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_aktor'] = $row['id_aktor'];
      $_SESSION['jurusan_id'] = $row['jurusan_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['role'] = $row['role'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['tingkat'] = $row['tingkat'];
      header("Location: home.php");
      exit();
    }
    if ($row['role'] == 'Admin') {
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_aktor'] = $row['id_aktor'];
      $_SESSION['jurusan_id'] = $row['jurusan_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['tingkat'] = $row['tingkat'];
      header("Location: pages/Admin/Dashboard_Admin.php");
      exit();
    }
    if ($row['role'] == 'Super Admin') {
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_aktor'] = $row['id_aktor'];
      $_SESSION['jurusan_id'] = $row['jurusan_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['tingkat'] = $row['tingkat'];
      header("Location: pages/Super Admin/Dashboard_SuperAdmin.php");
      exit();
    }
  } else {
    echo "<script>alert('Email atau password Anda salah. Silakan coba lagi!')</script>";
  }
}
?>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM aktor a";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homepage Tanpa Login</title>

  <!-- My Own Styles -->
  <link rel="stylesheet" href="dist/css/styl.css">
  <link rel="stylesheet" href="dist/css/style2.css">


  <!-- Favicons -->
  <link rel="icon" type="image/png" href="dist/img/Jokotole.png" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- Vendor CSS Files -->
  <link href="dist/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="dist/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <link href="dist/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <!-- <link href="dist/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="dist/assets/css/main.css" rel="stylesheet">

</head>

<body style="background-color: darkslategray;">
  <!-- Menu header -->

  <nav>
    <a href="#" class="logo"><img src="dist/img/logo.png"></a>
    <div class="navbar">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#Merchandise">Merchandise</a></li>
        <li><a href="#galeri">Galeri Prestasi</a></li>
        <li><a class="nav-link nav-active" href="Contact" data-toggle="modal" data-target="#myModal">Contact</a></li>
      </ul>
    </div>

    <div class="log">
      <ul>
        <li><a href="" onclick="confirmAction()" data-toggle="modal" data-target="#myModal">Login</a></li>
        <li><a href="#" class="sign">Sign Up</a></li>
      </ul>
    </div>
  </nav>

  <div class="content" style="background-image: url(dist/img/gmb.png);min-height: 100vh;">
    <div class="imgbox">
      <img src="dist/img/silat.png" class="silat">
    </div>
    <div class="textbox">
      <h1>PPS JOKOTOLE<br> DIKLAT KODIM 0829</h1>
      <a href="#">Daftar Sekarang</a>
    </div>
  </div>


  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about" style="color: white;">

      <!-- Modal -->

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
          <div class="modal-content shadow">
            <div class="modal-header bg-light shadow-sm" style="background-color: #BED25E !important;">
              <h5 class="modal-title" id="exampleModalLabel">Login</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-5">
                    <div class="image">
                      <img src="dist/img/Jokotole.png" width="150" class="img-fluid" alt="">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <form action="" method="POST" class="login-email">
                      <p class="login-text">Login</p>
                      <div class="input-group">
                        <label for="email" style="color: slategray;">Email * </label>
                        <input type="email" class="form-control form-control-sm" style="width: 20%;" id="email" name="email" placeholder="Enter email" required>
                      </div>
                      <br>
                      <div class="input-group">
                        <label for="password" style="color: slategray;">Password * </label>
                        <input type="password" class="form-control form-control-sm" style="width: 20%;" placeholder="Password" name="password" required>
                      </div><br>
                      <div class="input-group">
                        <button name="submit" class="btn btn-primary">Login</button>
                      </div>
                      <!-- <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p> -->
                    </form>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer shadow-sm" style="background-color: #BED25E;">
            </div>
          </div>
        </div>
      </div>

      <div class="container" id="about" data-aos="fade-up">

        <div class="section-header">
          <h2>Profil Perguruan</h2>
          <p style="color: white;">Jokotole merupakan sebuah Perguruan pencak silat yang ada di madura, jawa timur.</p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-6">
            <img src="dist/img/Jokotole.png" style="width: 60%;" class="img-fluid rounded-4 mb-4" alt="">
          </div>
          <div class="col-lg-6">
            <h3 style="background-color: dimgrey; color:yellow; padding:2%; border-radius:20px; border:4px solid white;">Sejarah</h3>
            <p class="fst-italic" style="text-align: justify;">
              <?php
              $koneksi = mysqli_connect("localhost", "root", "", "jokotole");
              $sql = "SELECT * FROM profile_perguruan pm";
              $hasil = mysqli_query($koneksi, $sql);
              $baris = mysqli_fetch_assoc($hasil);
              echo $baris['sejarah']
              ?>
            </p>
            <h3 style="background-color: dimgrey; color:yellow; padding:2%; border-radius:20px; border:4px solid white;">Visi & Misi</h3>
            <p class="fst-italic" style="text-align: justify;">
              <?php
              echo $baris['visi_misi']
              ?>
            <h3 style="background-color: dimgrey; color:yellow; padding:2%; border-radius:20px; border:4px solid white;">Makna Lambang</h3>
            <p class="fst-italic" style="text-align: justify;">
              <?php
              echo $baris['arti_lambang']
              ?>
            </p>
          </div>
        </div>
      </div>
    </section><!-- End About Us Section -->

    <section>
      <div class="container" data-aos="fade-up">
        <div class="section-header" style="color: white;">
          <h2>Maps Perguruan</h2>
          <?php
          echo $baris['frame_map']
          ?>
        </div>
      </div>
      <style>
        p.konten1 {
          max-width: 180px;
          word-wrap: break-word;
          /* Memaksa teks untuk mematahkan secara otomatis */
        }


        .flex-contain {
          display: flex;
          flex-direction: row;
          align-items: flex-start;
        }

        .btpesan {
          position: static;
          border: 2px solid black;
          border-radius: 25px;
          margin-top: 1.7rem;
          margin-right: 0.2rem;
          width: 10rem;
          height: 2rem;
          font-size: medium;
          font-weight: 700;
          font-family: 'Poppins', sans-serif;
          align-self: flex-starct;
          cursor: pointer;

        }

        .btpesan:hover {
          background: #33b249;
          color: white;
        }

        .grid {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          margin: 80px;
          grid-gap: 30px;
        }

        article>img {
          object-fit: cover;
        }



        .grid>article {
          box-shadow: 10px 5px 5px 0px black;
          border-radius: 30px;
          text-align: left;
          background: #3D553D;
          width: 350px;
          height: 375px;
          transition: transform;
        }

        .grid>article img {
          border-top-left-radius: 30px;
          border-top-right-radius: 30px;
        }


        .grid>article:hover {
          transform: scale(1.2);
        }

        @media (max-width:1200px) {
          .grid {
            grid-template-columns: repeat(2, 1fr);
          }
        }

        @media (max-width:900px) {
          .grid {
            grid-template-columns: repeat(1, 1fr);
            align-items: center;
          }
        }
      </style>
      <?php
      require 'pages/Super Admin/koneksidbMerch.php';

      $merchandise = query("SELECT * FROM merchandise");


      ?>
      <div class="container" data-aos="fade-up" id="Merchandise">
        <div class="section-header" style="color: white;">
          <h2> MERCHANDISE</h2>
          <div style="justify-content: center;">
            <main class="grid">
              <?php foreach ($merchandise as $row) : ?>
                <article>
                  <img src="dist/img/<?php echo $row["foto_merchandise"]; ?>" width="350px" height="210px" />
                  <div class="konten">
                    <div class="flex-contain">
                      <div class="konten1" style=" flex-grow:8;">
                        <h2 style="margin-left: 5px; margin-top: 1px; ont-family:'Poppins', sans-serif;  color:white;"><?= $row["nama_merchandise"]; ?></h2>
                        <h3 style="margin-left: 5px; margin-top: 1px; font-family:'Poppins', sans-serif;  color:white; font-size:medium;">Rp.<?= $row["harga_merchandise"]; ?></h3>
                        <p style="margin-left: 7px; margin-top: 1px; font-family:'Poppins', sans-serif;  color:white; font-size:x-small;"><?= $row["deskripsi_merchandise"]; ?></p>
                      </div>
                      <div class="konten2">
                        <a href="pages/Murid/Beli_Merchandise.php"><button class="btpesan">Pesan Sekarang</button></a>
                      </div>
                    </div>
                  </div>
                </article>
              <?php endforeach; ?>
            </main>
          </div>
        </div>
      </div>
    </section>


    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action">
      <div class="container text-center" data-aos="zoom-out">
        <a href="https://youtu.be/Fd3pnuK7nqU?si=t7n6ZE1QjYF3oJ2Q" class="glightbox play-btn"></a>
        <h3>Video Latihan</h3>
        <p> Perguruan Pencak Silat Jokotole Diklat Kodim 0829.</p>
        <a class="cta-btn" href="https://youtu.be/Fd3pnuK7nqU?si=t7n6ZE1QjYF3oJ2Q" target="_blank">Tonton</a>
      </div>
    </section><!-- End Call To Action Section -->



    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <span>Joktole Kodim 0829</span>
            </a>
            <p>xnjnjnj djndknfkd kmkmkd mkmkmkd</p>
            <div class="social-links d-flex mt-4">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Merchandise</a></li>
              <li><a href="#">Galeri Prestasi</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>


          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              Jl cikini digondang dia <br>
              Bangkalan, Jawa Timur<br>
              Indonesia <br><br>
              <strong>Phone:</strong> +6273728483943<br>
              <strong>Email:</strong> kodim0829@gmail.com<br>
            </p>

          </div>
          <div class="col-lg-2 col-6 footer-links">
            <img src="dist/img/Jokotole.png" alt="">
          </div>

        </div>
      </div>

      <div class="container mt-4">
        <div class="copyright">
          &copy; Copyright <strong><span>JoktoleKodim0829</span></strong>.
        </div>
      </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- <div id="preloader"></div> -->

    <!-- Vendor JS Files -->
    <script src="dist/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <!-- Template Main JS File -->
    <script src="dist/assets/js/main.js"></script>
    <script>
      $(document).ready(function() {
        $("#myBtn").click(function() {
          $("#myModal").modal();
        });
      });
    </script>

</body>

</html>
<!-- javascript -->
<script src="dist/js/script.js"></script>

</body>