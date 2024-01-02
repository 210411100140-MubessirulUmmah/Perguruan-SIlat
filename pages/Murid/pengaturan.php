<?php
    $koneksi = mysqli_connect("localhost", "root", "", "jokotole");
    
    session_start();
    $id_murid = $_SESSION['id_aktor'];

    //melakukan query menampilkan data
    $data_murid = "SELECT aktor.*, jurusan.nama_jurusan FROM aktor LEFT JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan WHERE aktor.id_aktor = $id_murid";
    $hasil = mysqli_query($koneksi, $data_murid);
    $row = mysqli_fetch_assoc($hasil);
    
    
if (isset($_POST['kirim'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama = $_POST["nama"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $email = $_POST["email"];
    $telepon = $_POST["telepon"];
    $gender = $_POST["gender"];
    $alamat = $_POST["alamat"];
    $telepon_wali = $_POST["telepon_wali"];
    $tingkatan = $_POST["tingkatan"];

    $edit_data = "UPDATE aktor set nama = '$nama', tanggal_lahir = '$tanggal_lahir', email = '$email', telepon = '$telepon', gender = '$gender', alamat = '$alamat', telepon_wali = '$telepon_wali', telepon_wali = '$telepon_wali', username = '$username', password = '$password' where id_aktor = $id_murid";
    $update_data = mysqli_query($koneksi, $edit_data);

    if ($update_data) {
        $_SESSION['success'] = "Profile berhasil diupdate !";
        header("Location: pengaturan.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal mengupdate !";
        header("Location: pengaturan.php");
        exit();
    }
}

if (isset($_POST['submit'])) {
    // Memeriksa apakah ada unggahan gambar
    if ($_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
        $nama = $_POST["nama"];
        $nama_file = str_replace(' ', '_', $nama);
        $foto = $_FILES["foto"]["name"];
        $temp_file = $_FILES["foto"]["tmp_name"];
        $ext = pathinfo($foto, PATHINFO_EXTENSION);  // Ekstensi gambar
        $upload_dir = "../../dist/assets/img/profile/"; 
        $db_foto =  $nama_file . '.' . $ext;
        $target_file = $upload_dir . $nama_file . '.' . $ext; // Nama file foto disesuaikan dengan inputan nama

        // Pindahkan gambar yang diunggah ke direktori yang diinginkan
        if (move_uploaded_file($temp_file, $target_file)) {
            // Gambar berhasil diunggah, sekarang Anda dapat menyimpan nama file gambar ini ke database
            $edit_foto = "UPDATE aktor SET foto = '$db_foto' WHERE id_aktor = $id_murid"; // Ganti 1 dengan ID yang sesuai
            $update_foto = mysqli_query($koneksi, $edit_foto);

            if ($update_foto) {
                $_SESSION['success'] = "Foto rofile berhasil diupdate !";
                header("Location: pengaturan.php");
                exit();
            } else {
                $_SESSION['error'] = "Gagal mengupdate foto profile";
                header("Location: pengaturan.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Gagal mengunggah foto profile";
            header("Location: pengaturan.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Gagal mengunggah foto profile";
        header("Location: pengaturan.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../dist/css/dimas.css">
    <style>
        img { 
            /* border: 2px solid;  */
            border-radius: 100%; 
            margin-right: auto; 
            margin-left: auto
        }
        .conten {
            position: relative;
            margin-right: auto; 
            margin-left: auto;
            width: 50%;
        }
        .image {
            opacity: 1;
            display: block;
            width: 50% ;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%)
        }
        .conten:hover .image {
            opacity: 0.3;
        }
        .conten:hover .middle {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="pembungkus">
        <div class="sidebar">
            <div class="profile">
                <div class="foto" style="background-color: red; border-radius: 48% 0% 0% 48%; ">
                    <img src="../../dist/assets/img/profile/<?php echo $row["foto"]; ?>" alt="silat">
                </div>
                <div class="description" style="background-color: red; margin-left:0px">
                    <h4><?php echo $row['nama']; ?></h4>
                    <p><?php echo $row['nama_jurusan']; ?></p>
                </div>
            </div>
            <div class="main">
                <div class="list_item">
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                        </svg>
                        Pengaturan
                    </a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                            <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                            <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                        </svg>
                        Jadwal
                    </a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                            <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                        Absensi</a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Riwayat</a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z" />
                        </svg>
                        Evaluasi Latihan</a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16">
                            <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z" />
                        </svg>
                        Pengajuan Lomba</a>
                </div>
                <div class="list_item">
                    <a href="../logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Logout</a>
                </div>
            </div>
        </div>
        <div class="main-content">
            <h1 style="color: white;">Pengaturan</h1>
            <div class="container">
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

                <div class="card-body">
                    <div class="col-lg-12 mb-4 px-lg-2 p-3" style="margin-right:auto; margin-left: auto">
                        <div class="card mb-4 shadow">
                            <div class="row g-0 p-3 align-items-center">
                                <div class="conten">
                                    <img id="profileImage" src="../../dist/assets/img/profile/<?php echo $row["foto"]; ?>" alt="Gambar Materi" class="image" width="100">
                                    <!-- <img id="profileImage" src="../../dist/img/profile/anas.jpg" alt="profile" class="image" width="100"> -->
                                    <div class="middle">
                                        <div class="text">
                                            <button type="button" class="btn btn-outline-dark w-10 shadow-none" data-bs-toggle="modal" data-bs-target="#image-profil">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 p-3 align-items-center">
                                <div class="">
                                    <form action="" method="post">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="username"> Username </label>
                                                        <input type="text" id="username" name="username" class="form-control shadow-none" value="<?php echo $row['username']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="passowrd"> Password </label>
                                                        <input type="password" id="password" name="password" class="form-control shadow-none" value="<?php echo $row['password']; ?>" required>
                                                        <input type="checkbox" id="showPassword"> Tampilkan Password
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="nama"> Nama </label>
                                                        <input type="text" id="nama" name="nama" class="form-control shadow-none" value="<?php echo $row['nama']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="tanggal_lahir"> Tanggal lahir </label>
                                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control shadow-none"  value="<?php echo $row['tanggal_lahir']; ?>"required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="email"> E-mail </label>
                                                        <input type="text" id="email" name="email" class="form-control shadow-none" value="<?php echo $row['email']; ?>" required>
                                                        <span id="error_email" style="color: red;"></span>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold"> Telepon </label>
                                                        <input type="text" id="telepon" name="telepon" class="form-control shadow-none" value="<?php echo $row['telepon']; ?>" required>
                                                        <span id="error_telepon" style="color: red;"></span>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="gender"> Gender </label>
                                                        <select name="gender" id="gender" class="form-control shadow-none">
                                                            <option selected hidden ><?php echo $row['gender']; ?></option>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>                                                       </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold"> Alamat </label>
                                                        <input type="text" id="alamat" name="alamat" class="form-control shadow-none" value="<?php echo $row['alamat']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="telepon_wali"> Telepon wali </label>
                                                        <input type="text" id="telepon_wali" name="telepon_wali" class="form-control shadow-none" value="<?php echo $row['telepon_wali']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="tingkatan"> Tingkatan </label>
                                                        <input type="text" id="tingkatan" name="tingkatan" class="form-control shadow-none" value="<?php echo $row['tingkatan']; ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="modal-footer">
                                            <button id="submitButton" name="kirim" class="btn btn-outline-dark w-175 shadow-none" disabled>Simpan</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="image-profil" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Image</h5>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="hidden" id="nama" name="nama" class="form-control shadow-none" value="<?php echo $row['nama']; ?>" required>
                                    <input type="file" name="foto" class="form-control shadow-none" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-success text-white shadow-none" name="submit">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
        var telepon = document.getElementById('telepon').value;
        var email = document.getElementById('email').value;

        var teleponValid = /^\d{10,12}$/;  // Validasi nomor telepon (10-12 digit)
        var emailValid = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;  // Validasi alamat email

        var errorTelepon = document.getElementById('error_telepon');
        var errorEmail = document.getElementById('error_email');

        if (!teleponValid.test(telepon)) {
            errorTelepon.textContent = "Nomor telepon harus terdiri dari 10 hingga 12 digit.";
            e.preventDefault(); // Menghentikan pengiriman form
        } else {
            errorTelepon.textContent = "";
        }

        if (!emailValid.test(email)) {
            errorEmail.textContent = "Alamat email tidak valid.";
            e.preventDefault(); // Menghentikan pengiriman form
        } else {
            errorEmail.textContent = "";
        }
    });

        
        const passwordInput = document.getElementById("password");
        const showPasswordCheckbox = document.getElementById("showPassword");

        showPasswordCheckbox.addEventListener("change", function () {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });

        const inputFields = document.querySelectorAll('.form-control');
        const profileImage = document.getElementById('profileImage');
        const submitButton = document.getElementById('submitButton');

        // Simpan nilai awal input dalam array
        const previousValues = Array.from(inputFields, inputField => inputField.value);
        const originalImageSrc = profileImage.src;

        // Tambahkan event listener untuk mendengarkan perubahan pada inputan
        inputFields.forEach((inputField, index) => {
            inputField.addEventListener('input', checkSubmitButtonStatus);
        });

        // Tambahkan event listener untuk mendengarkan perubahan pada gambar
        profileImage.addEventListener('change', checkSubmitButtonStatus);

        function checkSubmitButtonStatus() {
            let inputChanged = false;
            let imageChanged = false;

            inputFields.forEach((inputField, index) => {
                if (inputField.value.trim() !== '' && inputField.value !== previousValues[index]) {
                    inputChanged = true;
                }
            });

            if (profileImage.src !== originalImageSrc) {
                imageChanged = true;
            }

            if (inputChanged || imageChanged) {
                // Aktifkan tombol jika ada perubahan pada input atau gambar
                submitButton.removeAttribute('disabled');
            } else {
                // Nonaktifkan tombol jika tidak ada perubahan
                submitButton.setAttribute('disabled', 'true');
            }
        }
        // Tambahkan event listener untuk menghandle klik pada tombol
        submitButton.addEventListener('click', function() {
            alert('Tombol diklik!');
        });
    </script>
</body>

</html>