<?php

session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
$aktorr = $_SESSION['id_aktor'];
$conn = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
$hasill = mysqli_query($conn, $sql);
$bariss = mysqli_fetch_assoc($hasill);


//menghubungkan dengan database
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

$id_admin = $_SESSION['id_aktor'];

$data_query = "SELECT * from aktor where id_aktor = $id_admin";
$tampil_aktor = mysqli_query($koneksi, $data_query);
$row = mysqli_fetch_assoc($tampil_aktor);

//melakukan query menampilkan data
$data_materi = "SELECT * FROM materi";
$hasil = mysqli_query($koneksi, $data_materi);

// query hitung materi
$cek_jumlah_materi = "SELECT COUNT(id_materi) as total_materi FROM materi";
$total_materi_result = mysqli_query($koneksi, $cek_jumlah_materi);
$baris = mysqli_fetch_assoc($total_materi_result);
$total_materi = $baris['total_materi'];
// echo $total_materi;

$no = 1;

//delete materi
if (isset($_GET['id_materi'])) {
    // Proses hapus materi
    $id_materi = $_GET['id_materi'];

    // Ambil informasi file foto materi yang akan dihapus
    $select_query = "SELECT foto_materi FROM materi WHERE id_materi = $id_materi";
    $result = mysqli_query($koneksi, $select_query);
    if ($row = mysqli_fetch_assoc($result)) {
        $file_to_delete = $row['foto_materi'];
        $file_path = "../../dist/img/materi/" . $file_to_delete; // Ganti dengan path direktori upload yang sesuai

        // Hapus file foto materi dari direktori
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Hapus data dari database
        $delete_query = "DELETE FROM materi WHERE id_materi = $id_materi";
        $result = mysqli_query($koneksi, $delete_query);

        if ($result) {
            $_SESSION['success'] = "Materi berhasil dihapus !";
            header("Location: materi_super_admin.php");
            exit();
        } else {
            $_SESSION['error'] = "Gagal menghapus materi !";
            header("Location: materi_super_admin.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Materi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        th {
            padding: 10px 25px;
        }

        td {
            padding: 20px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-static-top" style="background-color: #292C30;position: fixed; width: 100%; top:0;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #fff"></i></a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #3B4045">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/<?php echo $bariss['foto'] ?>" class="img-circle elevation-3" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $bariss['nama'] ?></a>
                        <a href="#" style="font-size: 10px;"><i class="fa fa-circle text-success"></i> Super Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="Dashboard_SuperAdmin.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Profil_Perguruan.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Profil Perguruan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Kelola_Merchandise.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart "></i>
                                <p>
                                    Merchandise
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Penjurusan_Prestasi.php" class="nav-link">
                                <i class="nav-icon fas fa-road"></i>
                                <p>
                                    Penjurusan Prestasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Kelayakan.php" class="nav-link">
                                <i class="nav-icon fas fa-percent"></i>
                                <p>
                                    Kelayakan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Inventaris.php" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Inventaris
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Pesan.php" class="nav-link">
                                <i class="nav-icon fas fa-envelope "></i>
                                <p>
                                    Kotak Masuk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Verifikasi.php" class="nav-link">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>
                                    Verifikasi Pembayaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Materi.php" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Materi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Verifikasi_Pendaftaran.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Verifikasi Pendaftaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="galeriprestasi.php" class="nav-link">
                                <i class="nav-icon fas fa-trophy"></i>
                                <p>
                                    Galeri Prestasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="spp.php" class="nav-link">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Informasi SPP
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="strukturorganisasi.php" class="nav-link">
                                <i class="nav-icon 	fas fa-sitemap"></i>
                                <p>
                                    Struktur Organisasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="beritaagenda_SuperAdmin.php" class="nav-link">
                                <i class=" nav-icon fa fa-newspaper-o"></i>
                                <p>
                                    Berita dan Agenda
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rekomendasilomba_SuperAdmin.php" class="nav-link">
                                <i>
                                    <i class="nav-icon fa fa-handshake-o"></i>
                                </i>
                                <p>
                                    Rekomendasi Lomba
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Inventaris.php" class="nav-link">
                                <i>
                                    <i class="nav-icon fa fa-trophy"></i>
                                </i>
                                <p>
                                    Pengajuan Lomba
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Pengaturan.php" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Pengaturan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon fas fa fa-sign-out"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #18191A;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #fff;margin-top:70px;"><b>Hapus Materi</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">

                                <div class="card-body">
                                    <!-- Modal untuk menampilkan pesan alert -->
                                    <?php
                                    if (isset($_SESSION['success'])) {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                    <i class='bi bi-check-circle me-1'></i>
                                                    {$_SESSION['success']}
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>";
                                        unset($_SESSION['success']);
                                    }

                                    if (isset($_SESSION['error'])) {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <i class='bi bi-exclamation-circle me-1'></i>
                                                    {$_SESSION['error']}
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>";
                                        unset($_SESSION['error']);
                                    }
                                    ?>
                                    <!-- End modal -->
                                    <div class="card card-body">
                                        <?php if ($total_materi == 0) {
                                            echo "<p style='text-align:center; color: red;'>Belum Ada Materi Pembelajaran</p>";
                                        } else {  ?>
                                            <table>
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Gambar</th>
                                                        <th>Nama Teknik</th>
                                                        <th style="width: 250px;">Deskripsi</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($data_baru = mysqli_fetch_assoc($hasil)) { ?>
                                                        <tr class="kolom">
                                                            <td><?php echo $no++ ?></td>
                                                            <td><img src="../../dist/assets/img/materi/<?php echo $data_baru["foto_materi"]; ?>" alt="Gambar Materi" width="150"></td>
                                                            <td><?php echo $data_baru["nama_materi"]; ?></td>
                                                            <td style="width: 250px;"><?php echo $data_baru["deskripsi_materi"]; ?></td>
                                                            <td class="aksi">
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?php echo $data_baru['id_materi'] ?>">Delete</button>
                                                                <div class="modal fade" id="hapus<?php echo $data_baru['id_materi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Mahasiswa</h5>
                                                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Apakah anda yakin untuk menghapus materi <b><?php echo $data_baru['nama_materi']; ?></b> ?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                                <a href="?id_materi=<?php echo $data_baru['id_materi']; ?>" class="btn btn-danger">Iya</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="background-color: #292C30; position: fixed;bottom: 0;width: 100%;">
            <strong style="color: #fff">Copyright &copy; 2023 <a href="https://jokotole">Jokotole Kodim 0829</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>