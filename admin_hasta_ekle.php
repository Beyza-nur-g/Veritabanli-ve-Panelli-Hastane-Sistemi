<?php
// Veritabanı bağlantısını içe aktar
include("baglanti.php");

// Hasta sınıfını içe aktar
include("class.php");

// Formdan gelen verileri al
$hastaAd = $_POST["hastaAd"];
$hastaSoyad = $_POST["hastaSoyad"];
$hastaTc = $_POST["hastaTc"];
$dogumTarihi = $_POST["dogumTarihi"];
$cinsiyet = $_POST["cinsiyet"];
$telefon = $_POST["telefon"];
$adres = $_POST["adres"];

// Hasta nesnesi oluştur
$hasta = new Hasta($baglan);

// Hasta ekle ve sonucu kontrol et
if ($hasta->hastaEkle($hastaAd, $hastaSoyad, $hastaTc, $dogumTarihi, $cinsiyet, $telefon, $adres)) {
    echo "Hasta başarıyla eklendi.";
    header("Location: hastaIslemleri.php");
} else {
    echo "Hasta eklenirken bir hata oluştu.";
}
?>
