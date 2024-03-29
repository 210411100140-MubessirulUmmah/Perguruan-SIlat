<?php

session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM aktor a";
$hasil = mysqli_query($koneksi, $sql);
require_once("pages/Koneksi.php");
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $id_aktor = $_POST['id_aktor'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($message)) {
        $query = "INSERT INTO message VALUES('','$id_aktor','$nama','$email','$message','')";
        $queryact = mysqli_query($koneksi, $query);
        echo ("<script>location.href = 'home.php';</script>");
    }
}

?>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

$data_materi = "SELECT * FROM materi";
$hasil_materi = mysqli_query($koneksi, $data_materi);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homepage</title>

    <!-- My Own Styles -->
    <link rel="stylesheet" href="dist/css/styl.css">
    <link rel="stylesheet" href="dist/css/style2.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

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
        <div class="navbar" style="margin-left: 10%;">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#Merchandise">Merchandise</a></li>
                <li><a href="#galeri">Galeri Prestasi</a></li>
                <li><a href="#Contact">Contact</a></li>
            </ul>
        </div>
        <div class="log" style="margin-left: 3%;">
            <a class="fa fa-bell" style="color: white !important;" data-toggle="modal" data-target="#notif"></a>
        </div>
        <?php
        $aktorr = $_SESSION['id_aktor'];
        $conn = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
        ?>
        <?php
        $bariss = mysqli_fetch_assoc($hasill);
        $warna = $bariss['jurusan_id'];
        if ($warna == '1') {
            $background = 'background-color:seagreen;';
            $namajurusan = 'Belum Menentukan Jurusan';
        }
        if ($warna == '2') {
            $background = 'background-color:tomato;';
            $namajurusan = 'Jurusan Tanding';
        }
        if ($warna == '3') {
            $background = 'background-color:steelblue;';
            $namajurusan = 'Jurusan Seni';
        }
        ?>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <ul class="dropdown-menu">
                </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $bariss['nama'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <div class="log" id="navbarSupportedContent">
                            <div class="card" style="width: 18rem;">
                                <div style="<?= $background; ?>;">
                                    <img class="" src="dist/img/<?php echo $bariss['foto'] ?>" style="padding: 2%; border-radius: 50%; width:40%" alt="Card image cap">
                                    <div class="card-body" style="color: white;">
                                        <h5 class="card-title"><?php echo $bariss['nama'] ?></h5>
                                        <p class="card-text"><?= $namajurusan; ?></p>
                                    </div>
                                </div>

                                <div class="card-body" style="text-align: right;">
                                    <a href="pages/Murid/Dashboard_Murid.php" class="btn btn-dark">Profil</a>
                                    <a href="pages/logout.php" class="btn btn-dark">Logout</a>
                                </div>
                            </div>
                    </ul>
                </li>
            </ul>
        </div>

        </div>



    </nav>


    <div class="content" style="background-image: url(dist/img/gmb.png);min-height: 100vh;">
        <div class="imgbox">
            <img src="dist/img/silat.png" class="silat">
        </div>
        <div class="textbox">
            <h2 class="display-4 text-secondary mt-5" style="color: #ffc !important;">Halo..!! <?php echo $_SESSION['nama']; ?></h2>
            <h2 class="display-3 text-primary" style="color: #ffc139 !important;">Selamat datag<br>di PPS JOKOTOLE DIKLAT KODIM 0829</h2>
        </div>
    </div>
    <section>
        <?php


        if (!isset($_SESSION['nama'])) {
            header("Location: index.php");
        }
        require_once("pages/Koneksi.php");
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $id_aktor = $_POST['id_aktor'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            if (!empty($message)) {
                $query = "INSERT INTO message VALUES('','$id_aktor','$nama','$email','$message','')";
                $queryact = mysqli_query($koneksi, $query);
                echo ("<script>location.href = 'home.php';</script>");
            }
        }

        $tgl = "SELECT CONCAT(DATE_FORMAT(NOW(), '%M'), ' ',  YEAR(NOW())) AS tanggal";
        $tanggal = mysqli_query($koneksi, $tgl);
        $tgll = mysqli_fetch_assoc($tanggal);
        $bulan = $tgll['tanggal'];

        $id_aktor = $_SESSION['id_aktor'];

        $deadline_spp = "SELECT deadline_pembayaran AS deadline FROM pembayaran_spp WHERE murid_id = $id_aktor AND bulan = '$bulan'";
        $ds = mysqli_query($koneksi, $deadline_spp);
        $dspp = mysqli_fetch_assoc($ds);
        $deadline = $dspp['deadline'];


        $status_bayar = "SELECT status_bayar AS sb FROM pembayaran_spp WHERE murid_id = $id_aktor AND bulan = '$bulan'";
        $sb = mysqli_query($koneksi, $status_bayar);
        $status_byr = mysqli_fetch_assoc($sb);
        $s_b = $status_byr['sb'];

        $harini = "SELECT DATE_FORMAT(CURDATE(), '%Y-%m-%d') AS tanggal_hari_ini";
        $hi = mysqli_query($koneksi, $harini);
        $hr_ini = mysqli_fetch_assoc($hi);
        $hari_ini = $hr_ini['tanggal_hari_ini'];

        $selisih_tgl = "SELECT DATEDIFF('$hari_ini', '$deadline') AS selisih_hari";
        $st = mysqli_query($koneksi, $selisih_tgl);
        $selisih_tanggal = mysqli_fetch_assoc($st);
        $slsh_tgl = $selisih_tanggal['selisih_hari'];

        if ($slsh_tgl >= 1 && $s_b == 'BELUM LUNAS') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:7rem">
                        <strong>Halo ' . $_SESSION['nama'] . '!</strong> Anda Belum Melakukan Pembayaran SPP pada bulan ' . $bulan . ' , Diharapkan segera melakukan Pembayaran SPP
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
        }
        ?>

    </section>


    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero mt-0" style="background-color:transparent;">

        <div class="icon-boxes position-relative" style="background-color: transparent;">
            <div class="container position-relative" style="background-color: transparent;">
                <div class="row gy-4 mt-5" style="background-color: transparent;">

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-database"></i></div>
                            <?php
                            $sql = "SELECT COUNT(*) as jumlah_siswa FROM aktor WHERE role = 'siswa'";
                            $hasil = mysqli_query($koneksi, $sql);
                            $data = mysqli_fetch_assoc($hasil);
                            $jumlahSiswa = $data['jumlah_siswa'];
                            ?>

                            <h2 class="title"><a href="" class="stretched-link"><?php echo $jumlahSiswa; ?></a></h2>

                            <h4 class="title"><a href="" class="stretched-link">Jumlah Siswa</a></h4>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-database"></i></div>
                            <?php
                            $sql3 = "SELECT COUNT(*) as tanding
              FROM aktor
              JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan
              WHERE jurusan.id_jurusan = 2 AND aktor.role = 'Siswa';
              ";
                            $hasil3 = mysqli_query($koneksi, $sql3);
                            $data3 = mysqli_fetch_assoc($hasil3);
                            $jumlahSiswaTanding = $data3['tanding'];
                            ?>
                            <h2 class="title"><a href="" class="stretched-link"><?php echo $jumlahSiswaTanding; ?></a></h2>

                            <h4 class="title"><a href="" class="stretched-link">Jumlah Siswa Tanding</a></h4>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-geo-alt"></i></div>
                            <?php
                            $sql3 = "SELECT COUNT(*) as seni
              FROM aktor
              JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan
              WHERE jurusan.id_jurusan = 3 AND aktor.role = 'Siswa';
              ";
                            $hasil3 = mysqli_query($koneksi, $sql3);
                            $data3 = mysqli_fetch_assoc($hasil3);
                            $jumlahSiswaSeni = $data3['seni'];
                            ?>
                            <h2 class="title"><a href="" class="stretched-link"><?php echo $jumlahSiswaSeni; ?></a></h2>
                            <h4 class="title"><a href="" class="stretched-link">Jumlah Siswa Seni</a></h4>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-command"></i></div>
                            <?php
                            $sql4 = "SELECT COUNT(*) as belum
              FROM aktor
              JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan
              WHERE jurusan.id_jurusan = 1 AND aktor.role = 'Siswa';
              ";
                            $hasil4 = mysqli_query($koneksi, $sql4);
                            $data4 = mysqli_fetch_assoc($hasil4);
                            $BelumMenentukan = $data4['belum'];
                            ?>
                            <h2 class="title"><a href="" class="stretched-link"><?php echo $BelumMenentukan; ?></a></h2>
                            <h4 class="title"><a href="" class="stretched-link">Belem Menentukan Jurusan</a></h4>
                        </div>
                    </div><!--End Icon Box -->

                </div>
            </div>
        </div>

    </section>
    <!-- End Hero Section -->




    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about" style="color: white; margin-top:-20px !important;">


            <div class="container" data-aos="fade-up" id="about">

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


        <section style="margin-top: -50px !important;">
            <div class="container" data-aos="fade-up">
                <div class="section-header" style="color: white;">
                    <h2>Maps Perguruan</h2>
                    <?php
                    echo $baris['frame_map']
                    ?>
                </div>
            </div>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap');

                body {
                    background: #242624;
                }

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


        <section id="kelayakan" class="about" style="color: white; margin-top:-20px !important;">


            <div class="container" data-aos="fade-up" id="about">

                <div class="section-header">
                    <h2>Kelayakan</h2>

                </div>

                <div class="row gy-4">
                    <div class="col-lg-12" style="display: flex; align-items: center; justify-content: center;">
                        <div class="card" style="width: 750px; background-color: #fff; " style="align-items: center;">
                            <div class="card-body" style="background-color: #fff;">
                                <div class="card" style="background-color: #fff;">
                                    <div class="row no-gutters" style="background-color: #fff;">
                                        <div class="col-md-6" style="background-color: #fff; ">
                                            <img src="dist/img/<?php echo $bariss['foto'] ?>" class=" card-img" alt="Gambar Materi" style="width:300px; margin-bottom: 30px">
                                            <div style="display:flex; justify-content:center; align-items:center; background-color: #fff;">
                                                <a href="pages/Murid/Syarat_Kelayakan.php" class="btn btn-success">Lihat Syarat Kelayakan</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="background-color: #fff;">
                                            <div class="card-body" style="background-color: #fff;">
                                                <h2 style="background-color: #fff; font-weight: bold;"><?php echo $bariss['nama'] ?></h2>
                                                <?php

                                                $konek = mysqli_connect("localhost", "root", "", "jokotole");
                                                $kolom_hafal = array(
                                                    'salam_perguruan', 'dasar_kaki', 'dasar_tangan', 'jurus_tangan', 'jurus_kaki',
                                                    'langkah_segitiga', 'hindaran', 'zigzag_abc', 'pasangan', 'seni'
                                                );
                                                // $query_murid = "SELECT nama, id_kelayakan, jumlah_pertemuan, salam_perguruan, dasar_kaki, dasar_tangan, jurus_tangan, jurus_kaki, langkah_segitiga, hindaran, zigzag_abc, pasangan, seni, pertemuan_latihan_fisik  FROM aktor inner join kelayakan_naik_tingkat on aktor.id_aktor = kelayakan_naik_tingkat.murid_id where role='Siswa' AND id_aktor = $aktorr";
                                                $query_murid = "SELECT nama, id_kelayakan, jumlah_pertemuan, pertemuan_latihan_fisik, status_kelayakan, tingkatan, " . implode(", ", $kolom_hafal) . " FROM aktor INNER JOIN kelayakan_naik_tingkat ON aktor.id_aktor = kelayakan_naik_tingkat.murid_id WHERE role='Siswa' AND id_aktor = $aktorr";
                                                $isi = mysqli_query($konek, $query_murid);

                                                $no = 1;
                                                ?>
                                                <?php while ($data_baru = mysqli_fetch_assoc($isi)) {
                                                    $jumlah_materi_dihafal = 0;
                                                    foreach ($kolom_hafal as $kolom) {
                                                        if ($data_baru[$kolom] == 'hafal') {
                                                            $jumlah_materi_dihafal++;
                                                        }
                                                    } ?>
                                                    <p style="background-color: #fff;"> Jumlah Pertemuan : <?php echo $data_baru['jumlah_pertemuan'] ?> </p>
                                                    <p style="background-color: #fff;"> Materi Dikuasai : <?php echo $jumlah_materi_dihafal ?> </p>
                                                    <ol style="background-color: #fff;">
                                                        <?php
                                                        foreach ($kolom_hafal as $kolom) {


                                                            if (($data_baru[$kolom]) == 'hafal') {
                                                                if (!function_exists('hapusUnderscore')) {
                                                                    // Fungsi untuk menghapus karakter _ dari sebuah string
                                                                    function hapusUnderscore($string)
                                                                    {
                                                                        return str_replace('_', ' ', $string);
                                                                    }
                                                                }

                                                                // Mengecek apakah fungsi formatString() sudah dideklarasikan sebelumnya
                                                                if (!function_exists('formatString')) {
                                                                    // Fungsi untuk mengganti karakter _ menjadi spasi dan mengubah huruf depan menjadi kapital
                                                                    function formatString($string)
                                                                    {
                                                                        $stringWithoutUnderscore = hapusUnderscore($string);
                                                                        $formattedString = ucwords(str_replace('_', ' ', $stringWithoutUnderscore));

                                                                        return $formattedString;
                                                                    }
                                                                }
                                                                $kolomtampil = formatString($kolom); ?>

                                                                <li style="background-color: #fff;"><?php echo $kolomtampil; ?></li>

                                                        <?php }
                                                        }
                                                        ?>
                                                    </ol>
                                                    <p style="background-color: #fff;"> Fisik : <?php echo $data_baru['pertemuan_latihan_fisik'] ?> </p>
                                                    <?php
                                                    $tingkatawal = $data_baru['tingkatan'];
                                                    if ($tingkatawal == 1) {
                                                        $tingkatawal = 'Putih';
                                                        $tingkattujuan = 'Kuning 1';
                                                    }
                                                    if ($tingkatawal == 2) {
                                                        $tingkatawal = 'Kuning 1';
                                                        $tingkattujuan = 'Kuning 2';
                                                    }
                                                    if ($tingkatawal == 3) {
                                                        $tingkatawal = 'Kuning 2';
                                                        $tingkattujuan = 'Merah';
                                                    }
                                                    ?>
                                                    <p style="background-color: #fff;"> Tingkat : <?php echo $tingkatawal ?> -> <?php echo $tingkattujuan ?></p>
                                                    <p style="background-color: #fff;"> Status : <?php echo $data_baru['status_kelayakan'] ?> </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content" style="padding-top:50px">
            <div class="container" id="about">

                <div class="section-header">
                    <h2 style="color: white;">Materi Dasar</h2>
                </div>
                <div style="background-color: darkslategray;">

                    <div class="container-fluid">
                        <div class="row">
                            <?php while ($data_materi = mysqli_fetch_assoc($hasil_materi)) { ?>
                                <div class="col-md-6">
                                    <div class="card" style="width: 600px; background-color: #fff; ">

                                        <div class="card-body" style="background-color: #fff;">
                                            <div class="card" style="background-color: #fff;">
                                                <div class="row no-gutters d-flex justicy-content-center align-items-center" style="background-color: #fff;">
                                                    <div class="col-md-5 d-flex justicy-content-center align-items-center" style="background-color: #fff;">
                                                        <img src="../../dist/assets/img/materi/<?php echo $data_materi["foto_materi"]; ?>" class="card-img" alt="Gambar Materi">
                                                    </div>
                                                    <div class="col-md-7" style="background-color: #fff;">
                                                        <div class="card-body" style="background-color: #fff;">
                                                            <h5 class="card-title" style="background-color: #fff;"><b><?php echo $data_materi["nama_materi"]; ?></b></h5>
                                                            <p class="card-text" style="background-color: #fff;"><?php echo $data_materi["deskripsi_materi"]; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </section>

        <section>
            <div class="modal fade" id="notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal" role="document">
                    <div class="modal-content shadow">
                        <div class="modal-header bg-light shadow-sm" style="background-color: #BED25E !important;">
                            <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12" style="color: black;">
                                        <?php
                                        $sql = "SELECT * FROM message m WHERE id_aktor = $aktorr";
                                        $hasil = mysqli_query($koneksi, $sql);
                                        $no = 1;
                                        while ($baris = mysqli_fetch_assoc($hasil)) {
                                        ?>
                                            <td style="padding: 2%;">
                                                <p><b>
                                                        <?php
                                                        $pertanyaan = substr($baris['message'], 0, 30);
                                                        echo $pertanyaan, '... :'; ?>
                                                    </b></p>
                                                <p><?php echo $baris['balasan']; ?></p>
                                            </td>
                                        <?php } ?>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer shadow-sm" style="background-color: #BED25E;">
                            </div>
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


        <section id="Contact" class="contact section-bg" style="background-color: white;">
            <div class="container">
                <div class="section-title">
                    <h2 class="display-4 text-primary mt-5 text-center" style="color: #ffc139 !important;" id="sec4">Contact</h2>
                    <p>Hubungi kami jika ada kritik, masukan, dan saran!</p>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="info d-flex flex-column justify-content-center" data-aos="fade-right">
                            <div class="address">
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg></i>
                                <h4>Location:</h4>
                                <p>Jl. KH. Ach. Marzuki,<br>Pangeranan, Bangkalan</p>
                            </div>
                            <div class="emailcon">
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                                    </svg></i>
                                <h4>Email:</h4>
                                <p>mubarijojo.ummah11@gmail.com</p>
                            </div>
                            <div class="phone">
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 28.314 28.323">
                                        <path d="m27.728 20.384-4.242-4.242a1.982 1.982 0 0 0-1.413-.586h-.002c-.534 0-1.036.209-1.413.586L17.83 18.97l-8.485-8.485 2.828-2.828c.78-.78.78-2.05-.001-2.83L7.929.585A1.986 1.986 0 0 0 6.516 0h-.001C5.98 0 5.478.209 5.101.587L.858 4.83C.729 4.958-.389 6.168.142 8.827c.626 3.129 3.246 7.019 7.787 11.56 6.499 6.499 10.598 7.937 12.953 7.937 1.63 0 2.426-.689 2.604-.867l4.242-4.242c.378-.378.587-.881.586-1.416 0-.534-.208-1.037-.586-1.415zm-5.656 5.658c-.028.028-3.409 2.249-12.729-7.07C-.178 9.452 2.276 6.243 2.272 6.244L6.515 2l4.243 4.244-3.535 3.535a.999.999 0 0 0 0 1.414l9.899 9.899a.999.999 0 0 0 1.414 0l3.535-3.536 4.243 4.244-4.242 4.242z" />
                                    </svg>
                                </i>
                                <h4>Call:</h4>
                                <p>082139732198</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mt-5 mt-lg-0">
                        <h3 class="text-secondary mb-0">Dari : <?php echo $_SESSION['nama']; ?></h3> <br>
                        <form action="" method="post" role="form" class="php-email-form" data-aos="fade-left" style="background-color: transparent;">
                            <div class="row">
                                <div class="col-md-6 form-group mt-0">
                                    <input type="hidden" name="nama" class="form-control" value="<?php echo $_SESSION['nama']; ?>" required>
                                </div>
                                <div class="col-md-6 form-group mt-0">
                                    <input type="hidden" id="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" name="email" required>
                                </div>
                                <div class="col-md-6 form-group mt-0">
                                    <input type="hidden" id="id_aktor" class="form-control" value="<?php echo $_SESSION['id_aktor']; ?>" name="id_aktor" required>
                                </div>
                            </div>
                            <div class="form-group mt-0">
                                <textarea class="form-control" id="message" name="message" rows="5" style="resize: none;" placeholder="Message" required></textarea>
                            </div>
                            <div class="my-3">
                                <p id="ulasan"></p>
                            </div>
                            <div class="text-center"><button type="submit" name="submit" class="btn bg-olive" onclick="return confirm('Apakah anda yakin ingin menambah ini ?')"><i class="fa fa-save"> Send Message</i></button></div>
                        </form>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </section>


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

        <div id="preloader"></div>

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