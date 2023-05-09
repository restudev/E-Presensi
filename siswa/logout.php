<?php 

session_start();
include_once "../koneksi.php";

//membatasi halaman sebelum login
if (!isset($_SESSION["login"])){
  echo "<script>
  alert('Silahkan login terlebih dahulu!');
        document.location.href = 'index.php';
  </script>";
  exit;
}

//kosongkan $_SESSION user login
$_SESSION = [];

session_unset();
session_destroy();
header("location: ../index.php")


?>