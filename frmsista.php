<?php 
    session_start();
    include "koneksi.php";
    include "modul.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $idMenu = 311;
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
    <style>
        select, input, span {
            margin-bottom: 0.2rem;
        }
    </style>
    <script src="alat2/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include "ss_menuatas.php" ?>
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include "ss_menukiri.php"; ?>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h4 class="mt-4">Pendaftaran Latihan Tari</h4>

                    <form method="post" action="sistain.php">
                        <div class="form-group row">
                            <?php 
                            $querySiswa = "SELECT * FROM t_siswa";

                            $resultSiswa = mysqli_query($conSS, $querySiswa);

                            while($rowSiswa = $resultSiswa->fetch_array(MYSQLI_ASSOC)){
                                $arrSiswa[] = $rowSiswa;
                            }
                            ?>
                            <label for="txtID" class="col-2 col-form-label">Nomor Registrasi</label>
                            <div class="col-2">
                                <select name="txtId" id="noregis" class="form-control" >
                                    <option value="0">--- Pilih Siswa ---</option>
                                    <?php foreach($arrSiswa as $arrSiswa): ?>
                                        <option value="<?= $arrSiswa['ID'] ?>" nama="<?= $arrSiswa['nama'] ?>"><?= $arrSiswa['ID'] . " - " . $arrSiswa['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtNama" class="col-2 col-form-label">Nama Siswa</label>
                            <div class="col-2">
                                <input class="form-control" name="txtNama" type="text" value="" id="nama" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="cbbTari" class="col-2 col-form-label">Nama Tarian</label>
                            <div class="col-2">
                                <?php
                                    $st = "SELECT kode, nama
                                            FROM t_tari
                                           WHERE aktif = 'Y'
                                           ORDER BY nama";
                                    
                                    $qrySS = mysqli_query($conSS, $st);
                                ?> 
                                <select class="form-control" name="cbbTari">
                                    <?php while ($data = mysqli_fetch_array($qrySS)) : ?>
                                        <option value="<?= $data['kode']; ?>"><?= $data['nama']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cbbMetode" class="col-2 col-form-label">Metode Latihan</label>
                            <div class="col-2">
                                <select class="form-control" name="cbbMetode" >
                                    <option value="K">Kelompok</option>
                                    <option value="P">Privat</option>
                                </select>
                            </div>
                        </div>

                        <?php 
                            // ambil hari ini 
                            $tggl = $_SESSION['harini'];

                            $prd  = nextPrd(date_format($tggl, "ym")); 
                        ?>
                        <div class="form-group row">
                            <label for="txtPeriode" class="col-2 col-form-label">Periode</label>
                            <div class="col-2">
                                <input class="form-control" name="txtPeriode" type="text"
                                    value="<?= getPeriode($prd); ?>" readonly>
                                <input name="txtPrd" type="hidden" value="<?= $prd ?>">
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-2"></div>
                            <div class="col">
                                 <button class="btn btn-sm btn-primary" name="btnSimpan" type="submit">
                                    <i class="fas fa-save"></i> Simpan </button>
                                 <a href="frmsiswa.php" class="btn btn-sm btn-secondary ms-2">
                                    <i class="fas fa-ban"></i> Batalkan</a>
                            </div>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        // function setNama(val) {
        //     // var selectedOption = document.getElementById("noregis").getAttribute('value');
        //     let selected = $("#noregis").attr("nama");
        //     document.getElementById("nama").setAttribute('value', selected);
        //     console.log(selected)
        // }
        $('#noregis').change(function(){        
            $("#nama").val($(this).find(':selected').attr('nama'));
        });
    </script>
</body>
</html>