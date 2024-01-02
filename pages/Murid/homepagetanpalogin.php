<?php
include "../config.php"; // Sambungkan ke database
// require_once __DIR__ . '../../../vendor/autoload.php';

if (isset($_POST["kirim"])) {
    $nama = $_POST["nama"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $email = $_POST["email"];
    $telepon = $_POST["telepon"];
    // $jenis_kelamin = $_POST["jenis_kelamin"];
    $jenis_kelamin = isset($_POST["jenis_kelamin"]) ? $_POST["jenis_kelamin"] : "";
    $alamat = $_POST["alamat"];
    $telepon_wali = $_POST["telepon_wali"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Menangani unggah gambar
    $nama_file = str_replace(' ', '_', $nama); // Ganti spasi dengan garis bawah
    $foto = $_FILES["foto"]["name"];
    $temp_file = $_FILES["foto"]["tmp_name"];
    $ext = pathinfo($foto, PATHINFO_EXTENSION);  // Ekstensi gambar
    $upload_dir = "img/profile/";
    $target_file = $upload_dir . $nama_file . '.' . $ext; // Nama file foto disesuaikan dengan inputan nama


    if (move_uploaded_file($temp_file, $target_file)) {
        // Gambar berhasil diunggah, lakukan query tambah data
        $tambah_data = "INSERT INTO aktor (jurusan_id, nama, tanggal_lahir, email, telepon, gender, alamat, foto, telepon_wali, tingkatan, username, password, role, status) VALUES (1, '$nama', '$tanggal_lahir', '$email', '$telepon', '$jenis_kelamin', '$alamat', '$target_file', '$telepon_wali', 0, '$username', '$password', 'murid', 'calon')";
        $hasil = mysqli_query($koneksi, $tambah_data);

        if ($hasil) {

            // Inisialisasi objek mPDF
            $mpdf = new \Mpdf\Mpdf();

            // Buat konten HTML untuk kop surat
            $kopSurat = '
                <table width="100%" style="border-bottom: 1px solid;">
                    <tr>
                        <td width="20%"><img src="img/download.png" alt="Logo" width="100"></td>
                        <td width="60%" align="center">
                            <h2>DEWAN PENGURUS CABANG BANGKALAN</h2>
                            <h2>PERGURUAN PENCAK SILAT JOKOTOLE</h2>
                            <h2>DIKLAT KODIM 0829</h2>
                            <p>Sekretariat : Kodim 0829 Bangkalan Jl. Letnan Abdullah</p>
                            <p>e - mail: ffayyumnoma07@gmail.com</p>
                        </td>
                    </tr>
                </table>
            ';

            // Buat isi dokumen
            $content = '
                <h3 style="text-align: center;"> BIODATA ANGGOTA </h3>
                <table width="80%" style="margin: 0 auto;">
                    <tr style="margin-bottom: 10px;">
                        <td width="35%">Nama</td>
                        <td width="5%"> : </td>
                        <td>' . $nama . '</td>
                    </tr>
                    <tr style="margin-bottom: 10px;">
                        <td width="35%">Tanggal Lahir</td>
                        <td width="5%"> : </td>
                        <td>' . $tanggal_lahir . '</td>
                    </tr>
                    <tr style="margin-bottom: 10px;">
                        <td width="35%">Jenis Kelamin</td>
                        <td width="5%"> : </td>
                        <td>' . $jenis_kelamin . '</td>
                    </tr>
                    <tr style="margin-bottom: 10px;">
                        <td width="35%">Telepon</td>
                        <td width="5%"> : </td>
                        <td>' . $telepon . '</td>
                    </tr>
                    <tr style="margin-bottom: 10px;">
                        <td width="35%">Telepon Orang tua</td>
                        <td width="5%"> : </td>
                        <td>' . $telepon_wali . '</td>
                    </tr>
                    <tr style="margin-bottom: 10px;">
                        <td width="35%">Alamat</td>
                        <td width="5%"> : </td>
                        <td>' . $alamat . '</td>
                    </tr>
                    <tr style="margin-bottom: 10px;">
                        <td width="35%">
                            <br>
                            <img src="' . $target_file . '" alt="profile ' . $temp_file . '" width="125px">
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr style="margin-bottom: 10px;">
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">
                            <p>Bangkalan, ' . date('d-m-Y') . '</p>
                            <br><br><br>
                            <hr width="50%">
                            <p>Orang Tua Murid</p>
                        </td>
                    </tr>
                </table>

                <br><hr>

                <p> Tambahan : </p>
                <ul type="square">
                    <li> <b>Uang Pendaftaran</b> sebesar Rp. 50.000</li>
                    <li> Uang Iuran Rp. 20.000 </li>
                    <li>
                        Harga Pakaian :
                        <ul>
                            <li> Ukuran S : Rp. 185.000  </li>
                            <li> Ukuran M : Rp. 195.000  </li>
                            <li> Ukuran L : Rp. 205.000 </li>
                            <li> Ukuran XL : Rp. 215.000 </li>
                        </ul>
                    </li>
                </ul>

                <br><br><br><br><br><br>

                <p style="color: red; font-size: 10px;">*Formulir dibawa saat jadwal pertama kali latihan</p>
            ';

            // Gabungkan kop surat dan konten
            $html = $kopSurat . $content;

            // Tambahkan HTML ke dokumen
            $mpdf->WriteHTML($html);

            // Simpan atau tampilkan dokumen
            $mpdf->Output("form pendaftaran.pdf", "I");

            // echo '<script>alert("Data berhasil disimpan !");</script>';

            // echo '<script>window.location.reload();</script>';

        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengunggah gambar.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homepage Tanpa Login</title>

    <!-- My Own Styles -->
    <link rel="stylesheet" href="../../dist/css/styl.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- my font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
</head>

<body>
    <!-- Menu header -->
    <header style="background-image: url(../../dist/img/gmb.png);">
        <nav>
            <a href="#" class="logo"><img src="../../dist/img/logo.png"></a>
            <div class="navbar">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Merchandise</a></li>
                    <li><a href="#galeri">Galeri Prestasi</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="log">
                <ul>
                    <li><a href="../../login.php">Login</a></li>
                    <li><a href="#" class="sign" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a></li>
                </ul>
            </div>
        </nav>

        <div class="content">
            <div class="imgbox">
                <img src="../../dist/img/silat.png" class="silat">
            </div>
            <div class="textbox">
                <h1>PPS JOKOTOLE<br> DIKLAT KODIM 0829</h1>
                <a href="#">Daftar Sekarang</a>
            </div>
        </div>

        <!-- Register -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form enctype="multipart/form-data" action="" method="post">

                        <!-- Nama -->
                        <div class="m-3">
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input class="form-control" type="text" name="nama" value="" required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="m-3">
                            <label for="" class="form-label">Tanggal Lahir</label>
                            <input class="form-control" type="date" name="tanggal_lahir" id="" multiple required>
                        </div>

                        <!-- Email -->
                        <div class="m-3">
                            <label for="" class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" id="" required>
                        </div>

                        <!-- Telepon siswa -->
                        <div class="m-3">
                            <label for="" class="form-label">No. telepon</label>
                            <input class="form-control" name="telepon" id="" type="number" required>
                        </div>

                        <!-- Jenis kelamin -->
                        <div class="m-3">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <div class="gender">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki laki" required>
                                    <label class="form-check-label" for="laki_laki"> Laki - laki </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" required>
                                    <label class="form-check-label" for="perempuan"> Perempuan </label>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="m-3">
                            <label for="" class="form-label">Alamat</label>
                            <input class="form-control" name="alamat" id="" type="text" required>
                        </div>

                        <!-- Foto -->
                        <div class="m-3">
                            <label for="" class="form-label">Foto</label>
                            <input class="form-control" name="foto" id="" type="file" required>
                        </div>

                        <!-- Telepon wali -->
                        <div class="m-3">
                            <label for="" class="form-label">No. telepon Wali</label>
                            <input class="form-control" name="telepon_wali" id="" type="number" required>
                        </div>

                        <!-- Username -->
                        <div class="m-3">
                            <label for="" class="form-label">Username</label>
                            <input class="form-control" name="username" id="" type="text" required>
                        </div>

                        <!-- Password -->
                        <div class="m-3">
                            <label for="" class="form-label">Password</label>
                            <input class="form-control" name="password" id="" type="password" required>
                        </div>

                        <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 15px;">
                            <button type="submit" name="kirim" class="btn btn-success">DAFTAR</button>
                            <!-- <input type="submit" name="kirim" class="btn btn-success" style="display: block;"> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main>
        <h1 style="margin-left: 30px; margin-top:30px;margin-bottom:-70px;">Berita Dan Agenda</h1>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-body">

                                <div class="container">
                                    <div class="row">
                                        <?php
                                        include '../config.php';
                                        $daftar = mysqli_query($koneksi, "select * from berita");
                                        while ($hasil = mysqli_fetch_array($daftar)) {
                                        ?>
                                            <div class="col-md-6" style=" margin-bottom: 40px; margin-top: 30px;">
                                                <div class=" card" style="width: 100%;">
                                                    <img src="../../dist/img/beritaagenda/<?php echo $hasil['foto_berita'] ?>" class="card-img-top" alt="..." style="width: 100%; height: 300px;">
                                                    <div class="card-body">
                                                        <h5 style="font-weight: bold;"><?php echo $hasil['judul_berita'] ?></h5>
                                                        <?php echo $hasil['deskripsi_berita'] ?></p>
                                                        <?php echo $hasil['tanggal_berita'] ?></p>
                                                        <?php
                                                        $referensi = $hasil['referensi'];
                                                        echo '<a href="' . $referensi . '" class="card-link">Selengkapnya</a>';
                                                        ?>
                                                        <br><br>
                                                        <div class="btn-group" role="group" aria-label="Tombol Aksi">
                                                            <a href="editberita_SuperAdmin.php?id=<?php echo $hasil['id_berita']; ?>" class="card-link" style="margin-right: 10px;"><i class="fas fa-edit"></i></a>
                                                            <form method="post" action="hapusberita_SuperAdmin.php">
                                                                <input type="hidden" name="id" value="<?php echo $hasil['id_berita']; ?>">
                                                                <button class="btn btn-link hapus-berita" data-id="<?php echo $hasil['id_berita']; ?>">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>

                                                </div><br>
                                            </div>
                                        <?php
                                        };
                                        ?>
                                    </div>
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
    </main>
    <!-- javascript -->
    <script src="../../dist/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
</body>