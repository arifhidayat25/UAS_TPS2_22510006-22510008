<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 110;

if (isset($_SESSION['nGuru']) && $_SESSION['nGuru'] < 1) {
    $_SESSION['aktif'] = "T";
}
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
        select,
        input,
        span {
            margin-bottom: 0.2rem;
        }
    </style>
    <script src="alat2/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include "ss_menuatas.php" ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include "ss_menukiri.php" ?>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h4 class="mt-4">Tarian</h4>
                    <?php if (isset($_SESSION['salah']) && $_SESSION['salah'] > 0) : ?>
                        <div class="alert alert-danger my-4">
                            Harap diisi dengan lengkap dan benar.
                        </div>
                    <?php endif; ?>

                    <form method="post" action="taribahin.php">
                        <div class="form-group row">
                            <label for="txtNama" class="col-2 col-form-label">Nama Tarian</label>
                            <div class="col-3">
                                <input type="text" name="txtNama" class="form-control" 
                                        value="<?= $_SESSION['nama']; ?>" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cbbJenis" class="col-2 col-form-label">Jenis</label>
                            <div class="col-2">
                                <select name="cbbJenis" class="form-control">
                                    <option <?php if ($_SESSION['jenis'] == "D") echo "selected='selected'"; ?> value="D">Daerah</option>
                                    <option <?php if ($_SESSION['jenis'] == "M") echo "selected='selected'"; ?> value="M">Modern</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtLama" class="col-2 col-form-label">Lama Latihan</label>
                            <div class="col-1">
                                <input type="text" name="txtLama" class="form-control" value="<?= $_SESSION['lama']; ?>">
                            </div>
                            <div class="col-1 mt-2">
                                <span>Minggu</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtGuru" class="col-2 col-form-label">Pengajar</label>
                            <div class="col-2">
                                <input type="text" name="txtGuru" class="form-control" value="<?php if ($_SESSION['nGuru'] < 1)
                                                                                                    echo "tidak ada";
                                                                                                else echo "Ada"; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cbbAktif" class="col-2 col-form-label">Aktif</label>
                            <div class="col-2">
                                <?php if ($_SESSION['nGuru'] < 1) : ?>
                                    <input type="text" name="cbbAktif" class="form-control" value="<?php if ($_SESSION['aktif'] == "Y") echo "Ya";
                                                                                                    else echo "Tidak"; ?>" readonly>
                                <?php else : ?>
                                    <select name="cbbAktif" class="form-control">
                                        <option <?php if ($_SESSION['aktif'] == "Y") echo "selected='selected'"; ?> value="Y">Ya</option>
                                        <option <?php if ($_SESSION['aktif'] == "T") echo "selected='selected'"; ?> value="T">Tidak</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-2"></div>
                            <div class="col">
                                <button class="btn btn-sm btn-primary" name="btnSimpan" type="submit">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="frmtari.php" class="btn btn-sm btn-secondary ms-2"> <i class="fas fa-ban"></i> Batalkan</a>
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
</body>

</html>
