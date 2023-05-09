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
    // pengujian apakah data akan diedit atau disimpan baru
    if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
      // data akan diedit
      $update = mysqli_query($koneksi, "UPDATE tbljadwal SET
                                              hari    = '$_POST[thari]',
                                              mulai     = '$_POST[tmulai]',
                                              selesai  = '$_POST[tselesai]',
                                              kelas   = '$_POST[tkelas]',
                                              mapel   = '$_POST[tmapel]',
                                              ruang   = '$_POST[truang]',
                                              guru   = '$_POST[tguru]'
  
                                          WHERE id = '$_GET[id]'
                                          ");
  
      // uji jika edit data berhasil
      if ($update) {
        echo "<script>   
              alert('Yeayy update data sukses!');
              document.location= 'jadwal.php';
            </script>";
      } else {
        echo "<script>   
            alert('Yahh update data gagal!');
            document.location= 'jadwal.php';
          </script>";
      }
    } else {
      // jika bukan edit maka data akan disimpan baru
      $thari = $_POST['thari'];
      $tmulai = $_POST['tmulai'];
      $tselesai = $_POST['tselesai'];
      $tkelas = $_POST['tkelas'];
      $tmapel = $_POST['tmapel'];
      $truang = $_POST['truang'];
      $tguru = $_POST['tguru'];
  
      // menjalankan query
      $query = "INSERT INTO tbljadwal (hari, mulai, selesai, kelas, mapel, ruang, guru) VALUES ('$thari', '$tmulai', '$tselesai', '$tkelas', '$tmapel', '$truang', '$tguru')";
  
      // uji jika simpan data berhasil
      $running = mysqli_query($koneksi, $query);
      if ($running) {
        echo "<script>   
              alert('Yeayy simpan data sukses!');
              document.location= 'jadwal.php';
            </script>";
      } else {
        echo "<script>   
            alert('Yahh simpan data gagal!');
            document.location= 'jadwal.php';
          </script>";
      }
    }
  } else if (isset($_GET['hal']) && $_GET['hal'] == "hapus") {
    // persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM tbljadwal WHERE id ='$_GET[id]' ");
    // uji jika hapus data berhasil
    if ($hapus) {
      echo "<script>   
          alert('Yeayy hapus data sukses!');
          document.location= 'jadwal.php';
        </script>";
    } else {
      echo "<script>   
        alert('Yahh hapus data gagal!');
        document.location= 'jadwal.php';
      </script>";
    }
  }

//deklarasi variabel untuk menampung data yang akan diedit
$vhari = "";
$vmulai = "";
$vselesai = "";
$vkelas = "";
$vmapel = "";
$vruang = "";
$vguru = "";

