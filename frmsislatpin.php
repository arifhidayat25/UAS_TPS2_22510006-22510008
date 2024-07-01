<?php
session_start();
include "koneksi.php";
include "modul.php";

// Inisialisasi variabel pesan
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_regis = $_POST['no_regis'];
    $nama_siswa = $_POST['nama_siswa'];
    $nama_tarian = $_POST['nama_tarian'];
    $metode_latihan = $_POST['metode_latihan'];
    $kelas = $_POST['kelas'];

    if (isset($_POST['btnSimpan'])) {
        $periode_baru = $_POST['periode_baru'];
        // Lakukan update ke database untuk memindahkan periode latihan
        $updateQuery = "UPDATE t_sista SET periode = '$periode_baru' WHERE no_regis = '$no_regis'";
        $updateResult = mysqli_query($conSS, $updateQuery);

        if ($updateResult) {
            $pesan = "<div class='alert alert-success mt-3'>Periode berhasil diupdate.</div>";
        } else {
            $pesan = "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conSS) . "</div>";
        }
    }
} else {
    header("Location: frmsislat.php");
    exit;
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
    <link rel="icon" href="alat2/sangkuriang.ico">

    <title>Sangkuriang</title>

    <link rel="stylesheet" href="alat2/styles.css">
    <link rel="stylesheet" href="alat2/all.min.css">
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
                    <h4 class="mt-4">Pindah Periode Latihan</h4>

                    <form action="frmsislatpin.php" method="post">
                        <input type="hidden" name="no_regis" value="<?= $no_regis; ?>">
                        <div class="mb-3">
                            <label for="nama_tarian" class="form-label">Nama Tarian</label>
                            <input type="text" class="form-control" id="nama_tarian" name="nama_tarian" value="<?= $nama_tarian; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_regis" class="form-label">No. Reg.</label>
                            <input type="text" class="form-control" id="no_regis" name="no_regis" value="<?= $no_regis; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $nama_siswa; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="metode_latihan" class="form-label">Metode Latihan</label>
                            <input type="text" class="form-control" id="metode_latihan" name="metode_latihan" value="<?= $metode_latihan; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $kelas; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="periode_baru" class="form-label">Periode Baru</label>
                            <input type="date" class="form-control" id="periode_baru" name="periode_baru" required>
                        </div>
                        <button type="submit" name="btnSimpan" class="btn btn-primary">Simpan</button>
                        <a href="frmsislat.php" class="btn btn-secondary">Batalkan</a>
                    </form>

                    <!-- Tampilkan pesan berhasil atau gagal disini -->
                    <?php echo $pesan; ?>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-item-center justify-content-between small">
                        <div class="text-muted">&copy;2024 Diah & Sulis.unigamalang</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="alat2/bootstrap.bundle.min.js"></script>
    <script src="alat2/scripts.js"></script>
</body>

</html>