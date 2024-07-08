<?php

// Veritabanı bağlantısını içe aktar
include("baglanti.php");

// Bölüm bilgisini al
$bolum = $_GET['bolum'];

// Doktorları al
$query = "SELECT doktorAd, doktorSoyad FROM doktorlar WHERE bolum = ?";
$stmt = $baglan->prepare($query);
$stmt->bind_param("s", $bolum);
$stmt->execute();
$result = $stmt->get_result();

$doktorlar = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doktorlar[] = $row['doktorAd'] . " " . $row['doktorSoyad'];
    }
}

// Doktor adlarını seçim kutusu olarak geri döndür
echo "<label for='doktor'>Doktor:</label>";
echo "<select id='doktor' name='doktorAd' required>";
foreach ($doktorlar as $doktor) {
    echo "<option value='$doktor'>$doktor</option>";
}
echo "</select>";

?>
