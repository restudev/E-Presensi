<?php
date_default_timezone_set('asia/jakarta');
session_start();
require('../koneksi.php');

if (isset($_POST['submit'])) {
    $tgl = date('Y-m-d');
    if ($_GET['a'] == 'M') {
        $nama_siswa = $_SESSION['nama'];
        $nis = $_SESSION['nis'];
        $kelas = $_SESSION['kelas'];
        $now = new DateTime();
        
        // inisialisasi jam absen
        $masuk1 = null;
        $masuk2 = null;
        $masuk3 = null;
        
        // memeriksa masuk keberapa saat ini
        if ($now >= new DateTime("07:00") && $now <= new DateTime("09:00")) {
            $masuk1 = $now->format("Y-m-d H:i:s");
        } else if ($now >= new DateTime("09:45") && $now <= new DateTime("11:45")) {
            $masuk2 = $now->format("Y-m-d H:i:s");
        } else if ($now >= new DateTime("13:00") && $now <= new DateTime("15:00")) {
            $masuk3 = $now->format("Y-m-d H:i:s");
        }
        
        // menyimpan data absensi ke database
        $query = mysqli_query($koneksi, "INSERT INTO tblabsen(nama_siswa,nis,kelas,masuk1,masuk2,masuk3,tgl_absen) VALUES('$nama_siswa','$nis','$kelas','$masuk1','$masuk2','$masuk3','$tgl')");
        if ($query) {
            header('location: index.php');
        }
    } else {
        header('location: index.php');
    }
}
?>