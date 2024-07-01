<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir Latihan Tari</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h1, h2 {
            text-align: center;
        }

        p {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 5px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="alat2/sangkuriang.png" alt="logo">
        </div>
        <h1>Sanggar Tari "Sangkuriang"</h1>
        <p>Jl. Cikutra 10</p>
        <p>Telp. (022) 7218134</p>
        <h2>Daftar Hadir Latihan Tari</h2>
        <table>
            <tr>
                <th>Kelas</th>
                <td>1110-K01</td>
            </tr>
            <tr>
                <th>Tarian</th>
                <td id="nama-tarian"></td>
            </tr>
            <tr>
                <th>Pengajar</th>
                <td id="nama-pengajar">
                    <?php
                    $query_guru = "SELECT t_guri.idGuru, t_guru.nama AS namaPengajar, t_guri.idTari FROM t_guri JOIN t_guru ON t_guri.idGuru = t_guru.ID GROUP BY t_guru.ID";
                    $result_guru = mysqli_query($conSS, $query_guru);

                    if (!$result_guru) {
                        die("Error: " . mysqli_error($conSS));
                    }

                    $nomorGuru = 0;
                    while ($row_guru = mysqli_fetch_assoc($result_guru)) {
                        $nomorGuru++;
                        echo "{$row_guru['namaPengajar']}";
                        if ($nomorGuru != mysqli_num_rows($result_guru)) {
                            echo ", ";
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Jadwal latihan</th>
                <td>Senin 17:00 dan Kamis 16:00</td>
            </tr>
            <tr>
                <th>Tanggal latihan</th>
                <td id="tanggal-latihan"></td>
            </tr>
        </table>
        <br>
        <h2>Daftar Peserta</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIP</th>
                    <th>Nama Peserta</th>
                    <th colspan="8">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tgl</td>
                    <td></td>
                    <td>Tanggal</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <?php
                $query = "SELECT t_sista.no_regis, t_siswa.nama AS 'Nama Siswa', t_sista.metode_latihan, t_sista.kelas, t_tari.nama AS 'Nama Tarian'
                          FROM t_sista
                          INNER JOIN t_tari ON t_sista.kode_tari = t_tari.kode
                          INNER JOIN t_siswa ON t_sista.no_regis = t_siswa.ID
                          ORDER BY t_tari.nama, t_sista.metode_latihan";
                $result = mysqli_query($conSS, $query);

                if (!$result) {
                    die("Error: " . mysqli_error($conSS));
                }

                $currentTarian = ""; // Variable untuk menyimpan tarian saat ini
                $prevTarian = ""; // Variable untuk menyimpan tarian sebelumnya
                $nomorPeserta = 0; // Variabel nomor peserta
                $allTarian = []; // Array untuk menyimpan semua jenis tarian

                while ($row = mysqli_fetch_assoc($result)) {
                    $currentTarian = $row['Nama Tarian'];

                    if (!in_array($currentTarian, $allTarian)) {
                        $allTarian[] = $currentTarian; // Menyimpan jenis tarian dalam array
                    }

                    if ($currentTarian != $prevTarian) {
                        // Jika tarian berbeda dengan tarian sebelumnya, tampilkan nama tarian di kolom pertama
                        echo "<tr><td colspan='11'><strong>$currentTarian</strong></td></tr>";
                        $prevTarian = $currentTarian;
                        $nomorPeserta = 0; // Set ulang nomor peserta
                    }

                    $nomorPeserta++;
                    echo "
                    <tr>
                        <td class='text-center'>{$nomorPeserta}</td>
                        <td class='text-center'>{$row['no_regis']}</td>
                        <td>{$row['Nama Siswa']}</td>
                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                        </tr>";
                }

                $allTarianList = implode(', ', $allTarian); // Menggabungkan semua jenis tarian menjadi string
                ?>
            <?php
                $query_guru = "SELECT t_guri.idGuru, t_guru.nama AS namaPengajar, t_guri.idTari FROM t_guri JOIN t_guru ON t_guri.idGuru = t_guru.ID GROUP BY t_guru.ID";
                $result_guru = mysqli_query($conSS, $query_guru);

                if (!$result_guru) {
                    die("Error: " . mysqli_error($conSS));
                }
                ?>
                <tr>
                    <th>Guru</th>
                </tr>
                <?php
                $nomorGuru = 0;
                while ($row_guru = mysqli_fetch_assoc($result_guru)) {
                    $nomorGuru++;
                    echo "<tr>
                            <td class='text-center'>{$nomorGuru}</td>
                            <td>{$row_guru['idGuru']}</td>
                            <td>{$row_guru['namaPengajar']}</td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        // Menampilkan semua jenis tarian
        document.getElementById('nama-tarian').innerText = "<?php echo $allTarianList; ?>";

        // Menghitung tanggal awal dan akhir
        const startDate = new Date();
        const endDate = new Date();
        endDate.setDate(startDate.getDate() + 66);

        // Format tanggal
        const formatDate = (date) => {
            const d = new Date(date);
            let month = '' + (d.getMonth() + 1);
            let day = '' + d.getDate();
            const year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [day, month, year].join('-');
        }

        // Menampilkan tanggal awal dan akhir
        document.getElementById('tanggal-latihan').innerText = `${formatDate(startDate)} s.d. ${formatDate(endDate)}`;
    </script>
    	<script>
		window.print();
	</script>
</body>
</html>
