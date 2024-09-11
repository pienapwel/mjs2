<?php
$siswa = [
    ["nama" => "Andi", "matematika" => 85, "bahasa_inggris" => 70, "ipa" => 80],
    ["nama" => "Budi", "matematika" => 60, "bahasa_inggris" => 50, "ipa" => 65],
    ["nama" => "Cici", "matematika" => 75, "bahasa_inggris" => 80, "ipa" => 70],
    ["nama" => "Dodi", "matematika" => 95, "bahasa_inggris" => 85, "ipa" => 90],
    ["nama" => "Eka", "matematika" => 50, "bahasa_inggris" => 60, "ipa" => 55],
];

$lulus = 0;
$tidak_lulus = 0;

function formatPelajaran($pelajaran) {
    $mapping = [
        "matematika" => "Matematika",
        "bahasa_inggris" => "Bahasa Inggris",
        "ipa" => "IPA"
    ];
    return $mapping[$pelajaran] ?? $pelajaran;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center; 
        }
        .main-table {
            width: 70%;
            margin: 0 auto; 
            margin-bottom: 20px;
        }
        .main-table table {
            border-collapse: collapse;
            width: 100%;
        }
        .main-table table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .lulus {
            background-color: #d4edda;
        }
        .tidak-lulus {
            background-color: #f8d7da;
        }
        .summary {
            width: 25%;
            float: right;
            margin-top: 20px;
        }
        .summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .summary table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <h1>Nilai Siswa</h1>

    <!-- Tabel Utama: Daftar Nilai Siswa -->
    <div class="main-table">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nilai Rata-Rata</th>
                    <th>Status Kelulusan</th>
                    <th>Rekomendasi Perbaikan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($siswa as $s): ?>
                    <?php
                    $rataRata = ($s["matematika"] + $s["bahasa_inggris"] + $s["ipa"]) / 3;
                    $status = $rataRata >= 75 ? "Lulus" : "Tidak Lulus";
                    
                    if ($status === "Lulus") {
                        $lulus++;
                        $mataPelajaran = "-";
                        $statusClass = "lulus";
                    } else {
                        $tidak_lulus++;
                        $nilai = [
                            "matematika" => $s["matematika"],
                            "bahasa_inggris" => $s["bahasa_inggris"],
                            "ipa" => $s["ipa"]
                        ];
                        $mataPelajaran = array_keys($nilai, min($nilai))[0];
                        $mataPelajaran = formatPelajaran($mataPelajaran);
                        $statusClass = "tidak-lulus";
                    }
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($s["nama"]); ?></td>
                        <td><?php echo number_format($rataRata, 2); ?></td>
                        <td class="<?php echo $statusClass; ?>"><?php echo $status; ?></td>
                        <td><?php echo $mataPelajaran; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Tabel Kanan: Jumlah Lulus dan Tidak Lulus -->
    <div class="summary">
        <table>
            <thead>
                <tr>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Jumlah siswa yang lulus</td>
                    <td><?php echo $lulus; ?></td>
                </tr>
                <tr>
                    <td>Jumlah siswa yang tidak lulus</td>
                    <td><?php echo $tidak_lulus; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="clear"></div>
</body>
</html>
