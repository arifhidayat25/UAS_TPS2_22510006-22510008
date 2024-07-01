<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 0;

// Ambil data guru dan gaji dari database
$st = "SELECT t_guru.ID, t_guru.nama, t_gunor.GaPok, t_gunor.idxHR
       FROM t_guru 
       LEFT JOIN t_gunor ON t_guru.ID = t_gunor.idGuru
       ORDER BY t_guru.nama";

$qrySS = mysqli_query($conSS, $st);

// fungsi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil nilai dari form
  $nama = $_POST['nama'];
  $gajiText = $_POST['gaji'];

  // Hilangkan simbol mata uang dan tanda pemisah ribuan
  $gajiText = str_replace(['Rp. ', '.', ','], '', $gajiText);

  // Konversi ke tipe data numerik
  $gaji = floatval($gajiText);

  // Ambil tanggal hari ini
  $bulan = date("F Y"); // Nama bulan dan tahun dalam bahasa Inggris
  $tanggal = date("Y-m-d");

  // Uraian untuk hasil
  $uraian = "Gaji bulan " . $bulan . " atasnama " . $nama;

  //  untuk menyimpan ke database
  $st_insert = "INSERT INTO transaksi (nomor, tanggal, uraian, penerimaan, pengeluaran) 
                VALUES (NULL, ?, ?, NULL, ?)";
  $stmt = mysqli_prepare($conSS, $st_insert);
  mysqli_stmt_bind_param($stmt, 'sss', $tanggal, $uraian, $gaji);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    echo '<script>alert("Data berhasil disimpan.");</script>';
  } else {
    echo '<script>alert("Gagal menyimpan data: ' . mysqli_error($conSS) . '");</script>';
  }

  mysqli_stmt_close($stmt);
}

mysqli_close($conSS);
?>

<!DOCTYPE html>
<html lang="en">
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
<body class="sb-nav-fixed">
    <?php include "ss_menuatas.php" ?>
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include "ss_menukiri.php"; ?>
        </div>

        <div id="layoutSidenav_content">
            <main>
  <div class="container mt-5">
    <h2>Form Gaji</h2>
    <form method="post">
      <div class="form-group">
        <label for="nama">Nama:</label>
        <select class="form-control" id="nama" name="nama" onchange="updateFields()" required>
          <option value="">Pilih Nama</option>
          <?php while ($data = mysqli_fetch_assoc($qrySS)): ?>
            <option value="<?= htmlspecialchars($data['nama']); ?>"
                    data-gaji="<?= htmlspecialchars($data['GaPok']); ?>"
                    data-indeks-honor="<?= htmlspecialchars($data['idxHR']); ?>">
              <?= htmlspecialchars($data['nama']); ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="gaji">Gaji Pokok:</label>
        <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Gaji Pokok" readonly required>
      </div>
      <div class="form-group">
        <label for="indeksHonor">Indeks Honor:</label>
        <input type="text" class="form-control" id="indeksHonor" name="indeksHonor" placeholder="Indeks Honor" readonly required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </main>

<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-item-center justify-content-between small">
            <div class="text-muted">&copy; 2024 Arif & Dana</div>
        </div>
    </div>
</footer>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="alat2/bootstrap.bundle.min.js"></script>
    <script src="alat2/scripts.js"></script>
  <script>
    function updateFields() {
      var select = document.getElementById("nama");
      var nama = select.value; // Ambil nilai nama guru yang dipilih
      var gaji = select.options[select.selectedIndex].dataset.gaji; // Ambil nilai gaji dari data attribute
      var indeksHonor = select.options[select.selectedIndex].dataset.indeksHonor; // Ambil nilai indeks honor dari data attribute

      // Set nilai gaji dan indeks honor ke input field
      document.getElementById("gaji").value = gaji ? "Rp. " + Number(gaji).toLocaleString('id-ID') + ",-" : "";
      document.getElementById("indeksHonor").value = indeksHonor ? "Rp. " + Number(indeksHonor).toLocaleString('id-ID') + ",-" : "";
    }

    // fungsi updateFields saat halaman dimuat pertama kali
    updateFields();
  </script>
</body>
</html>
