<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM inventaris i";
$hasil = mysqli_query($koneksi, $sql);
?>

<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
    <!-- <link rel="stylesheet" href="../../dist/css/style.css"> -->

    <!-- My Own Styles -->
    <link rel="stylesheet" href="../../dist/css/styl.css">
    <link rel="stylesheet" href="../../dist/css/style2.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">


    <!-- Favicons -->
    <link href="../../dist/assets/img/favicon.png" rel="icon">
    <link href="../../dist/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../dist/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../dist/assets/css/main.css" rel="stylesheet">

    <style>
        * {
            /* margin: 0;
    padding: 0; */
            font-family: 'Poppins', sans-serif;
        }

        .pembungkus {
            display: flex;
            min-height: 100vh;
        }

        /* -------------- CSS Punya Sidebar ------------------ */

        .sidebar {
            background-color: #FFFFFF;
            width: 340px;
            padding: 40px 24px;
            display: flex;
            box-sizing: border-box;
            flex-direction: column;
        }


        .profile {
            display: flex;
            /* background-color: honeydew; */
            box-sizing: border-box;
        }

        .foto {
            flex: 1;
            order: 1;
        }

        .foto img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 1px solid #8f8f8f;
        }

        .description {
            flex: 2;
            order: 2;
            box-sizing: border-box;
            line-height: 5vh;
            padding-top: 10px;
            margin-left: 10px;

        }

        .sidebar .main {
            margin-top: 30px;
        }

        /* .sidebar .list_item{
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 12px 10px;
    border-radius: 8px;
} */

        .sidebar .main .list_item a {
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
            text-align: center;
            text-decoration: none;
            color: #1F261F;
        }

        .sidebar .main .list_item {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 12px 10px;
            border-radius: 8px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .sidebar .main .list_item:hover {
            background-color: #7C7D7C;
            transition: all ease-in 0.3s;
        }

        .sidebar .main .list_item a svg {
            margin-right: 5px;
            text-align: center;
        }

        .btn_back a {
            margin-left: 226px;
        }


        /* -------------- CSS Punya Main content ------------------ */

        .main-content {
            background-color: #1F261F;
            flex-grow: 1;
            padding: 30px;
            box-sizing: border-box;
            /* display: grid; */
            /* grid-template-rows: 1fr 9fr; */
        }

        .komp {
            display: grid;
            background-color: #FFFFFF;
            width: auto;
            height: 100px;
            color: #1F261F;
            grid-template-columns: 2fr 2fr;
            border-radius: 20px;
        }

        .komp .isi-komponen1 {
            display: flex;
            /* padding: 25px 30px; */
            /* text-align: center; */
            justify-content: center;
            align-items: center;
        }

        .komp .isi-komponen2 {
            display: grid;
            /* padding: 25px 30px; */
            /* text-align: center; */
            justify-content: center;
            align-items: center;
            justify-items: center;
        }

        .komp_table {
            /* width: auto auto; */
            margin-top: 30px;
            background-color: #FFFFFF;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="pembungkus">
        <div class="sidebar">
            <?php
            $aktorr = $_SESSION['id_aktor'];
            $koneksi = mysqli_connect("localhost", "root", "", "jokotole");
            $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
            $hasill = mysqli_query($koneksi, $sql);
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
            <div class="profile" style="<?= $background; ?>;">
                <div class="foto" style="padding: 5%;">
                    <img src="../../dist/img/<?php echo $bariss['foto'] ?>" alt="silat">
                </div>
                <div class="description">
                    <h4><?php echo $bariss['nama'] ?></h4>
                    <p><?= $namajurusan; ?></p>
                </div>
            </div>
            <div class="main">
                <div class="list_item">
                    <a href="Dashboard_Murid.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                        </svg>
                        Dashboard Murid
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
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-fill" viewBox="0 0 16 16">
                            <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z" />
                        </svg>
                        Inventaris</a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Logout</a>
                </div>
            </div>
            <div class="btn_back">
                <a class="btn btn-success" href="#" role="button">Back</a>

            </div>
        </div>
        <div class="main-content">
            <h1 style="color: white;">Inventaris</h1>

            <div class="komp_table" style="padding: 5%;">
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal" role="document">
                        <div class="modal-content shadow">
                            <div class="modal-header bg-light shadow-sm" style="background-color: #BED2BE !important;">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="image text-center">
                                                <img src="../../dist/img/Jokotole.png" width="200" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="modal-body">
                                                Apakah anda yakin mencetak data inventaris ini?
                                                <hr>
                                                <button type="button" class="btn bg-navy" data-dismiss="modal">Batal</button>
                                                <a href="../Print_Inventaris.php" target="blank"><button type="button" onclick="refresh()" href="#" id="confirmBtn" class="btn bg-olive">Ya, Lanjutkan</button></a>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer shadow-sm" style="background-color: #BED2BE;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header mb-3" style="display: flex; justify-content: space-between; align-items: right;">
                    <button type="button" name="simpan" class="btn bg-maroon" style="height: 2%;" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-print"></i> Cetak
                    </button>
                    <div class="label-input-container">
                        <label>Search:</label>
                        <input type="search" id="inPutbarang" onkeyup="myFunctionfunc()" class="form-control" data-table="table-bordered" placeholder="Mencari..." />
                    </div>

                </div>
                <table class="table table-bordered table-striped" id="taBelinventaris" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($baris = mysqli_fetch_assoc($hasil)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $baris['nama_barang'] ?></td>
                                <td><?php echo $baris['jumlah_barang'] ?></td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Tangani perubahan nilai pada elemen <select>
        document.getElementById("id_jadwal").addEventListener("change", function() {
            // Dapatkan nilai yang dipilih
            var selectedValue = this.value;

            // Masukkan nilai ke dalam modal
            document.getElementById("selectedValue").textContent = selectedValue;
        });
    </script>




    </script>
    <!-- javascript -->
    <script src="../../dist/js/script.js"></script>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>

    <script>
        $('#confirmationModal').modal('hide');

        function refresh() {
            var newWindow = window.open('../Print_Inventaris.php', 'blank');
            window.location.reload();
        }
    </script>
    <script src="../../dist/assets/js/main.js"></script>
</body>

</html>