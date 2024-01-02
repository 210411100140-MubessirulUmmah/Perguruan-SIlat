<?php
//menghubungkan dengan database
include "../config.php";

//melakukan query menampilkan data
$data_semua_murid = "SELECT nama, gender, nama_jurusan, tingkatan, telepon, telepon_wali FROM aktor inner join jurusan on aktor.jurusan_id = jurusan.id_jurusan where role = 'murid' and status = 'tetap'";
$hasil_1 = mysqli_query($koneksi, $data_semua_murid);

$data_murid_baru = "SELECT * FROM aktor where role = 'murid' and status = 'calon'";
$hasil_2 = mysqli_query($koneksi, $data_murid_baru);

$no_semua = 1;
$no_baru = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Verify Student</title>

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
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alif Daifullah</a>
                        <a href="#" style="font-size: 12px;"><i class="fa fa-circle text-success"></i> Super Admin</a>
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
                            <h1 style="color: #fff;margin-top:70px;"><b>verifikasi Murid</b></h1>
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

                                    <p>
                                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#murid_baru" role="button" aria-expanded="false" aria-controls="murid_baru"> Murid Baru ( <?php echo mysqli_num_rows($hasil_2) ?> )</a>
                                    </p>

                                    <div class="collapse" id="murid_baru">
                                        <div class="card card-body">
                                            <?php if (mysqli_num_rows($hasil_2) != 0) { ?>
                                                <table>
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Alamat</th>
                                                            <th>Telp. Siswa</th>
                                                            <th>Telp. Wali</th>
                                                            <th>Operasi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($data_baru = mysqli_fetch_assoc($hasil_2)) { ?>
                                                            <tr class="kolom">
                                                                <td><?php echo $no_baru++ ?></td>
                                                                <td><?php echo $data_baru["nama"]; ?></td>
                                                                <td><?php echo $data_baru["gender"]; ?></td>
                                                                <td><?php echo $data_baru["alamat"]; ?></td>
                                                                <td><?php echo $data_baru["telepon"]; ?></td>
                                                                <td><?php echo $data_baru["telepon_wali"]; ?></td>
                                                                <td class="aksi">
                                                                    <!-- Tombol Edit Data Mahasiswa -->
                                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $data_baru['id_aktor'] ?>">confirm</button>
                                                                    <div class="modal fade" id="edit<?php echo $data_baru['id_aktor'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Mahasiswa</h5>
                                                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    Apakah anda yakin untuk mengonfirmasi <b><?php echo $data_baru['nama']; ?></b> sebagai murid ?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="action_verifikasi.php?id_edit=<?php echo $data_baru['id_aktor']; ?>" class="btn btn-success">Iya</a>
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Tombol Hapus Data Mahasiswa -->
                                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?php echo $data_baru['id_aktor'] ?>">delete</button>
                                                                    <div class="modal fade" id="hapus<?php echo $data_baru['id_aktor'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Mahasiswa</h5>
                                                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    Apakah anda yakin untuk menghapus data dari <b><?php echo $data_baru['nama']; ?></b> ?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                                    <a href="action_verifikasi.php?id_hapus=<?php echo $data_baru['id_aktor']; ?>" class="btn btn-danger">Iya</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            <?php } else { ?>

                                                <p style="color: red; margin: 0px; padding: 0px">Tidak ada data murid baru</p>

                                            <?php } ?>
                                        </div>
                                    </div>

                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jurusan</th>
                                                <th>Tingkatan</th>
                                                <th>Telepon</th>
                                                <th>Telepon Wali</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Menampilkan data yang ada di database -->
                                            <?php while ($murid_tetap = mysqli_fetch_assoc($hasil_1)) { ?>
                                                <tr class="kolom">
                                                    <td><?php echo $no_semua++ ?></td>
                                                    <td><?php echo $murid_tetap["nama"]; ?></td>
                                                    <td><?php echo $murid_tetap["gender"]; ?></td>
                                                    <td><?php echo $murid_tetap["nama_jurusan"]; ?></td>
                                                    <td><?php echo $murid_tetap["tingkatan"]; ?></td>
                                                    <td><?php echo $murid_tetap["telepon"]; ?></td>
                                                    <td><?php echo $murid_tetap["telepon_wali"]; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

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