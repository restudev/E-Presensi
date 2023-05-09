<?php
session_start();
include_once "../koneksi.php";

// Memeriksa status login pada session
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    echo "<script>
            alert('Silahkan login terlebih dahulu!');
            document.location.href = 'login.php';
          </script>";
    exit;
}


//jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {

    //pengujian apakah data akan diedit atau disimpan baru
    if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
        //data akan diedit
        $update = mysqli_query($koneksi, "UPDATE tblizin SET
                                            nama    = '$_POST[tnama]',
                                            nis     = '$_POST[tnis]',
                                            kelas     = '$_POST[tkelas]',
                                            tanggal  = '$_POST[ttanggal]',
                                            keterangan   = '$_POST[tketerangan]',
                                            alasan   = '$_POST[talasan]'

                                        WHERE id = '$_GET[id]'
                                        ");

        //uji jika edit data berhasil
        if ($update) {
            echo "<script>   
            alert('Yeayy update data sukses!');
            document.location= 'index.php';
          </script>";
        } else {
            echo "<script>   
          alert('Yahh update data gagal!');
          document.location= 'index.php';
        </script>";
        }
    } else {
        //jika bukan edit maka data akan disimpan baru
        $tnama = $_POST['tnama'];
        $tnis = $_POST['tnis'];
        $tkelas = $_POST['tkelas'];
        $ttanggal = $_POST['ttanggal'];
        $tketerangan = $_POST['tketerangan'];
        $talasan = $_POST['talasan'];


        // menjalankan query
        $query = "INSERT INTO tblizin (nama, nis, tanggal, kelas, keterangan, alasan) VALUES ('$tnama', '$tnis', '$tkelas', '$ttanggal', '$tketerangan', '$talasan')";

        //uji jika simpan data berhasil
        $running = mysqli_query($koneksi, $query);
        if ($running) {
            echo "<script>   
            alert('Yeayy simpan data sukses!');
            document.location= 'index.php';
          </script>";
        } else {
            echo "<script>   
          alert('Yahh simpan data gagal!');
          document.location= 'index.php';
        </script>";
        }
    }
} else if (isset($_GET['hal']) && $_GET['hal'] == "hapus") {
    //persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM tblizin WHERE id ='$_GET[id]' ");
    //uji jika hapus data berhasil
    if ($hapus) {
        echo "<script>   
        alert('Yeayy hapus data sukses!');
        document.location= 'index.php';
      </script>";
    } else {
        echo "<script>   
      alert('Yahh hapus data gagal!');
      document.location= 'index.php';
    </script>";
    }
}

//deklarasi variabel untuk menampung data yang akan diedit
$vnama = "";
$vnis = "";
$vkelas = "";
$vtanggal = "";
$vketerangan = "";
$valasan = "";

