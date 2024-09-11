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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Nilai Siswa</h1>
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
    
    <div class="summary">
        <p>Jumlah siswa yang lulus: <?php echo $lulus; ?></p>
        <p>Jumlah siswa yang tidak lulus: <?php echo $tidak_lulus; ?></p>
    </div>
</body>
</html>
