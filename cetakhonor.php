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
    <div id="layoutSidenav">

        <div id="layoutSidenav_content">
            <div class="row">
                <div class="col-4">
                    <img src="alat2/sangkuriang.png" alt="" class="img-fluid m-4" width="100">
                </div>
                <div class="col-8">
                    <h4 class="mt-4 text-start">Honor Pengajar</h4>
                    <span class="text-start">Tgl Cetak: <?= date("d F Y") ?></span>
                </div>
            </div>
            <main>
                <div class="container-fluid px-4">
                    <form method="post" action="gunoraksi.php">
                        <?php 
                            $st = "SELECT ID, nama, aktif, t_gunor.*
                                    FROM t_guru LEFT JOIN t_gunor ON t_guru.ID = t_gunor.idGuru
                                    ORDER BY nama";

                            $qrySS = mysqli_query($conSS, $st);

                            $nmr = 1;
                        ?>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Pengajar</th>
                                    <th class="text-center">Jenis</th>
                                    <th class="text-center">Tanggal Masuk</th>
                                    <th class="text-center">Gaji Pokok</th>
                                    <th class="text-center">Indeks Honor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $totalGaji = 0;
                                $totalHonor = 0;
                                while ($data = mysqli_fetch_array($qrySS)) : 
                                $totalGaji += $data['GaPok'];
                                $totalHonor += $data['idxHR']; ?>
                                    <tr>
                                        <td class="text-center"><?= $nmr++; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td class="text-center"> <i><?php 
                                            if ($data['jenis'] == "F") echo "Full"; else echo "Part";
                                            ?>-time</i>
                                        </td>
                                        <td class="text-center"><?php 
                                            if(strtotime($data['tgMasuk']) != "")
                                            {
                                                $tggl = date_create($data['tgMasuk']);//tgMasuk ?
                                                echo date_format($tggl, "d-m-Y");
                                            }?>
                                        </td>
                                        <td class="text-end"><?php 
                                            if($data['GaPok'] > 0)
                                                echo "Rp. ". number_format($data['GaPok'], 0, ',', '.'). ",-";
                                            ?>
                                        </td>
                                        <td class="text-end"><?php 
                                            if($data['idxHR'] > 0)
                                                echo "Rp. ". number_format($data['idxHR'], 0, ',', '.'). ",-";
                                            ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th class="text-end"><?= "Rp. ". number_format($totalGaji, 0, ',', '.') . ",-" ?></th>
                                    <th class="text-end"><?= "Rp. ". number_format($totalHonor, 0, ',', '.') . ",-" ?></th>
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