//pengujian jika tombol edit / hapus diklik
if (isset($_GET['hal'])) {
    //pengujian jika edit data
    if ($_GET['hal'] == "edit") {
        //tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbljadwal WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //jika data ditemukan, maka data ditampung ke dalam variabel
            $vhari = $data['hari'];
            $vmulai = $data['mulai'];
            $vselesai = $data['selesai'];
            $vkelas = $data['kelas'];
            $vmapel = $data['mapel'];
            $vruang = $data['ruang'];
            $vguru = $data['guru'];
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                                </span> <img class="img-profile rounded-circle"
                                    src="../assets/img/undraw_profile_1.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan Akun
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><b>Jadwal</h1>
                    <br>
                    <!-- Awal Card -->
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            Form Input Jadwal
                        </div>
                        <div class="card-body">
                            <!-- awal form -->
                            <form method="POST">
                                <div class="mb-3 row">
                                    <label for="inputnama" class="col-sm-2 col-form-label">Hari</label>
                                    <div class="col-sm-5">
                                        <select class="form-select" aria-label="Default select example" name="thari"
                                            id="thari" value="<?= $vhari ?>">
                                            <option selected>- Pilih Hari -</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputnama" class="col-sm-2 col-form-label">Jam Mulai</label>
                                    <div class="col-sm-5">
                                        <input type="time" class="form-control" name="tmulai" id="tmulai"
                                            value="<?= $vmulai ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputnama" class="col-sm-2 col-form-label">Jam Selesai</label>
                                    <div class="col-sm-5">
                                        <input type="time" class="form-control" name="tselesai" id="tselesai"
                                            value="<?= $vselesai ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputnama" class="col-sm-2 col-form-label">Kelas</label>
                                    <div class="col-sm-5">
                                        <select name="tkelas" id="tkelas" class="form-select" required>
                                            <option value="<?= $vkelas ?>"><?= $vkelas ?></option>
                                            <?php
                                            $qry = $koneksi->query("SELECT * FROM tblkelas");
                                            while ($data = $qry->fetch_assoc()) { ?>
                                                <option value="<?= $data['kelas']; ?>"><?= $data['kelas']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputnama" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                    <div class="col-sm-5">
                                        <select name="tmapel" id="tmapel" class="form-select" required>
                                            <option value="<?= $vmapel ?>"><?= $vmapel ?></option>
                                            <?php
                                            $qry = $koneksi->query("SELECT * FROM tblmapel");
                                            while ($data = $qry->fetch_assoc()) { ?>
                                                <option value="<?= $data['mapel']; ?>"><?= $data['mapel']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputnama" class="col-sm-2 col-form-label">Ruang</label>
                                    <div class="col-sm-5">

                                        <input type="text" class="form-control" name="truang" id="truang"
                                            value="<?= $vruang ?>">
                                    
                                </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputnama" class="col-sm-2 col-form-label">Guru Pengampu</label>
                            <div class="col-sm-5">
                                <select name="tguru" id="tguru" class="form-select" required>
                                    <option value="<?= $vguru ?>"><?= $vguru ?></option>
                                    <?php
                                    $qry = $koneksi->query("SELECT * FROM tblguru");
                                    while ($data = $qry->fetch_assoc()) { ?>
                                        <option value="<?= $data['nama']; ?>"><?= $data['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="text-center">
                            <hr>
                            <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                            <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                        </div>
                        </form>
                        <!-- akhir form -->
                    </div>
                    <div class="card-footer bg-primary">

                    </div>
                </div>
                <!-- Akhir Card -->

                <!-- Awal Tabel -->
                <div class="card mt-4">
                    <div class="card-header bg-primary text-light">
                        Jadwal
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
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Kelas</th>
                                <th>Mata pelajaran</th>
                                <th>Ruang</th>
                                <th>Guru Pengampu</th>
                                <th>Aksi</th>
                            </tr>

                            <?php
                            $no = 1;

                            //pencarian data
                            //jika tombol cari diklik
                            if (isset($_POST['bcari'])) {
                                //tampilkan data yang dicari
                                $keyword = $_POST['tcari'];
                                $q = "SELECT * FROM tbljadwal WHERE hari like '%$keyword%' or mapel like '%$keyword%' or selesai like '%$keyword%' or mulai like '%$keyword%' or kelas like '%$keyword%' or ruang  like '%$keyword%' or guru like '%$keyword%' order by id desc";

                            } else {
                                $q = "SELECT * FROM tbljadwal order by id desc";
                            }

                            $tampil = mysqli_query($koneksi, $q);
                            while ($data = mysqli_fetch_array($tampil)):
                                ?>

                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= $data['hari'] ?>
                                    </td>
                                    <td>
                                        <?= $data['mulai'] ?>
                                    </td>

                                    <td>
                                        <?= $data['selesai'] ?>
                                    </td>
                                    <td>
                                        <?= $data['kelas'] ?>
                                    </td>
                                    <td>
                                        <?= $data['mapel'] ?>
                                    </td>
                                    <td>
                                        <?= $data['ruang'] ?>
                                    </td>
                                    <td>
                                        <?= $data['guru'] ?>
                                    </td>
                                    <td>
                                        <a href="jadwal.php?hal=edit&id=<?= $data['id'] ?>"
                                            class="btn btn-warning">Edit</a>
                                        <a href="jadwal.php?hal=hapus&id=<?= $data['id'] ?>" class="btn btn-danger"
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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