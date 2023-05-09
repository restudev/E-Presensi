<?php
require('../koneksi.php');
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Presensi - Siswa</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom styles for  template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendor/datepicker/datepicker3.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />


</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-buildings-fill"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SMAN 3 SLAWI</div>
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <?php {
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="riwayat_absen.php">
                        <i class="bi bi-clipboard-check-fill"></i>
                        <span>Riwayat Absen</span></a>
                </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= $_SESSION['nama'] ?>
                                </span>
                                </span> <img class="img-profile rounded-circle"
                                    src="../assets/img/undraw_profile_1.svg">                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h3 class=" mb-4 text-gray-800"><b>Jangan Lupa Absen Hari Ini,
                            <?= $_SESSION['nama'] ?>!</h3>
                    <b>
                        <style>
                            #jam {
                                font-size: 40px;
                                /* ukuran font */
                                color: #333;
                                /* warna font */
                                margin-bottom: 24px;
                                /* jarak antara elemen */
                                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                                /* bayangan pada font */
                            }
                        </style>

                        <h5 id="jam"></h5>

                        <script type="text/javascript">
                            window.onload = function () { jam(); }

                            function jam() {
                                var e = document.getElementById('jam'),
                                    d = new Date(), h, m, s;
                                h = d.getHours();
                                m = set(d.getMinutes());
                                s = set(d.getSeconds());

                                e.innerHTML = h + ':' + m + ':' + s;

                                setTimeout('jam()', 1000);
                            }

                            function set(e) {
                                e = e < 10 ? '0' + e : e;
                                return e;
                            }
                        </script>


                        <!-- Begin Page Content -->

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>
                                        <?= $_SESSION['nama'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nomor Induk Siswa</td>
                                    <td>:</td>
                                    <td>
                                        <?= $_SESSION['nis'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Wali Kelas</td>
                                    <td>:</td>
                                    <td>
                                        <?= $_SESSION['walikelas'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td>
                                        <?= $_SESSION['kelas'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        date_default_timezone_set('asia/jakarta');
                        $i = $_SESSION['nama'];
                        $tgl = date('Y-m-d');
                        $query = mysqli_query($koneksi, "SELECT * FROM tblabsen WHERE nama_siswa = '$i' AND tgl_absen = '$tgl'");
                        $data = mysqli_fetch_array($query);
                        $cek = mysqli_num_rows($query);
                        $now = date('07:00');
                        if ($cek != 1) {
                            $set_buka = "06:00";
                            $set_tutup = "23:59";
                            // $jam_masuk = "12:01";
                            if ($now < $set_buka) {
                                echo '<div class="alert alert-danger text-center"><b>Absen dibuka jam 06:00</b></div>';
                            } else if ($now <= $set_tutup) {
                                echo '<div class="alert alert-danger text-center"><b>Absen ditutup jam 18:00</b></div>';
                                ?>

                                <?php
                            }
                            ?>

                            <form action="absen.php?a=M" method="post">
                                <button type="submit" name="submit" class="btn btn-success btn-block btn-lg">Absen</button>
                            </form>

                            <form action="absen.php?a=I" method="post">
                                <button type="button" class="btn btn-warning btn-block btn-lg mt-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Klik disini jika tidak masuk/absen</button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"><b>Masukkan Keterangan Anda</b></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Nama:</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">NIS:</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Keterangan:</label>
                                                        <select name="keterangan" class="form-select">
                                                            <option>Izin</option>
                                                            <option>Sakit
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Alasan:</label>
                                                        <textarea class="form-control" id="message-text"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-warning">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                        } else {
                            // Menampilkan pesan jika sudah absen
                            ?>
                            <div class="alert alert-danger text-center">
                                <b>Anda sudah absen hari ini. Terima kasih!</b>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        require('../template/footer.php');
                        ?>