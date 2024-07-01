<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    border: 1px solid #000;
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

.logo {
            width: 150px;
            height: 100px;
            float: left;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        p {
            text-align: center;
            margin: 0;
        }
</style>

<?php 
$bulan = date("F Y"); // Nama bulan dan tahun dalam bahasa Inggris

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
?>

<body>
    <div class="container">
    <div class="logo">
            <img src="alat2/sangkuriang.png" alt="logo">
        </div>
        <h1>Sanggar Tari "Sangkuriang"</h1>
        <p>Jl. Cikutra 10<br>Telp. (022) 7218134</p>
        <h2>Laporan Keuangan</h2> <h2><?php echo $bulan; ?></h2>
        
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
    <script>
		window.print();
	</script>
</body>
</html>