//pengujian jika tombol edit / hapus diklik
if (isset($_GET['hal'])) {
    //pengujian jika edit data
    if ($_GET['hal'] == "edit") {
        //tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tblizin WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan, maka data ditampung ke dalam variabel
            $vnama = $data['nama'];
            $vnis = $data['nis'];
            $vkelas = $data['kelas'];
            $vtanggal = $data['tanggal'];
            $vketerangan = $data['keterangan'];
            $valasan = $data['alasan'];
        }
    }
}
?>
<?php
if (isset($_POST['submit'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $alasan = $_POST['alasan'];
    $status = 'P'; // Set status awal menjadi Tertunda

    $query = mysqli_query($koneksi, "INSERT INTO tblizin (nis, nama, kelas, tanggal, keterangan, alasan, status) 
                                      VALUES ('$nis', '$nama', '$kelas', '$tanggal', '$keterangan', '$alasan', '$status')");

    if ($query) {
        echo "<script>alert('Berhasil mengajukan izin. Status: Tertunda'); window.location='izin.php';</script>";
    } else {
        echo "<script>alert('Gagal mengajukan izin'); window.location='izin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Presensi | Siswa</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendor/datepicker/datepicker3.css">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-buildings-fill"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SMA 3 SLAWI</div>
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
                        <span>Riwayat Presensi</span></a>
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

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= $_SESSION['nama']; ?>
                                </span> <img class="img-profile rounded-circle"
                                    src="../assets/img/undraw_profile_1.svg">
                            </a>
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
                    <h3 class=" mb-4 text-gray-800"><b>Jangan Lupa Presensi Hari Ini,
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
                            window.onload = function () {
                                jam();
                            }

                            function jam() {
                                var e = document.getElementById('jam'),
                                    d = new Date(),
                                    h, m, s;
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

                        date_default_timezone_set('Asia/Jakarta');
                        $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                        $nama_hari = $hari[date('w')];
                        $i = $_SESSION['nama'];
                        $tgl = date('Y-m-d');
                        $query = mysqli_query($koneksi, "SELECT * FROM tblabsen WHERE nama_siswa = '$i' AND tgl_absen = '$tgl'");
                        $data = mysqli_fetch_array($query);
                        $cek = mysqli_num_rows($query);
                        $now = date('07:08:00');

                        $set_buka_pelajaran1 = "07:00";
                        $set_tutup_pelajaran1 = "09:00";
                        $set_buka_pelajaran2 = "09:45";
                        $set_tutup_pelajaran2 = "11:45";
                        $set_buka_pelajaran3 = "13:00";
                        $set_tutup_pelajaran3 = "15:00";

                        $absen_msg = '';
                        $show_absen_button = false;

                        if ($now >= $set_buka_pelajaran1 && $now <= $set_tutup_pelajaran1) {
                            if ($cek == 0) {
                                $absen_msg = '<div class="alert alert-danger text-center">Anda belum Presensi pada mata pelajaran ke-1</div>';
                                $show_absen_button = true;
                            } else {
                                $absen_msg = '<div class="alert alert-success text-center">Anda telah Presensi pada mata pelajaran ke-1/3</div>';
                            }
                        } else if ($now >= $set_buka_pelajaran2 && $now <= $set_tutup_pelajaran2) {
                            if ($cek == 1) {
                                $absen_msg = '<div class="alert alert-danger text-center">Anda belum Presensi pada mata pelajaran ke-2</div>';
                                $show_absen_button = true;
                            } else {
                                $absen_msg = '<div class="alert alert-success text-center">Anda telah Presensi pada mata pelajaran ke-2/3</div>';
                            }
                        } else if ($now >= $set_buka_pelajaran3 && $now <= $set_tutup_pelajaran3) {
                            if ($cek == 2) {
                                $absen_msg = '<div class="alert alert-danger text-center">Anda belum Presensi pada mata pelajaran ke-3</div>';
                                $show_absen_button = true;
                            } else {
                                $absen_msg = '<div class="alert alert-success text-center">Anda telah Presensi pada seluruh mata pelajaran</div>';
                            }
                        } else {
                            $absen_msg = '<div class="alert alert-danger text-center">Presensi telah ditutup</div>';
                        }

                        echo $absen_msg;

                        if ($show_absen_button) {
                            echo '<form action="absen.php?a=M" method="post">';
                            echo '<button type="submit" id="btnAbsen" name="submit" class="btn btn-success btn-block btn-lg">Presensi</button>';
                            echo '</form>';
                            echo '<form method="post">
                                <button id="izin" type="button" class="btn btn-warning btn-block btn-lg mt-3"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">Klik disini jika tidak masuk/absen</button>
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
                                                <div>
                                                    <label for="inputnama" class="col-sm-2 col-form-label">Nama:</label>
                                                    <input type="text" class="form-control" name="tnama" id="tnama"
                                                        value="">
                                                </div>
                                                <div>
                                                    <label for="inputnama" class="col-sm-2 col-form-label">NIS:</label>
                                                    <input type="text" class="form-control" name="tnis" id="tnis"
                                                        value="">
                                                </div>
                                                <div>
                                                    <label for="inputnama" class="col-sm-2 col-form-label">Kelas:</label>
                                                    <select name="tkelas" id="tkelas" class="form-select" required>
                                                        <option value="<?= $vkelas ?>"><?= $vkelas ?></option>
                                                        <?php
                                                        $qry = $koneksi->query("SELECT * FROM tblkelas");
                                                        while ($data = $qry->fetch_assoc()) { ?>
                                                            <option value="<?= $data["kelas"]; ?>"><?= $data["kelas"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="inputnama" class="col-sm-2 col-form-label">Tanggal:</label>
                                                    <input type="date" class="form-control" name="ttanggal"
                                                        id="ttanggal" value="">
                                                </div>
                                                <div>
                                                    <label for="inputnama" class="col-sm-2 col-form-label">Keterangan:</label>
                                                    <select name="tketerangan" id="tketerangan" class="form-select"
                                                        required>
                                                        <option selected>- Pilih Keterangan -</option>
                                                        <option value="Sakit">Sakit</option>
                                                        <option value="Izin">Izin</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="inputnama" class="col-sm-2 col-form-label">Alasan:</label>
                                                    <textarea type="text" class="form-control" name="talasan"
                                                        id="talasan"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                                                <button class="btn btn-danger" name="breset" type="reset">Reset</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>';
                        }
                        ?>




                        <?php
                        require('../template/footer.php');
                        ?>

                        <script>
                            // jika jam lebih dari 18.00 maka button absen disabled
                            var jamBerakhir = document.getElementById("jamBerakhir");
                            var btnAbsen = document.getElementById("btnAbsen");
                            var izin = document.getElementById("izin");

                            if (jamBerakhir) {
                                // hilangkan id btnAbsen dan izin lalu ,tambahkan pesan di dalam id pesan
                                btnAbsen.style.display = "none";
                                izin.style.display = "none";
                                jamBerakhir.style.display = "none";
                            }
                        </script>