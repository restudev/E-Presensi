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
else {
    require('../template/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary text-center">Data Presensi</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Presensi Jam Ke-1</th>
                        <th>Presensi Jam Ke-2</th>
                        <th>Presensi Jam Ke-3</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = $_SESSION['nama'];
                        $q = "SELECT * FROM tblabsen order by id desc";
                        $result = mysqli_query($koneksi, $q);
                        if (!$result) {
                            die(mysqli_error($koneksi));
                        }
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama_siswa'] ?></td>
                        <td><?= $data['nis'] ?></td>
                        <td><?= $data['kelas'] ?></td>
                        <td><?= $data['masuk1'] ?></td>
                        <td><?= $data['masuk2'] ?></td>
                        <td><?= $data['masuk3'] ?></td>
                        
                        <td><?= $data['tgl_absen'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- /.container-fluid -->
<?php
    require('../template/footer.php');
}
?>
