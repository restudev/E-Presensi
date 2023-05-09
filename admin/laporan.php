<?php
session_start();
include_once "../koneksi.php";
?>
<html>

<head>
    <title>Rekap Presensi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Rekap Presensi</h2>
        <div class="data-tables datatable-dark">

            <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Presensi Jam Ke-1</th>
                    <th>Presensi Jam Ke-2</th>
                    <th>Presensi Jam Ke-3</th>
                    <th>Tanggal Presensi</th>
                </tr>
                <thead>
                <tbody>
                <?php
                $no = 1;

                //pencarian data
                //jika tombol cari diklik
                if (isset($_POST['bcari'])) {
                    //tampilkan data yang dicari
                    $keyword = $_POST['tcari'];
                    $q = "SELECT * FROM tblabsen WHERE nama_siswa like '%$keyword%' or kelas like '%$keyword%' or tgl_absen like '%$keyword%' order by id desc";

                } else {
                    $q = "SELECT * FROM tblabsen order by id desc";
                }

                $tampil = mysqli_query($koneksi, $q);
                while ($data = mysqli_fetch_array($tampil)):
                    ?>

                    <tr>
                        <td>
                            <?= $no++ ?>
                        </td>
                        <td>
                            <?= $data['nis'] ?>
                        </td>
                        <td>
                            <?= $data['nama_siswa'] ?>
                        </td>

                        <td>
                            <?= $data['kelas'] ?>
                        </td>
                        <td>
                            <?= $data['masuk1'] ?>
                        </td>
                        <td>
                            <?= $data['masuk2'] ?>
                        </td>
                        <td>
                            <?= $data['masuk3'] ?>
                        </td>
                        <td>
                            <?= $data['tgl_absen'] ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#mauexport').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>