<?php
// Veritabanı bağlantısını içe aktar
include("baglanti.php");

// Hasta sınıfını içe aktar
include("class.php");

// Formdan gelen verileri al
$Ad = $_POST["doktorAd"];
$Soyad = $_POST["doktorSoyad"];
$Id = $_POST["doktorId"];
$bolum= $_POST["bolum"];

// Hasta nesnesi oluştur
$doktor = new Doktor($baglan);

// Hasta ekle ve sonucu kontrol et
if ($doktor->doktorEkle($Ad, $Soyad, $Id, $bolum)) {
    echo "Hasta başarıyla eklendi.";
    header("Location: doktorIslemleri.php");
} else {
    echo "Hasta eklenirken bir hata oluştu.";
}
?>
