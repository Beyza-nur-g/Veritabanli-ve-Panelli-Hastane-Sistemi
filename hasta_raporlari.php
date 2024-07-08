<?php
include 'baglanti.php';

// Veritabanından raporları çek
$sql = "SELECT * FROM raporlar";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Raporları tablo halinde göster
    echo "<table border='1'>
    <tr>
    <th>Rapor Tarihi</th>
    <th>Rapor İçeriği</th>
    <th>Hasta TC</th>
    <th>Resim URL</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['raporTarihi'] . "</td>";
        echo "<td>" . $row['raporIcerigi'] . "</td>";
        echo "<td>" . $row['hastaTc'] . "</td>";
        echo "<td><img src='" . $row['resimURL'] . "' width='100'></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Hiçbir rapor bulunamadı.";
}
?>
