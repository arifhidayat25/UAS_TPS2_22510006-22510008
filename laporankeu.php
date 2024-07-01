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
<style>
  body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 20px;

}

h1, h2 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

</style>

<?php 
$sql = 'SELECT * FROM transaksi';
$result = mysqli_query($conSS, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conSS));
}

$transaksi = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $transaksi[] = $row;
    }
}

$bulan = date("F Y"); // Nama bulan dan tahun dalam bahasa Inggris

?>

<body class="sb-nav-fixed">
    <?php include "ss_menuatas.php" ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include "ss_menukiri.php"; ?>
        </div>
    
<div id="layoutSidenav_content">
    <main>
    <div class="container">
    <h2>Laporan Keuangan</h2> <h2><?php echo $bulan; ?></h2>

    <a href="lapkeuprint.php" class="btn btn-primary float-end m-3" target="__blank">Cetak</a>

        
        <table>
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Uraian</th>
                    <th>Penerimaan</th>
                    <th>Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data transaksi
                $totalPenerimaan = 0;
                $totalPengeluaran = 0;
                foreach ($transaksi as $row) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['nomor']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['tanggal']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['uraian']) . '</td>';
                    echo '<td>' . ($row['penerimaan'] != 0 ? number_format($row['penerimaan'], 2) : '-') . '</td>';
                    echo '<td>' . ($row['pengeluaran'] != 0 ? number_format($row['pengeluaran'], 2) : '-') . '</td>';
                    echo '</tr>';
                    $totalPenerimaan += $row['penerimaan'];
                    $totalPengeluaran += $row['pengeluaran'];
                }
                ?>
                <!-- Jumlah -->
                <tr>
                    <td colspan="3">Jumlah</td>
                    <td><?php echo number_format($totalPenerimaan, 2); ?></td>
                    <td><?php echo number_format($totalPengeluaran, 2); ?></td>
                </tr>
            </tbody>
        </table>
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
</body>
<script src="alat2/bootstrap.bundle.min.js"></script>
    <script src="alat2/scripts.js"></script>
</html>
