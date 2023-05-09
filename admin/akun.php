<?php

session_start();
include_once "../koneksi.php";

//membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
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
        $update = mysqli_query($koneksi, "UPDATE tblsiswa SET
                                            nama     = '$_POST[tsiswa]',
                                            username  = '$_POST[tusername]',
                                            password = password_hash($_POST[tpassword], PASSWORD_BCRYPT)',
                                        WHERE id = '$_GET[id]'
                                        ");

        //uji jika edit data berhasil
        if ($update) {
            echo "<script>   
            alert('Yeayy update data sukses!');
            document.location= 'akun.php';
          </script>";
        } else {
            echo "<script>   
          alert('Yahh update data gagal!');
          document.location= 'akun.php';
        </script>";
        }
    } else {
        //jika bukan edit maka data akan disimpan baru
        $tsiswa = $_POST['tsiswa'];
        $tusername = $_POST['tusername'];
        $tpassword = password_hash($_POST['tpassword'], PASSWORD_BCRYPT);


        // menjalankan query
        $query = "INSERT INTO tblsiswa (nama, username, password) VALUES ('$tsiswa', '$tusername', '$tpassword')";

        //uji jika simpan data berhasil
        $running = mysqli_query($koneksi, $query);
        if ($running) {
            echo "<script>   
            alert('Yeayy simpan data sukses!');
            document.location= 'akun.php';
          </script>";
        } else {
            echo "<script>   
          alert('Yahh simpan data gagal!');
          document.location= 'akun.php';
        </script>";
        }
    }
} else if (isset($_GET['hal']) && $_GET['hal'] == "hapus") {
    //persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM tblsiswa WHERE id ='$_GET[id]' ");
    //uji jika hapus data berhasil
    if ($hapus) {
        echo "<script>   
        alert('Yeayy hapus data sukses!');
        document.location= 'akun.php';
      </script>";
    } else {
        echo "<script>   
      alert('Yahh hapus data gagal!');
      document.location= 'akun.php';
    </script>";
    }
}

//deklarasi variabel untuk menampung data yang akan diedit
$vsiswa = "";
$vusername = "";
$vpassword = "";

//pengujian jika tombol edit / hapus diklik
if (isset($_GET['hal'])) {
    //pengujian jika edit data
    if ($_GET['hal'] == "edit") {
        //tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tblsiswa WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan, maka data ditampung ke dalam variabel
            $vsiswa = $data['nama'];
            $vusername = $data['username'];
            $vpassword = $data['password'];
        }
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

    <title>Admin | Student</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />


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
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="bi bi-folder-fill"></i>
                    <span>Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Data:</h6>
                        <a class="collapse-item" href="manage-siswa.php">Siswa</a>
                        <a class="collapse-item" href="manage-guru.php">Guru</a>
                        <a class="collapse-item" href="manage-kelas.php">Kelas</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="bi bi-gear-fill"></i>
                    <span>Kurikulum</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Kurikulum:</h6>
                        <a class="collapse-item" href="mapel.php">Mata Pelajaran</a>
                        <a class="collapse-item" href="jadwal.php">Jadwal Pelajaran</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="akun.php">
                    <i class="bi bi-person-fill-gear"></i>
                    <span>Akun Siswa</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3"
                    aria-expanded="true" aria-controls="collapse3">
                    <i class="bi bi-gear-fill"></i>
                    <span>Presensi</span>
                </a>
                <div id="collapse3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Presensi:</h6>
                        <a class="collapse-item" href="rekap.php">Rekap Presensi Siswa</a>
                        <a class="collapse-item" href="izin.php">Izin Siswa</a>
                    </div>
                </div>
            </li>

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

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

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
                                </span>
                                <img class="img-profile rounded-circle" src="../assets/img/undraw_profile_1.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="setting.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan Akun
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><b>Data Akun Siswa</h1>
                        <!-- Awal Tabel -->
                        <div class="card mt-4">
                            <div class="card-header bg-primary text-light">
                                Data Akun Siswa
                            </div>
                            <div class="card-body">
                                <div class="col-md-6 mx-auto">
                                    <form method="POST">
                                        <div class="input-group mb-3">
                                            <input type="text" name="tcari" class="form-control"
                                                placeholder="Masukan kata kunci">
                                            <button class="btn btn-primary" name="bcari" type="sumbit">Cari</button>
                                            <button class="btn btn-danger" name="breset" type="submit">Reset</button>


                                        </div>

                                    </form>


                                </div>
                                <table class="table table-stripped table-hover table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Aksi</th>
                                    </tr>

                                    <?php
                                    $no = 1;

                                    //pencarian data
                                    //jika tombol cari diklik
                                    if (isset($_POST['bcari'])) {
                                        //tampilkan data yang dicari
                                        $keyword = $_POST['tcari'];
                                        $q = "SELECT * FROM tblsiswa WHERE nama like '%$keyword%' order by id desc";

                                    } else {
                                        $q = "SELECT * FROM tblsiswa order by id desc";
                                    }

                                    $tampil = mysqli_query($koneksi, $q);
                                    while ($data = mysqli_fetch_array($tampil)):
                                        ?>

                                        <tr>
                                            <td>
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                <?= $data['nama'] ?>
                                            </td>
                                            <td>
                                                <?= $data['username'] ?>
                                            </td>

                                            <td>
                                                <?= $data['password'] ?>
                                            </td>
                                            <td>
                                                <a href="akun.php?hal=hapus&id=<?= $data['id'] ?>" class="btn btn-danger"
                                                    onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Reset</a>
                                            </td>


                                        </tr>
                                    <?php endwhile; ?>
                                </table>

                            </div>
                            <div class="card-footer bg-primary">

                            </div>
                        </div>
                        <!-- Akhir Tabel -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; 2023</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin akan keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Keluar" jika kamu yakin akan mengakhiri sesi ini.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Keluar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>