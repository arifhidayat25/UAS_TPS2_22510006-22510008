<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 23;
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" value="notranslate">
    <meta name="robots" content="nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sangkuriang">
    <meta name="author" content="Arif & Dana">
    <link rel="icon" href="alat2/uniga.ico">

    <title>Sangkuriang</title>

    <link rel="stylesheet" href="alat2/styles.css">
    <link rel="stylesheet" href="alat2/all.min.css">
    <script src="alat2/all.min.js"></script>
</head>

<body class="sb-nav-fixed" onload="window.print()">
    <?php
    $kode = $_GET['kode'];
    $getTari = mysqli_query($conSS, "SELECT * FROM t_tari WHERE kode = '$kode'");
    $rowTari = $getTari->fetch_array(MYSQLI_ASSOC);
    ?>
    <div id="layoutSidenav">

        <div id="layoutSidenav_content">
            <div class="row">
                <div class="col-2">
                    <img src="alat2/sangkuriang.png" alt="" class="img-fluid m-4" width="100">
                </div>
                <div class="col-7 ms-3">
                    <h5 class="mt-4 text-start">Sanggar Tari "Sangkuriang"</h5>
                    <span>Jl. Cikutra 10</span>
                    <br>
                    <span>Telp (022) 7218134</span>
                    <br>
                    <span>Bandung</span>
                </div>
                <div class="col-2">
                    <span>Kelas:</span>
                    <br>
                    <h6><?= $kode ?></h6>
                </div>
            </div>
            <div class="row">
                <h5 class="text-center text-decoration-underline">Daftar Hadir Latihan Tari</h5>
            </div>
            <div class="row mx-3">
                <?php
                $getPengajar = mysqli_query($conSS, "SELECT * FROM t_guri JOIN t_guru ON t_guri.idGuru = t_guru.ID WHERE t_guri.idTari = '$kode'");
                $rowPengajar = $getPengajar->fetch_array(MYSQLI_ASSOC);
                ?>
                <table>
                    <tr>
                        <td>Tarian</td>
                        <td>:</td>
                        <th><?= $rowTari['nama'] ?></th>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="text-start">Jadwal Latihan</td>
                        <td class="text-end">:</td>
                        <th class="text-end">Senin 17:00 dan Kamis 16:00</th>
                    </tr>
                    <tr>
                        <td>Pengajar</td>
                        <td>:</td>
                        <th><?= $rowPengajar['nama'] ?></th>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="text-start">Tanggal Latihan</td>
                        <td class="text-end">:</td>
                        <th class="text-end"><?= date("01 M 2024") . " s.d " . date("01 M 2024", strtotime("+" . $rowTari['lama'] . " week")) ?></th>
                    </tr>
                </table>
            </div>
            <main>
                <div class="container-fluid px-4">
                    <form method="post" action="gunoraksi.php">
                        <?php
                        $arrSiswa = array();
                        $getSiswa = mysqli_query($conSS, "SELECT * FROM t_sista JOIN t_siswa ON t_sista.no_regis = t_siswa.ID WHERE t_sista.kode_tari = '$kode'");
                        while ($rowSiswa = $getSiswa->fetch_array(MYSQLI_ASSOC)) {
                            $arrSiswa[] = $rowSiswa;
                        }
                        ?>
                        <table class="table table-sm mt-3">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center border">No.</th>
                                    <th rowspan="2" class="text-center border">NIP</th>
                                    <th rowspan="2" class="text-center border">Nama Peserta</th>
                                    <th rowspan="2" colspan="<?= $rowTari['lama'] + 1 ?>" class="text-center border">Tanda Tangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($arrSiswa as $arrSiswa) : ?>
                                    <tr>
                                        <td class="text-center border"><?= $no++ ?></td>
                                        <td class="text-left border"><?= $arrSiswa['ID'] ?></td>
                                        <td class="text-left border"><?= $arrSiswa['nama'] ?></td>
                                        <?php for ($i = 0; $i < $rowTari['lama']; $i++) : ?>
                                            <th class="text-center border">&nbsp;&nbsp;&nbsp;</th>
                                        <?php endfor; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="border-start"></td>
                                    <td class="text-left border-end border-bottom" colspan="2"><?= $rowPengajar['nama'] ?></td>
                                    <?php for ($i = 0; $i < $rowTari['lama']; $i++) : ?>
                                        <th class="text-center border">&nbsp;&nbsp;&nbsp;</th>
                                    <?php endfor; ?>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-item-center justify-content-between small">
            <div class="text-muted">&copy; 2024 Arif & Dana</div>
        </div>
    </div>
</footer>
        </div>
    </div>

    <script src="alat2/bootstrap.bundle.min.js"></script>
    <script src="alat2/scripts.js"></script>
    <script>
    </script>
</body>

</html>