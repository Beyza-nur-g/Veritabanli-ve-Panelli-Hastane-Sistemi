<?php
// Veritabanı bağlantısını içe aktar
include("baglanti.php");

// Hasta sınıfını içe aktar
include("class.php");

// Formdan gelen verileri al
$hastaAd = $_POST['hastaAd'];
$hastaSoyad = $_POST['hastaSoyad'];
$hastaTc = $_POST['hastaTc'];
$dogumTarihi = $_POST['dogumTarihi'];
$cinsiyet = $_POST['cinsiyet'];
$telefon = $_POST['telefon'];
$adres = $_POST['adres'];

// Hasta nesnesini oluştur
$hasta = new Hasta($baglan);

// Hasta güncelleme işlemini gerçekleştir
if ($hasta->hastaGuncelle( $hastaAd, $hastaSoyad,$hastaTc, $dogumTarihi, $cinsiyet, $telefon, $adres)) {
    // Başarıyla güncellendiğinde kullanıcıyı yönlendir
    header("Location: randevu.php");
    exit(); // İşlemi sonlandır
} else {
    echo "Hasta güncellenirken bir hata oluştu.";
}
?>
