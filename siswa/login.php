<?php
session_start();
include_once '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil nilai dari form login
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Mengambil data user dari database
  $sql = "SELECT * FROM tblsiswa WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($koneksi, $sql);

  // Mengecek apakah data user ditemukan
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Menyimpan data user pada session
    $_SESSION["username"] = $row["username"];
    $_SESSION["nama"] = $row["nama"];
    $_SESSION["nis"] = $row["nis"];
    $_SESSION["walikelas"] = $row["walikelas"];
    $_SESSION["kelas"] = $row["kelas"];

    // Menyimpan status login pada session
    $_SESSION["login"] = true;

    // Mengarahkan user ke halaman utama
    header("location: index.php");
    exit;
  } else {
    // Jika data user tidak ditemukan, tampilkan pesan kesalahan
    $error = "Username atau password salah!";
  }
}
?>



<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-../assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Login-Admin</title>
  <meta name="description" content="" />
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bolder">Login Siswa</span>

              </a>

            </div>
            <?php
            if (isset($error)) : ?>
              <div class="alert alert-danger text-center">
                <b>Username/Password Salah!</b>
              </div>
            <?php endif; ?>
            <!-- /Logo -->
            <form method="POST">
              <div class="mb-3">
                <label for="text" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="NIS" required />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" class="form-control" name="password" placeholder="dd-mm-yyyy" aria-describedby="password" required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="login">Sign in</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js ../assets/vendor/js/core.js -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets/vendor/js/menu.js"></script>
  <script src="../assets/js/main.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>