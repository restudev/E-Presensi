<?php
require('../koneksi.php');

if (isset($_GET['id']) && isset($_GET['s'])) {
    $id = $_GET['id'];
    $s = $_GET['s'];

    if ($s === 'Y') { // jika status yang dipilih adalah 'Terima'
        // ubah status pengajuan menjadi 'Pending' terlebih dahulu
        $query = mysqli_query($koneksi, "UPDATE tblizin SET status = 'P' WHERE id = '$id'");
        if ($query) {
            // jika berhasil mengubah status menjadi 'Pending'
            // ubah status pengajuan menjadi 'Terima'
            $query = mysqli_query($koneksi, "UPDATE tblizin SET status = '$s' WHERE id = '$id'");
            if ($query) {
                header('location: izin.php');
            } else {
                echo "<script>alert('Gagal mengubah status'); window.location='izin.php'</script>";
            }
        } else {
            echo "<script>alert('Gagal mengubah status'); window.location='izin.php'</script>";
        }
    } else { // jika status yang dipilih adalah 'Tolak' atau 'Pending'
        // langsung ubah status pengajuan sesuai dengan yang dipilih
        $query = mysqli_query($koneksi, "UPDATE tblizin SET status = '$s' WHERE id = '$id'");
        if ($query) {
            header('location: izin.php');
        } else {
            echo "<script>alert('Gagal mengubah status'); window.location='izin.php'</script>";
        }
    }
} else {
    header('location: izin.php');
}
?>
