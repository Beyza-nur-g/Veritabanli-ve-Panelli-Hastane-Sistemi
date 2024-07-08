<?php
// Veritabanı bağlantısını içe aktar
include("baglanti.php");

// Hasta sınıfını içe aktar
include("class.php");

// Formdan gelen verileri al
$hastaTc = $_POST["hastaTc"];
// Hasta nesnesi oluştur
$hasta = new Hasta($baglan);

// Hasta ekle ve sonucu kontrol et
if ($hasta->hastaSil($hastaTc)) {
    echo "Hasta başarıyla silindi.";
    header("Location: index.php");
} else {
    echo "Hasta silinirken bir hata oluştu.";
}
?>
